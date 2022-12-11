<?php 
    $Ahost = "localhost";
    $Auser = "root";
    $Apass = "";
    $Adb = "db_tailor";

    //make connection mysql
    $koneksi = mysqli_connect($Ahost, $Auser, $Apass, $Adb);
    //check connection msyql
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    //set timezone
    date_default_timezone_set('Asia/Jakarta');
?>