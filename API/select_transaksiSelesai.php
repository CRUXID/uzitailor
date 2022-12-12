<?php 
    require ('../koneksi.php');
    $id  = $_POST['id_pembeli'];
        $result       = mysqli_query($koneksi,  $query ="SELECT transaksi.kode_transaksi,DATE(transaksi.waktu) AS waktu,
    master_barang.nama_barang,master_barang.harga,detail_transaksi.qty,transaksi.total,
    transaksi.dibayar,transaksi.sisa_pembayaran 
    FROM detail_transaksi JOIN transaksi ON transaksi.kode_transaksi=detail_transaksi.kode_transaksi
    JOIN master_barang
    ON master_barang.kode_barang = detail_transaksi.kode_barang
    WHERE transaksi.id_pembeli =$id  AND transaksi.status = 4" );
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