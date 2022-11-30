<?php
    require ('../koneksi.php');
    // menyimpan data kedalam variabel
    $kodebarang = $_POST['kode'];
    $namabarang = $_POST['nama'];
    $harga      = $_POST['harga'];
    // query SQL untuk insert data
    $query="UPDATE master_barang SET kode_barang='$kodebarang',nama_barang='$namabarang',harga='$harga' WHERE kode_barang='$kodebarang'";
    mysqli_query($koneksi, $query);
    // mengalihkan halaman
    header("location:../barang.php");
?>