<?php

    error_reporting(0);
    include('koneksi.php');
    if(isset($_POST['register'])){
        try {
            $query = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['password']."')";
            $user = $conn->query($query);    
            header("Location: login.php");
        } catch (\Throwable $th) {
            header("Location: register.php");
        }        
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

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col" style="margin: auto;">
                    <div class="section__content section__content--p30">
                        <div class="pt-5 mt-5" style="text-align: center;color: white;">
                            <div class="au-card mx-1 px-4" style="background-color: rgb(239, 239, 240);">
                                <div class="au-card-inner">
                                    <h4 class="mb-4">REGISTER</h4>
                                    <form action="register.php" method="post">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="E-Mail">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input style="cursor:pointer;" class="form-control btn-primary" name="register" id="register" type="submit" value="SUBMIT">
                                        </div>
                                    </form>
                                    <p style="color: black;">Sudah punya akun ? - <a href="login.php">Login</a></p>
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