<?php
    error_reporting(0);
    session_start();
    if((isset($_SESSION['id']))){
    }else{
        header('Location: login.php');
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
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body class="animsition" style="background-color: dodgerblue">

<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#menu-toggle" id="toggle-menu">
                        Crypto11
                    </a>
                </li>
                <li>
                    <a href="index.php">Dashboard</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page">
            <nav class="navbar navbar-sm py-0" style="background-color: rgb(25, 124, 223);">
                <a class="mr-0 py-1" href="#menu-toggle" id="menu-toggle">
                    <img src="assets/foto.gif" style="width: 25%; height: 25%;">
                </a>
                <p style="color: aliceblue;text-align: center;">Crypto11</p>

            </nav>

            <div class="main-content py-0 my-0">
                <div class="section__content section__content--p30 py-0 my-0">
                    <div class="container-fluid py-0 my-0">
                        <div class="row m-t-25">
                            <div id="carouselExampleControls" class="carousel slide mb-5 mx-3" data-ride="carousel" style="margin: auto;">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://media-assets-05.thedrum.com/cache/images/thedrum-prod/s3-news-tmp-123315-bitcoin--2x1--400.png" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://www.androidcentral.com/sites/androidcentral.com/files/styles/medium/public/article_images/2018/01/bitcoin-stacksocial.jpg?itok=HnvzJ_mN" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://www.slayerment.com/files/slayerment/styles/teaser/public/images/fedcoin.jpg?itok=usKVsxir" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <h5 class="pb-4" style="text-align: center;color: white">Menu</h5>
                        <div class="row py-0 my-0">
                            <div class="col pr-2">
                                <a href="indodax.php">
                                    <div class="au-card px-0 py-0">
                                        <div class="au-card-inner px-2 py-0" align="center" style="font-size: 12px;">
                                            <img class="px-2 py-2" src="assets/indodax.gif">
                                            Indodax
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col px-0">
                                <a href="binance.php">
                                    <div class="au-card px-0 py-0">
                                        <div class="au-card-inner px-2 py-0" align="center" style="font-size: 12px;">
                                            <img class="px-2 py-2" src="assets/binance.gif">
                                            Binance
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col pl-2">
                                <a href="bittrex.php">
                                    <div class="au-card px-0 py-0">
                                        <div class="au-card-inner px-2 py-0" align="center" style="font-size: 12px;">
                                            <img class="px-2 py-2" src="assets/bittrex.gif">
                                            Bittrex
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col pr-2">
                                <a href="calendar.php" class="py-0">
                                    <div class="au-card px-0 py-0">
                                        <div class="au-card-inner px-2 py-0" align="center" style="font-size: 12px;">
                                            <img class="px-2 py-2" src="https://www.teerexradioteerex.com/wp-content/uploads/2016/12/calendar-icon.png">
                                            Calendar
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col pl-2">
                                <a href="news.php" class="py-0">
                                    <div class="au-card px-0 py-0">
                                        <div class="au-card-inner px-2 py-0" align="center" style="font-size: 12px;">
                                            <img class="px-2 py-2" src="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-free/512/icon-70-512.png">
                                            News
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>

    

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        var page = document.getElementById("page");
        page.style.display = 'none';
        $("#wrapper").toggleClass("toggled");
    });
    $("#toggle-menu").click(function(e) {
        e.preventDefault();
        var page = document.getElementById("page");
        page.style.display = 'block';
        $("#wrapper").toggleClass("toggled");
    });
    </script>
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
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <!-- Menu Toggle Script -->

</body>

</html>
<!-- end document-->