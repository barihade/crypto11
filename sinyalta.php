<?php
    ini_set('max_execution_time', 50);
    include('koneksi.php');
    binance();

    function binance(){
        //Dapatkan semua data symbol dari api binance.
        $url = "https://api.coingecko.com/api/v3/exchanges/binance";
        $data = getData($url);
        $data = json_decode($data, false);
        foreach($data->tickers as $key => $value){
            crossing($value->base, $value->target);
        }
    }

    function Mamae($data, $ma, $mae, $base, $target){
        $selisih = 0;
        $range = 0;
        $prev = 0;
        $close = (float)($data[count($data)-1][4]);
        $text = "error";
        if($mae[count($mae)-1] < $ma[count($ma)-1]){
            $prev = $ma[count($ma)-2] - $mae[count($mae)-2];
            $selisih = $ma[count($ma)-1] - $mae[count($mae)-1];
            if($prev > $selisih){
                $range = $close*0.23/100;
                if($selisih < $range){
                    save($close, $base, $target);
                }
            }
        }
        // echo "<br>MA 449 : ".$ma[449];
        // echo "<br>MAE 449: ".$mae[449]."<br>";
        // echo "<br>MA 448 : ".$ma[448];
        // echo "<br>MAE 448: ".$mae[448]."<br>";
        // echo "<br>Prev: ".$prev."<br>";
        // echo "<br>Selisih: ".$selisih;
        // echo "<br><br>Range: ".$range;
    }

    function Stochastic($data, $persenK, $persenD, $base, $target){
        $text = "error";
        // echo "<br><br>%K = ".$persenK[count($persenK)-1];
        // echo "<br>%D = ".$persenD[count($persenD)-1];
        $close = $data[count($data)-1][4];
        if($persenK[count($persenK)-1] < 20 && $persenD[count($persenD)-1] < 20){
            save($close, $base, $target);
        }
    }

    function ParabolicSAR($data, $parabolicSAR, $base, $target){
        $close = (float)$data[count($data)-1][4];
        $prev = (float)$data[count($data)-2][4];
        // echo "Close : ".$close;
        // echo "<br>";
        // echo "Prev : ".$prev;
        // echo "<br>";
        // echo "<br>";
        // echo "PSAR : ".$parabolicSAR[449];
        // echo "<br>";
        // echo "prevPSAR : ".$parabolicSAR[448];
        // echo "<br>";
        if($parabolicSAR[count($parabolicSAR)-2] < $prev){
            if($parabolicSAR[count($parabolicSAR)-1] > $close){
                save($close, $base, $target);
            }
        }
    }

    function crossing($base, $target){
        $coin = $base."".$target;
        $url = "https://api.binance.com/api/v1/klines?symbol=".$coin."&interval=30m";
        echo $url;
        $data = getData($url);
        $data = json_decode($data);        

        //PSAR
        $Acc = 0.02;
        $EP = (float)($data[0][3]);
        $hp = (float)($data[0][2]);
        $lp = (float)($data[0][3]);
        $up = true;
        $PSar = 0;

        //Dapatkan setiap data close yang ada
        $persenK = [];
        $persenD = [];
        $ma = [];
        $mae = [];
        $parabolicSAR = [];
        $jml = 0;
        $list = array_slice($data, 50, count($data));
        for ($i=0; $i < count($list); $i++) { 

            //Hitung MA50 dan MAE5 dari data indeks ke-0
            $sum = 0;
            for ($j=$i; $j<($i+50); $j++) { 
                $sum = $sum+((float)($data[$j][4]));
            }
            $sum = $sum/50;
            $ma[] = $sum;

            $close = (float)($list[$i][4]);
            if($i == 0){
                $jml = (($close-$sum)*(2/6))+$sum;
            }else{
                $jml = (($close-$jml)*(2/6))+$jml;
            }
            $mae[] = $jml;

            //Hitung Stochastic
            $max = 0;$min = 0;
            for ($j=($i+37); $j < ($i+51); $j++) { 
                $high = (float)($data[$j][2]);
                $low = (float)($data[$j][3]);
                if($max <= $high){
                    $max = $high;
                }
                if($min >= $low || $min == 0){
                    $min = $low;
                }
            }
            $persenK[$i] = (100*($close-$min))/($max-$min);
            if($i >= 2){
                $sum = 0;
                for ($j=($i-2); $j <= $i ; $j++) { 
                    $sum = $sum+$persenK[$j];
                }
                $persenD[$i] = $sum/3;
            }else{
                $persenD[$i] = $persenK[$i];
            }

            if ($i > 0) {
                $SARn = $PSar;
                if ($up) {
                    $PSar = $SARn + $Acc * ($hp - $SARn);
                } else {
                    $PSar = $SARn + $Acc * ($lp - $SARn);
                }
                $reverse = false;
                if ($up) {
                    if ($list[$i][3] < $PSar) {
                        $up = false;
                        $reverse = true;
                        $PSar = $hp;
                        $lp = (float)($list[$i][3]);
                        $Acc = 0.02;
                    }
                } else {
                    if ($list[$i][2] > $PSar) {
                        $up = true;
                        $reverse = true;
                        $PSar = $lp;
                        $hp = (float)($list[$i][2]);
                        $Acc = 0.02;
                    }
                }
                if (!$reverse && $i > 1) {
                    if ($up) {
                        if ($list[$i][2] > $hp) {
                            $hp = (float)($list[$i][2]);
                            $Acc = min($Acc + 0.02, 0.2);
                        }
                        if ($list[$i - 1][3] < $PSar) {
                            $PSar = (float)($list[$i - 1][3]);
                        }
                        if ($list[$i - 2][3] < $PSar) {
                            $PSar = (float)($list[$i - 2][3]);
                        }
                    } else {
                        if ($list[$i][3] < $lp) {
                            $lp = $list[$i][3];
                            $Acc = min($Acc + 0.02, 0.2);
                        }
                        if ($list[$i - 1][2] > $PSar) {
                            $PSar = (float)($list[$i - 1][2]);
                        }
                        if ($list[$i - 2][2] > $PSar) {
                            $PSar = (float)($list[$i - 2][2]);
                        }
                    }
                }
            } else {
                $PSar = $list[$i][4];
            }
            $PSar = (float)($PSar);
            $parabolicSAR[] = $PSar;
        }
        ParabolicSAR($data, $parabolicSAR, $base, $target);
        Mamae($data, $ma, $mae, $base, $target);
        Stochastic($data, $persenK, $persenD, $base, $target);
    }

    function getData($url){
    	$curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl_handle, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_SSLv3');
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $result;
    }

    function save($buy, $base, $target){
        GLOBAL $conn;
        echo "Success";
        
        $pair = $base."/".$target;
        if($target == "USDT" || $target == "USD"){
            $buy = $buy;
            $tp1 = (float)($buy+($buy*0.01));
            $tp2 = (float)($buy+($buy*0.02));
            $tp3 = (float)($buy+($buy*0.03));
            $tp4 = (float)($buy+($buy*0.04));
            $tp5 = (float)($buy+($buy*0.05));
        }else{
            $buy = $buy*100000000;
            $tp1 = (int)($buy+($buy*0.01));
            $tp2 = (int)($buy+($buy*0.02));
            $tp3 = (int)($buy+($buy*0.03));
            $tp4 = (int)($buy+($buy*0.04));
            $tp5 = (int)($buy+($buy*0.05));
        }
        $now = date("Y-m-d H:i:s");
        
        $query = "SELECT pair FROM sinyal WHERE pair = '".$pair."' AND exchange = 'Binance'";
        $res = $conn->query($query);
        if($res->rowCount() < 1 && $buy != 0){
            $query = "INSERT INTO `sinyal`(`sumber`, `pair`, `exchange`, `save`, `real`, `tp1`, `tp2`, `tp3`, `tp4`, `tp5`, `created_at`, `updated_at`) VALUES ('Sinyal TA','".$pair."','Binance','".$buy."','".$buy."','".$tp1."','".$tp2."','".$tp3."','".$tp4."','".$tp5."','".$now."','".$now."')";
            $result = $conn->query($query);
        }
    }

?>