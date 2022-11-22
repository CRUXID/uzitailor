<?php
class crud extends koneksi {
    public function lihatBarang()
    {
        $sql ="SELECT kode_barang, nama_barang, harga FROM master_barang";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function insertBarang($kodebarang, $namabarang, $hargabarang)
    {
        try
        {
            $sql="INSERT INTO master_barang(kode_barang, nama_barang, harga) VALUES (:kodebarang, :namabarang, :hargabarang)";
            $result=$this->koneksi->prepare($sql);
            $result->bindParam(":kodebarang", $kodebarang);
            $result->bindParam(":namabarang", $namabarang);
            $result->bindParam(":hargabarang", $hargabarang);
            $result->execute();
            return true;
        }
        catch(PDOException $e)
        {
         echo $e->getMessage();
         return false;   
        }
    }
}
?>