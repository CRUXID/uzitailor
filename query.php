<?php
class crud extends connect {

    public function selectBarang()
    {
        $sql ="SELECT kode_barang, nama_barang, harga FROM master_barang";
        $result = $this->konek->prepare($sql);
        $result->execute();
        return $result;
    }

}
?>