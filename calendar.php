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
        <p style="color: aliceblue">Calendar</p>
    </nav>
<div class="main-content pt-5">
    <div class="container">
        <div class="row">
            <div class="col" style="margin: auto;">
                <div class="section__content section__content--p30">
                    <div style="text-align: center;color: white;">
                        <div id="eventoncontent" style="height:100%; width:100%;">
                            <!-- Content -->
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
<script type="text/javascript" src="http://www.coincalendar.info/wp-content/plugins/eventon-api/eventon.js?ver=1.0.1"></script>
<script type="text/javascript">
 jQuery(document).ready(function($){
    $('#eventoncontent').evoCalendar({
        api: 'http://www.coincalendar.info/wp-json/eventon/calendar?event_type=3,1266,1267&number_of_months=1&event_count=20&show_et_ft_img=yes',
        calendar_url: '',
        new_window: false,
        loading_text: 'Loading Calendar...'
    });
 });
</script>

</body>
</html>