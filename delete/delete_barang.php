<?php
    include '../koneksi.php';
    $kode_barang   = $_GET['kode_barang'];
    $sql="DELETE FROM master_barang WHERE kode_barang='$kode_barang'";
    if(mysqli_query($koneksi, $sql)):
      echo "<script type='text/javascript'>
        Swal.fire({
          title: 'Berhasil',
          text: 'Data berhasil dihapus',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.value) {
            header('Location: ../barang.php');
          }
        })
      </script>";
      else:
        echo "<script type='text/javascript'>
          Swal.fire({
            title: 'Gagal',
            text: 'Data gagal dihapus',
            icon: 'error',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.value) {
              header('Location: ../barang.php');
            }
          })
        </script>";
    endif;
    header("location:../barang.php");
?>