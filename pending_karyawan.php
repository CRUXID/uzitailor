<?php 
    include 'koneksi.php';
    $noinv = $_GET['detail'];
    $tgljadi = $_GET['jadi'];

    if(!empty($_GET['detail'])){
    } else {
        echo '<script>history.go(-1);</script>';
    }; 

    $query="UPDATE `transaksi` SET `status`='3',`tgl_jadi`='$tgljadi' WHERE kode_transaksi='$noinv'";
    if(mysqli_query($koneksi, $query)):
        echo '<script>window.location.href = "progress_karyawan.php";</script>';
    endif;
?>