<?php
    require ('../koneksi.php');
    if($_SERVER['REQUEST_METHOD'] == "POST"):
        $response = array();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek = "SELECT * FROM data_pembeli WHERE username='$username' and password='$password'";
        $result = mysqli_fetch_array(mysqli_query($koneksi, $cek));

        if(isset($result)):
            $response['value'] = 1;
            $response['message'] = 'Login Berhasil';
            echo json_encode($response);
        else:
            $response['value'] = 0;
            $response['message'] = "login gagal";
            echo json_encode($response);
        endif;
    endif;
?>