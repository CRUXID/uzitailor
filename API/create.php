<?php 
    $connection = new mysqli("localhost", "root", "", "db_tailor");
    $kodebarang = $_POST['kode_barang']; 
    $namabarang = $_POST['nama_barang'];
    $harga      = $_POST['harga'];
    
    $result = mysqli_query($connection, "INSERT INTO master_barang SET kode_barang='$kodebarang', nama_barang='$namabarang', harga='$harga'");
    
    if($result){
        echo json_encode([
            'message' => 'Data input successfully'
        ]);
    }else{
        echo json_encode([
            'message' => 'Data Failed to input'
        ]);
    }
?>