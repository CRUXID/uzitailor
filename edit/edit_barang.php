<?php 
    $kodebarang = $_POST['kode_barang'];
    //query untuk insert data
    $data = mysqli_query($koneksi,"SELECT kode_barang, nama_barang, harga FROM master_barang WHERE kode_barang='$kodebarang'");
    $d = mysqli_fetch_array($data)
?>