<?php
//bisa
 require ('../koneksi.php');
 $username = $_POST['username'];
 $password = $_POST['password'];
 $nama = $_POST['nama_pembeli'];
 $alamat = $_POST['alamat'];
 $nohp = $_POST['no_hp'];


    $insert ="INSERT INTO `data_pembeli`(`id_pembeli`, `nama_pembeli`, `alamat`, `no_hp`, `username`, `password`) 
    VALUES ('','$nama','$alamat','$nohp','$username','$password')";
     $resultOfQuery = $koneksi -> query($insert);

     if($resultOfQuery ){
        echo json_encode(array("Berhasil" => true));
     }
     else{
        echo json_encode(array("Berhasil" => false));
     }

?>