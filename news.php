<?php

    $data = CCN();

	function CCN(){
        $url = "https://newsapi.org/v2/top-headlines?sources=crypto-coins-news&apiKey=a5c4739306154a0ba74cc7cb5cd247c9";
        $data = getData($url);
        $data = json_decode($data);
        return $data;
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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <p style="color: aliceblue">NEWS</p>
    </nav>
<div class="main-content pt-5">
    <div class="container">
        <div class="row">
            <div class="col" style="margin: auto;">
                <div class="section__content section__content--p30">
                    <div style="text-align: center;color: white;">
                        <div class="card mb-2" style="margin: auto">
                            <img class="card-img-top" src="<?= $data->articles[0]->urlToImage ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->articles[0]->title ?></h5><br>
                                <p class="card-text" style="color: black;text-align: justify;font-size: 80%;"><?= $data->articles[0]->description?></p><br>
                                <a href="<?= $data->articles[0]->url ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="card mb-2" style="margin: auto">
                            <img class="card-img-top" src="<?= $data->articles[1]->urlToImage ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->articles[1]->title ?></h5><br>
                                <p class="card-text" style="color: black;text-align: justify;font-size: 80%;"><?= $data->articles[1]->description?></p><br>
                                <a href="<?= $data->articles[1]->url ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="card mb-2" style="margin: auto">
                            <img class="card-img-top" src="<?= $data->articles[2]->urlToImage ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->articles[2]->title ?></h5><br>
                                <p class="card-text" style="color: black;text-align: justify;font-size: 80%;"><?= $data->articles[2]->description?></p><br>
                                <a href="<?= $data->articles[2]->url ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="card mb-2" style="margin: auto">
                            <img class="card-img-top" src="<?= $data->articles[3]->urlToImage ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->articles[3]->title ?></h5><br>
                                <p class="card-text" style="color: black;text-align: justify;font-size: 80%;"><?= $data->articles[3]->description?></p><br>
                                <a href="<?= $data->articles[3]->url ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                        <div class="card mb-5" style="margin: auto">
                            <img class="card-img-top" src="<?= $data->articles[4]->urlToImage ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->articles[4]->title ?></h5><br>
                                <p class="card-text" style="color: black;text-align: justify;font-size: 80%;"><?= $data->articles[4]->description?></p><br>
                                <a href="<?= $data->articles[4]->url ?>" class="btn btn-primary">Read More</a>
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