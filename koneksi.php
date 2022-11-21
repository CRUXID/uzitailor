<?php 
    // Koneksi ke database mysql
    $koneksi = mysqli_connect("localhost", "root", "", "db_tailor");
    // Cek koneksi
    //asasasadvhwvjbwkdj qlknwq
    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>