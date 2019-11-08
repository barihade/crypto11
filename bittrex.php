<?php
    error_reporting(0);
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }
    include('koneksi.php');
    $btc = $conn->query("SELECT * FROM `sinyal` WHERE pair LIKE '%BTC' AND exchange = 'Bittrex'");
    $eth = $conn->query("SELECT * FROM `sinyal` WHERE pair LIKE '%ETH' AND exchange = 'Bittrex'");
    $usdt = $conn->query("SELECT * FROM `sinyal` WHERE pair LIKE '%USDT' AND exchange = 'Bittrex'");

    $symbol = bittrex();
    $icon = icon();

    function bittrex(){
        //Dapatkan semua data symbol dari api bittrex.
        $url = "https://api.coingecko.com/api/v3/exchanges/bittrex";
        $data = getData($url);
        $data = json_decode($data, false);
        return $data->tickers;
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

    function icon(){
    	$url = 'https://s2.coinmarketcap.com/generated/search/quick_search.json';
    	$data = getData($url);
    	$data = json_decode($data, true);
    	return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Crypto11</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition" style="background-color: dodgerblue;">
    <nav class="navbar navbar-sm py-0" style="background-color: rgb(25, 124, 223)">
        <a class="navbar-brand" href="index.php">
            <i class="fa fa-chevron-left" style="color: aliceblue"></i>
        </a>
        <p style="color: aliceblue">Sinyal Indodax</p>
    </nav>
    <nav>
        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist" style="background-color: white;">
            <a class="nav-item nav-link active" id="nav-btc-tab" data-toggle="tab" href="#nav-btc" role="tab" aria-controls="nav-home"
                aria-selected="true" style="margin: auto;">BTC</a>
            <a class="nav-item nav-link" id="nav-eth-tab" data-toggle="tab" href="#nav-eth" role="tab" aria-controls="nav-profile"
                aria-selected="false" style="margin: auto;">ETH</a>
            <a class="nav-item nav-link" id="nav-usdt-tab" data-toggle="tab" href="#nav-usdt" role="tab" aria-controls="nav-profile"
                aria-selected="false" style="margin: auto;">USDT</a>
        </div>
    </nav>

    <div class="main-content py-0">
        <div class="section__content section__content--p30">
            <div class="mb-5">
            <div class="default-tab">
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-btc" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="list-group pr-3">
                            <?php 
                            while($row = $btc->fetch()){ 
                                $currency = explode('/', $row[2]);
                                $data = array_search($currency[0], array_column($icon, 'symbol'));
                                $imgUrl = "https://s2.coinmarketcap.com/static/img/coins/16x16/" . $icon[$data]['id'] . ".png"; ?>
                                <a class="list-group-item list-group-item-action" href="detailbittrex.php?id=<?= $row[0] ?>">
                                    <?= '<img src="'.$imgUrl.'"> '.$currency[0]; ?>
                                </a>
                            <?php } 
                            if($btc->rowCount() < 1){ ?>
                                <h5 class="pt-3" style="text-align: center;color: white;">Maaf saat ini sinyal belum tersedia.</h5>
                            <?php } ?>
                        </div>      
                    </div>
                    <div class="tab-pane fade" id="nav-eth" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="list-group pr-3">
                            <?php 
                            while($row = $eth->fetch()){ 
                                $currency = explode('/', $row[2]);
                                $data = array_search($currency[0], array_column($icon, 'symbol'));
                                $imgUrl = "https://s2.coinmarketcap.com/static/img/coins/16x16/" . $icon[$data]['id'] . ".png"; ?>
                                <a class="list-group-item list-group-item-action" href="detailbittrex.php?id=<?= $row[0] ?>">
                                    <?= '<img src="'.$imgUrl.'"> '.$currency[0]; ?>
                                </a>
                            <?php }
                            if($eth->rowCount() < 1){ ?>
                                <h5 class="pt-3" style="text-align: center;color: white;">Maaf saat ini sinyal belum tersedia.</h5>
                            <?php } ?>
                        </div>      
                    </div>
                    <div class="tab-pane fade" id="nav-usdt" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="list-group pr-3">
                            <?php 
                            while($row = $usdt->fetch()){ 
                                $currency = explode('/', $row[2]);
                                $data = array_search($currency[0], array_column($icon, 'symbol'));
                                $imgUrl = "https://s2.coinmarketcap.com/static/img/coins/16x16/" . $icon[$data]['id'] . ".png"; ?>
                                <a class="list-group-item list-group-item-action" href="detailbittrex.php?id=<?= $row[0] ?>">
                                    <?= '<img src="'.$imgUrl.'"> '.$currency[0]; ?>
                                </a>
                            <?php }
                            if($usdt->rowCount() < 1){ ?>
                                <h5 class="pt-3" style="text-align: center;color: white;">Maaf saat ini sinyal belum tersedia.</h5>
                            <?php } ?>
                        </div>      
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->