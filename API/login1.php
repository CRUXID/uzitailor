<?php
//  require ('../koneksi.php');
//  $username = $_POST['username'];
//  $password = $_POST['password'];
//  $sql = "SELECT * FROM `data_pembeli` WHERE username = '".$username."' AND password = '".$password."'";
 

//  $result= mysqli_query($koneksi, $sql);
//  $count = mysqli_num_rows($result);
//     if($count == 1){
//     echo json_encode("berhasil");
//     }
//     else {
//         echo json_encode("error");
//     }

//bisa
 require ('../koneksi.php');
 $username = $_POST['username'];
 $password = $_POST['password'];


    $Login ="SELECT * FROM `data_pembeli`WHERE username = '".$username."'AND password = '".$password."'";
     $resultOfQuery = $koneksi -> query($Login);
        if($resultOfQuery->num_rows > 0) //Allow user to login
 {

    $userRecord = array();
    while($rowFound = $resultOfQuery->fetch_assoc())
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
 

?>