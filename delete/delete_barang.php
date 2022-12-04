<?php
    include '../koneksi.php';
    include '../header.php';
    $kode_barang   = $_GET['kode_barang'];
    $sql="DELETE FROM master_barang WHERE kode_barang='$kode_barang'";
    mysqli_query($koneksi, $sql);
    $_SESSION["sukses"] = 'Data Berhasil Dihapus';
    header("location:../barang.php");
?>