
<?php
//bisa
include '../koneksi.php';
$userEmail = $_POST ['username'];

$sqlQuery = "SELECT * FROM data_pembeli WHERE username='$userEmail'";

$resultOfQuery = $koneksi -> query($sqlQuery);

 if($resultOfQuery->num_rows > 0){
    echo json_encode(array("user" => true));
 }
 else{
    echo json_encode(array("user" => false));
 } 