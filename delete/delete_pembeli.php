<?php
    include '../koneksi.php';
    $id_pembeli   = $_GET['id_pembeli'];
    $sql="DELETE FROM data_pembeli WHERE id_pembeli='$id_pembeli'";
    mysqli_query($koneksi, $sql);
    $_SESSION["sukses"] = 'Data Berhasil Dihapus';
    header("location:../pembeli.php");
?>