<?php 
    require ('../../koneksi.php');
    $id  = $_POST['id_pembeli']; 
    $result = mysqli_query( $koneksi,"SELECT kode_transaksi,
        DATE(transaksi.waktu) AS waktu,total FROM transaksi WHERE status = 3  AND id_pembeli = $id ");

    while ($row3 = mysqli_fetch_assoc($result)) {
    $fetch = mysqli_query($koneksi,"SELECT master_barang.nama_barang,master_barang.kode_barang,
    detail_transaksi.qty,detail_transaksi.sub_total, transaksi.id_pembeli FROM detail_transaksi JOIN master_barang 
         ON detail_transaksi.kode_barang = master_barang.kode_barang
         JOIN transaksi ON transaksi.kode_transaksi = detail_transaksi.kode_transaksi 
         WHERE detail_transaksi.kode_transaksi = '$row3[kode_transaksi]' AND transaksi.id_pembeli = $id AND transaksi.status = 3  "); 
    
        $json2 = array();
        while ($row = mysqli_fetch_assoc($fetch)){
            $json2[] = array( 
                'nama_barang' => $row["nama_barang"],
                'kode_barang' => $row["kode_barang"],
                'qty' => $row["qty"],
                'sub_total' => $row["sub_total"],
                'id_pembeli' => $row["id_pembeli"],
            );
        }
        $json [] = array (
            'kode_transaksi' => $row3["kode_transaksi"],
            'waktu' => $row3["waktu"],
            'total' => $row3["total"],
            'barang' => $json2,
        );
    }if (empty($json)) {
        echo json_encode ("Tidak ada transaksi");
    }
    else {
        echo json_encode($json);
    }   
   

// I think, you'll get a single row, so no need to loop
//$json = mysqli_fetch_array($result, MYSQLI_ASSOC);


?>