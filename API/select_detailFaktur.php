<?php 
    require ('../../koneksi.php');
    $id  = $_POST['id_pembeli']; 
    $kode = $_POST['kode_transaksi'];
    $result = mysqli_query( $koneksi,"SELECT kode_transaksi,
        DATE(transaksi.waktu) AS waktu,total,dibayar,tgl_jadi FROM transaksi WHERE status = 3  AND kode_transaksi = '$kode'AND id_pembeli = $id ");

    $fetch = mysqli_query($koneksi,"SELECT master_barang.nama_barang,master_barang.kode_barang,master_barang.harga,
    detail_transaksi.qty,detail_transaksi.sub_total, transaksi.id_pembeli,detail_transaksi.catatan FROM detail_transaksi JOIN master_barang 
         ON detail_transaksi.kode_barang = master_barang.kode_barang
         JOIN transaksi ON transaksi.kode_transaksi = detail_transaksi.kode_transaksi 
         WHERE detail_transaksi.kode_transaksi = '$kode' AND transaksi.id_pembeli = $id AND transaksi.status = 3  "); 
    
    $json = mysqli_fetch_array($result, MYSQLI_ASSOC);

$json2 = array();
while ($row = mysqli_fetch_assoc($fetch)){
    $json2[] = array( 
               'nama_barang' => $row["nama_barang"],
                'kode_barang' => $row["kode_barang"],
                'harga' => $row["harga"],
                'qty' => $row["qty"],
                'sub_total' => $row["sub_total"],
                'id_pembeli' => $row["id_pembeli"],
                'catatan' => $row["catatan"],
    );
}
    if (empty($json)) {
        echo json_encode ("Tidak ada transaksi");
    }
    else {
        $json['barang'] = $json2;
        echo json_encode($json);
    }
    //$json['barang'] = $json2;

        
        
   

// I think, you'll get a single row, so no need to loop
//$json = mysqli_fetch_array($result, MYSQLI_ASSOC);


?>