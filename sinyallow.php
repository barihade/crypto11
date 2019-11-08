<?php
    
    error_reporting(0);
    date_default_timezone_set("Asia/Jakarta");
    include('koneksi.php');
    indodax();
    bittrex();
    binance();
    
    function indodax(){
        GLOBAL $conn;
        $url = "https://indodax.com/api/summaries";
        $data = getData($url);
        $data = json_decode($data);
        $sinyal = [];
        foreach($data->tickers as $key => $value){
            if($value->low == $value->last){
                $pair = strtoupper($key);
                $pair = str_replace("_", "/", $pair);
                $base = explode("/", $pair);
                if($base[1] == 'BTC'){
                    $last = $value->last*100000000;
                }else{
                    $last = $value->last;
                }
                $tp1 = (int)($last+($last*0.01));
                $tp2 = (int)($last+($last*0.02));
                $tp3 = (int)($last+($last*0.03));
                $tp4 = (int)($last+($last*0.04));
                $tp5 = (int)($last+($last*0.05));
                $now = date("Y-m-d H:i:s");
                $query = "SELECT pair FROM sinyal WHERE pair = '".$pair."' AND exchange = 'Indodax'";
                $res = $conn->query($query);
                if($res->rowCount() < 1){
                    $query = "INSERT INTO `sinyal`(`sumber`, `pair`, `exchange`, `save`, `real`, `tp1`, `tp2`, `tp3`, `tp4`, `tp5`, `created_at`, `updated_at`) VALUES ('Sinyal Low','".$pair."','Indodax','".$last."','".$last."','".$tp1."','".$tp2."','".$tp3."','".$tp4."','".$tp5."','".$now."','".$now."')";
                    $result = $conn->query($query);
                }
                $sinyal[] = $key; 
            }
        }
    }
    
    function bittrex(){
        GLOBAL $conn;
        $url = "https://bittrex.com/api/v1.1/public/getmarketsummaries";
        $data = getData($url);
        $data = json_decode($data);
        $sinyal = [];
        foreach($data->result as $key => $value){
            if($value->Low == $value->Last){
                $pair = strtoupper($value->MarketName);
                $pair = str_replace("-", "/", $pair);
                $base = explode("/", $pair);
                $pair = $base[1]."/".$base[0];
                if($base[0] == "USDT" || $base[0] == "USD"){
                    $last = $value->Last;
                    $tp1 = (int)($last+($last*0.01));
                    $tp2 = (int)($last+($last*0.02));
                    $tp3 = (int)($last+($last*0.03));
                    $tp4 = (int)($last+($last*0.04));
                    $tp5 = (int)($last+($last*0.05));
                }else{
                    $last = $value->Last*100000000;
                    $tp1 = (int)($last+($last*0.01));
                    $tp2 = (int)($last+($last*0.02));
                    $tp3 = (int)($last+($last*0.03));
                    $tp4 = (int)($last+($last*0.04));
                    $tp5 = (int)($last+($last*0.05));
                }
                $now = date("Y-m-d H:i:s");
                $query = "SELECT pair FROM sinyal WHERE pair = '".$pair."' AND exchange = 'Bittrex'";
                $res = $conn->query($query);
                if($res->rowCount() < 1){
                    $query = "INSERT INTO `sinyal`(`sumber`, `pair`, `exchange`, `save`, `real`, `tp1`, `tp2`, `tp3`, `tp4`, `tp5`, `created_at`, `updated_at`) VALUES ('Sinyal Low','".$pair."','Bittrex','".$last."','".$last."','".$tp1."','".$tp2."','".$tp3."','".$tp4."','".$tp5."','".$now."','".$now."')";
                    $result = $conn->query($query);
                }
                $sinyal[] = $key; 
            }
        }
    }
    
    function binance(){
        GLOBAL $conn;
        $url = "https://api.binance.com/api/v1/ticker/24hr";
        $data = getData($url);
        $data = json_decode($data);
        $sinyal = [];
        foreach($data as $key => $value){
            if($value->lowPrice == $value->lastPrice){
                $pair = getPair($value->symbol);
                $last = $value->lastPrice*100000000;
                $tp1 = (int)($last+($last*0.01));
                $tp2 = (int)($last+($last*0.02));
                $tp3 = (int)($last+($last*0.03));
                $tp4 = (int)($last+($last*0.04));
                $tp5 = (int)($last+($last*0.05));
                $now = date("Y-m-d H:i:s");
                $query = "SELECT pair FROM sinyal WHERE pair = '".$pair."' AND exchange = 'Binance'";
                $res = $conn->query($query);
                if($res->rowCount() < 1 && $last != 0){
                    $query = "INSERT INTO `sinyal`(`sumber`, `pair`, `exchange`, `save`, `real`, `tp1`, `tp2`, `tp3`, `tp4`, `tp5`, `created_at`, `updated_at`) VALUES ('Sinyal Low','".$pair."','Binance','".$last."','".$last."','".$tp1."','".$tp2."','".$tp3."','".$tp4."','".$tp5."','".$now."','".$now."')";
                    $result = $conn->query($query);
                }
                $sinyal[] = $key; 
            }
        }
    }

    function getPair($pair){
        $url = "https://api.binance.com/api/v1/exchangeInfo";
        $data = getData($url);
        $data = json_decode($data);
        foreach($data->symbols as $key => $value){
            if($value->symbol == $pair){
                return $value->baseAsset."/".$value->quoteAsset;
            }
        }
    }

    function getData($url){
    	$curl_handle = curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl_handle, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_SSLv3');
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $result;
    }
?>