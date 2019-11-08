<?php

    include('koneksi.php');
    $query = "SELECT * FROM sinyal";
    $res = $conn->query($query);
    while($row = $res->fetch()){
        if($row[3] == "Indodax"){
            indodax($row);
        }elseif($row[3] == "Bittrex"){
            bittrex($row);
        }elseif($row[3] == "Binance"){
            binance($row);
        }
    }

    function indodax($row){
        $pair = strtolower($row[2]);
        $pair = str_replace("/", "_", $pair);
        $target = explode("-", $pair);
        $url = "https://indodax.com/api/".$pair."/ticker";
        $data = getData($url);
        $data = json_decode($data);
        if($target[1] == 'BTC'){
            $last = ($data->ticker->last)*100000000;
        }else{
            $last = $data->ticker->last;
        }
        update($last, $row);
    }

    function binance($row){
        $target = explode("/", $row[2]);
        $pair = str_replace("/", "", $row[2]);
        $url = "https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair;
        $data = getData($url);
        $data = json_decode($data);
        if($target[1] == "USDT"){
            $last = $data->lastPrice;
        }else{
            $last = ($data->lastPrice)*100000000;
        }
        update($last, $row);
    }

    function bittrex($row){
        $target = explode("/", $row[2]);
        $pair = $target[1]."-".$target[0];
        $url = "https://bittrex.com/api/v1.1/public/getmarketsummary?market=".$pair;
        $data = getData($url);
        $data = json_decode($data);
        $data = $data->result[0];
        if($target[0] == "USDT" || $target[0] == "USD"){
            $last = $data->Last;
        }else{
            $last = ($data->Last)*100000000;
        }
        echo $last."<br>";
        update($last, $row);
    }

    function update($last, $row){
        GLOBAL $conn;
        $query = "";
        $now = date("Y-m-d H:i:s");
        if($last > $row[10]){
            $query = "UPDATE sinyal set tp5 = '".$row[10]." ".$now."', updated_at = '".$now."' WHERE id = '".$row[0]."'";
            $exist = strpos($row[10], " ");
            if($exist === false){
                $result = $conn->query($query);
            }
        }
        if($last > $row[9]){
            $query = "UPDATE sinyal set tp4 = '".$row[9]." ".$now."', updated_at = '".$now."' WHERE id = '".$row[0]."'";
            $exist = strpos($row[9], " ");
            if($exist === false){
                $result = $conn->query($query);
            }
        }
        if($last > $row[8]){
            $query = "UPDATE sinyal set tp3 = '".$row[8]." ".$now."', updated_at = '".$now."' WHERE id = '".$row[0]."'";
            $exist = strpos($row[8], " ");
            if($exist === false){
                $result = $conn->query($query);
            }
        }
        if($last > $row[7]){
            $query = "UPDATE sinyal set tp2 = '".$row[7]." ".$now."', updated_at = '".$now."' WHERE id = '".$row[0]."'";
            $exist = strpos($row[7], " ");
            if($exist === false){
                $result = $conn->query($query);
            }
        }
        if($last > $row[6]){
            $query = "UPDATE sinyal SET tp1 = '".$row[6]." ".$now."', updated_at = '".$now."' WHERE id = '".$row[0]."'";
            $exist = strpos($row[6], " ");
            if($exist === false){
                $result = $conn->query($query);
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