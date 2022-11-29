<?php
    include '../koneksi.php';
    $kode_barang   = $_GET['kode_barang'];
    $sql="DELETE FROM master_barang WHERE kode_barang='$kode_barang'";
    if(mysqli_query($koneksi, $sql)):
        echo 'Berhasil Menghapus Data Barang';
      else:
        echo 'Gagal Menghapus Data Barang';
    endif;
    header("location:../barang.php");
?>