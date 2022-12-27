<?php
 //bisa
 require ('../../koneksi.php');
	$nama = $_POST['nama_pembeli'];
	$username = $_POST['username'];
	$nohp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
    $password = $_POST['password'];

	$link="UPDATE data_pembeli SET nama_pembeli = '".$nama."',username = '".$username."',no_hp = 
    '".$nohp."',alamat = '".$alamat."', password = '".$password."' WHERE username = '".$username."'";
    $resultOfQuery = $koneksi -> query($link);
    if($resultOfQuery){   
        $Login ="SELECT * FROM `data_pembeli`WHERE username = '".$username."'";
     $rst = $koneksi -> query($Login);
        if($rst->num_rows > 0) //Allow user to login
 {

    $userRecord = array();
    while($rowFound = $rst->fetch_assoc())
    {
        $userRecord[] = $rowFound;
        // $userRecord = $rowFound;
    }

    echo json_encode(
        array(
            "Berhasil" => true,
            "userData" => $userRecord[0],
        ));
      }
 else{
    echo json_encode(array("Berhasil" => false));
 }
}
    
    
    // if($resultOfQuery->num_rows > 0) //Allow user to login
    // {
   
    //    $userRecord = array();
    //    while($rowFound = $resultOfQuery->fetch_assoc())
    //    {
    //        $userRecord[] = $rowFound;
    //        // $userRecord = $rowFound;
    //    }
   
    //    echo json_encode(
    //        array(
    //            "Berhasil" => true,
    //            "userData" => $userRecord[0],
    //        ));
    //      }
    // else{
    //    echo json_encode(array("Berhasil" => false));
    // }

?>