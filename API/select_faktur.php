<?php 
    require ('../koneksi.php');

        $result       = mysqli_query($koneksi,  $query ="SELECT transaksi.kode_transaksi,DATE(transaksi.waktu) AS waktu,
        master_barang.nama_barang,detail_transaksi.catatan,detail_transaksi.sub_total,detail_transaksi.qty,master_barang.harga,transaksi.total,
        transaksi.dibayar,transaksi.sisa_pembayaran 
        FROM detail_transaksi JOIN transaksi ON transaksi.kode_transaksi=detail_transaksi.kode_transaksi
        JOIN master_barang
        ON master_barang.kode_barang = detail_transaksi.kode_barang
        " );
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