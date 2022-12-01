<?php 
    require ('../koneksi.php');
    $kodebarang = $_POST['kode_barang']; 
    $namabarang = $_POST['nama_barang'];
    $harga      = $_POST['harga'];
    
    $result = mysqli_query($koneksi, "UPDATE master_barang SET kode_barang='$kodebarang',nama_barang='$namabarang',harga='$harga' WHERE kode_barang='$kodebarang'");
    
    if($result){
        echo json_encode([
            'message' => 'Data Update successfully'
        ]);
    }else{
        echo json_encode([
            'message' => 'Data Failed to Update'
        ]);
    }
?>