<?php 
    require ('../koneksi.php');
    $data       = mysqli_query($koneksi, "SELECT * FROM master_barang");
    $data       = mysqli_fetch_all($data, MYSQLI_ASSOC);

    echo json_encode($data);
?>