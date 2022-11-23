<?php 
    require ('../koneksi.php');
    $data       = mysqli_query($koneksi, "SELECT * from master_barang WHERE kode_barang=".$_GET['kode_barang']);
    $data       = mysqli_fetch_array($data, MYSQLI_ASSOC);

    echo json_encode($data);
?>