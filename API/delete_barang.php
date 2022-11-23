<?php 
    require ('../koneksi.php');
    $kodebarang = $_POST['kode_barang']; 
    
    $result = mysqli_query($koneksi, "DELETE FROM master_barang WHERE kode_barang='$kodebarang'");
    
    if($result){
        echo json_encode([
            'message' => 'Data Delete successfully'
        ]);
    }else{
        echo json_encode([
            'message' => 'Data Failed to Delete'
        ]);
    }
?>