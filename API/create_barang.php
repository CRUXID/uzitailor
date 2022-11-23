<?php 
    require ('../koneksi.php');
    $kodebarang = $_POST['kode_barang']; 
    $namabarang = $_POST['nama_barang'];
    $hargabarang      = $_POST['harga'];
    
    $result = mysqli_query($koneksi, "INSERT INTO master_barang (kode_barang, nama_barang, harga) VALUES ('$kodebarang', '$namabarang', '$hargabarang')");
    
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