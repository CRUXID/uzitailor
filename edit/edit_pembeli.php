<?php
    require ('../koneksi.php');
    // menyimpan data kedalam variabel
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama      = $_POST['nama'];
    $alamat      = $_POST['alamat'];
    $nohp      = $_POST['nohp'];
    // query SQL untuk insert data
    $query="UPDATE data_pembeli SET nama_pembeli='$nama',alamat='$alamat',no_hp='$nohp', username='$username', password='$password'";
    mysqli_query($koneksi, $query);
    // mengalihkan halaman
    header("location:../pembeli.php");
?>