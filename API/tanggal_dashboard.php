<?php 
    require ('../koneksi.php');
        $result       = mysqli_query($koneksi,  $query ="SELECT kode_transaksi,tgl_jadi FROM 
        `transaksi` WHERE id_pembeli = 45 ORDER BY `tgl_jadi` ASC " );
    $list       = array();
    if($result) {
        while ($row = mysqli_fetch_assoc($result)){
            $list[]=$row;
        }
        echo json_encode($list);
    }

    // require ('../koneksi.php');
    // $id=$_POST['id_pembeli'];
    // $data       = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pembeli = $id" );
    // $data       = mysqli_fetch_all($data, MYSQLI_ASSOC);

    // echo json_encode($data);
?>