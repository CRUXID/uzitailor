<?php 
    require ('../koneksi.php');
    $kodebarang = $_POST['kode_barang']; 
    $namabarang = $_POST['nama_barang'];
    $hargabarang      = $_POST['harga'];
    
    $result = mysqli_query($koneksi, "");
    
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