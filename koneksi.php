<?php 
    //make connection mysql
    $koneksi = mysqli_connect("localhost","root","","db_tailor");
    //check connection msyql
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //set timezone
    date_default_timezone_set('Asia/Jakarta');
?>