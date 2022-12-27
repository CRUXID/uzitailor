<?php
    require ('../../koneksi.php');
    $kode = $_POST['kode_transaksi'];
    $waktu = $_POST['waktu'];
    $pembeli = $_POST['id_pembeli'];
    $total = $_POST['total'];
   
   
       $trx ="INSERT INTO `transaksi`(`kode_transaksi`, `waktu`, `karyawan`, `id_pembeli`, `total`, `dibayar`, `sisa_pembayaran`, `status`, `tgl_jadi`)
        VALUES ('M$kode','$waktu',NULL,'$pembeli','$total',NULL,NULL,'1',NULL)";
$resultOfQuery = $koneksi -> query($trx);
if($resultOfQuery){   
    echo json_encode(array("Berhasil" => true));
  }
else{
    echo json_encode(array("Berhasil" => false));
}

 ?>