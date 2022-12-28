<?php
    require ('../../koneksi.php');
    $kode = $_POST['kode_transaksi'];
    $kodebrg = $_POST['kode_barang'];
    $qty = $_POST['qty'];
    $total = $_POST['sub_total'];
    $catatan = $_POST['catatan'];
   
   
       $detailtrx ="INSERT INTO `detail_transaksi`(`kode_transaksi`, `kode_barang`, `qty`, `sub_total`, `catatan`) 
       VALUES ('M$kode','$kodebrg','$qty','$total','$catatan')";


      $resultOfQuery = $koneksi -> query($detailtrx);
      if($resultOfQuery){   
        echo json_encode(array("Berhasil" => true));
        }
      else{
        echo json_encode(array("Berhasil" => false));
        }

?>