<?php
    include '../koneksi.php';
    $id_pembeli   = $_GET['id_pembeli'];
    $sql="DELETE FROM data_pembeli WHERE id_pembeli='$id_pembeli'";
    if(mysqli_query($koneksi, $sql)):
        echo 'Berhasil Menghapus Data Pembeli';
      else:
        echo 'Gagal Menghapus Data Pembeli';
    endif;
    header("location:../pembeli.php");
?>