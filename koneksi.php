<?php 
    // Koneksi ke database mysql
    $koneksi = mysqli_connect("localhost", "root", "", "db_tailor");
    // Cek koneksi
    //asasasadvhwvjbwkdj qlknwqasasa
    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>