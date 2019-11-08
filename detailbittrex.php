<?php
    error_reporting(0);
    session_start();
    if(!(isset($_SESSION['id']))){
        header('Location: login.php');
    }
    include('koneksi.php');
    $id = $_GET['id'];
    $sinyal = $conn->query("SELECT * FROM sinyal WHERE id = ".$id);
    $sinyal = $sinyal->fetch();
    $tp1 = explode(" ", $sinyal[6]);
    $tp2 = explode(" ", $sinyal[7]);
    $tp3 = explode(" ", $sinyal[8]);
    $tp4 = explode(" ", $sinyal[9]);
    $tp5 = explode(" ", $sinyal[10]);

    $ticker = ticker();
    $icon = icon();

    function ticker(){
        GLOBAL $sinyal;
        $symbol = explode("/", $sinyal[2]);
        $symbol = $symbol[1]."-".$symbol[0];
        $url = "https://bittrex.com/api/v1.1/public/getmarketsummary?market=".$symbol;
        $data = getData($url);
        $data = json_decode($data, false);
        return $data->result[0];
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
        <a class="navbar-brand" href="bittrex.php">
            <i class="fa fa-chevron-left" style="color: aliceblue"></i>
        </a>
        <p style="color: aliceblue">Sinyal Bittrex</p>
    </nav>

    <div class="main-content py-0">
        <div class="section__content section__content--p30">
            <div style="text-align: center;">
                <div class="au-card mx-3 my-2" style="background-color: rgb(239, 239, 240);">
                    <div class="au-card-inner">
                        <?php 
                            $currency = explode('/', $sinyal[2]); ?>
                        <h5 class="mb-2"><?= $sinyal[2] ?></h5>
                        <?php
                            $data = array_search($currency[0], array_column($icon, 'symbol'));
                            $imgUrl = "https://s2.coinmarketcap.com/static/img/coins/32x32/" . $icon[$data]['id'] . ".png"; 
                            echo '<img src="'.$imgUrl.'">'; ?>
                        <p class="my-2">Last Price : <?= number_format($ticker->Last,9); ?></p>
                        <p class="my-2">Low Price : <?= number_format($ticker->Low,9); ?></p>
                        <p>High Price : <?= number_format($ticker->High,9); ?></p>
                    </div>
                </div>
                <div class="au-card mx-3" style="background-color: rgb(239, 239, 240);">
                    <div class="au-card-inner">
                        <h5><?= $currency[1]; ?></h5><br>
                        <div class="row">
                            <div class="col" style="color: black;text-align: left">
                                <p>TP1 : </p><br>
                                <p>TP2 : </p><br>
                                <p>TP3 : </p><br>
                                <p>TP4 : </p><br>
                                <p>TP5 : </p><br>
                            </div>
                            <div class="col" style="text-align: right">
                                <p class="<?= strpos($sinyal[6], " ") ? 'text-success' : 'text-danger'?>"><?= number_format($tp1[0]) ?></p>
                                <br>
                                <p class="<?= strpos($sinyal[7], " ") ? 'text-success' : 'text-danger'?>"><?= number_format($tp2[0]) ?></p>
                                <br>
                                <p class="<?= strpos($sinyal[8], " ") ? 'text-success' : 'text-danger'?>"><?= number_format($tp3[0]) ?></p>
                                <br>
                                <p class="<?= strpos($sinyal[9], " ") ? 'text-success' : 'text-danger'?>"><?= number_format($tp4[0]) ?></p>
                                <br>
                                <p class="<?= strpos($sinyal[10], " ") ? 'text-success' : 'text-danger'?>"><?= number_format($tp5[0]) ?></p>
                            </div>
                        </div>
                        <p style="color: black;">Last Update : <?= $sinyal[12]; ?></p>
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