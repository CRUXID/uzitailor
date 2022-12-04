<?php
    include '../koneksi.php';
    $id_karyawan   = $_GET['id_karyawan'];
    $sql="DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'";
    mysqli_query($koneksi, $sql);
    $_SESSION["sukses"] = 'Data Berhasil Dihapus';
    header("location:../akun.php");
?>