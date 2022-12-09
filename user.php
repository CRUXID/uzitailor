<?php 
    include 'koneksi.php';
    $uid = $_SESSION['idk'];
    $data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM karyawan WHERE id_karyawan='$uid'"));
    $usernamek = $data['username'];
    $passwordk = $data['password'];
    $namak = $data['nama_karyawan'];
    $alamatk = $data['alamat_karyawan'];
    $no_hpk = $data['no_hp'];
    $foto = $data['foto_profil'];
    $levelk = $data['level'];
?>