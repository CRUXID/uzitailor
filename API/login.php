<?php 
  require ('../koneksi.php');

  $return["error"] = false;
  $return["message"] = "";
  $return["success"] = false;

  if(isset($_POST["username"]) && isset($_POST["password"])){
       //checking if there is POST data
       $username = $_POST['username'];
       $password = $_POST['password'];

       $username = mysqli_real_escape_string($koneksi, $username);
       //escape inverted comma query conflict from string

       $sql = "SELECT * FROM data_pembeli WHERE username = '$username'";
       //building SQL query
       $res = mysqli_query($koneksi, $sql);
       $numrows = mysqli_num_rows($res);
       //check if there is any row
       if($numrows > 0){
           //is there is any data with that username
           $obj = mysqli_fetch_object($res);
           //get row as object
           if(md5($password) == $obj->password){
               $return["success"] = true;
               $return["message"] = "JANCOK";
           }else{
               $return["error"] = true;
               $return["message"] = "Your Password is Incorrect.";
           }
       }else{
           $return["error"] = true;
           $return["message"] = 'No username found.';
       }
  }else{
      $return["error"] = true;
      $return["message"] = 'Send all parameters.';
  }

  mysqli_close($koneksi);

  header('Content-Type: application/json');
  // tell browser that its a json data
  echo json_encode($return);
  //converting array to JSON string
?>