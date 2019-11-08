<?php

    error_reporting(0);
    $namaServer = "localhost"; // via UNIX socket
    //$namaServer = "127.0.0.1"; // via TCP/IP
    $namaUser = "barihade";
    $password = "Gundamexia00";

    try {
        $conn = new PDO("mysql:host=$namaServer;dbname=crypto11", $namaUser, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Berhasil koneksi";
    }
    catch(PDOException $e)
    {
        echo "Erro koneksi: " . $e->getMessage();
    }
?>