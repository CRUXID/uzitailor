<?php 
    require ('../koneksi.php');
    $id  = $_POST['id_pembeli'];
    // $tgl = $get['tgl'];
    $data       = mysqli_query($koneksi,  $query ="SELECT DATE_FORMAT( MIN(tgl_jadi), '%d %M %Y') AS tanggal FROM transaksi WHERE id_pembeli = $id" );
    $data       = mysqli_fetch_all($data, MYSQLI_ASSOC);
    echo json_encode($data);
    
    
    // require ('../koneksi.php');
    // $id=$_POST['id_pembeli'];
    // $data       = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pembeli = $id" );
    // $data       = mysqli_fetch_all($data, MYSQLI_ASSOC);

    // echo json_encode($data);
?>