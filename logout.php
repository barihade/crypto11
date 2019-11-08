<?php
    error_reporting(0);
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    session_destroy();
    header('Location: login.php');
?>