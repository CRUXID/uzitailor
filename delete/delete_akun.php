<?php
    include '../koneksi.php';
    $id_karyawan   = $_GET['id_karyawan'];
    $sql="DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'";
    if(mysqli_query($koneksi, $sql)):
        echo 'Berhasil Menghapus Data Akun';
      else:
        echo 'Gagal Menghapus Data Akun';
    endif;
    header("location:../akun.php");
?>