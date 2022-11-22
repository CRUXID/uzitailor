<?php
class crud extends koneksi {
    public function lihatBarang()
    {
        $sql ="SELECT kode_barang, nama_barang, harga FROM master_barang";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatPembelli()
    {
        $sql ="SELECT * FROM data_pembeli";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatProgress()
    {
        $sql ="SELECT transaksi.kode_transaksi, transaksi.waktu, tanggal_jadi, 
        status_transaksi FROM status JOIN transaksi ON transaksi.kode_transaksi=status.kode_transaksi WHERE status_transaksi!='Selesai'";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatLaporan()
    {
        $sql ="SELECT transaksi.kode_transaksi,data_pembeli.nama_pembeli, transaksi.waktu,status.tanggal_jadi,transaksi.total 
        FROM 
        transaksi JOIN status ON transaksi.kode_transaksi=status.kode_transaksi 
        JOIN data_pembeli ON data_pembeli.id_pembeli = transaksi.id_pembeli
        WHERE status.status_transaksi='Selesai'";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function lihatAkun()
    {
        $sql ="select username, nama_karyawan, alamat_karyawan, jenis_kelamin, no_hp, level from karyawan where level != 'Admin'";
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

    public function insertPembeli($idpembeli, $namapembeli, $alamat, $nohp )
    {
        try
        {
            $sql="INSERT INTO data_pembeli(nama_pembeli, alamat, nohp) VALUES (:namapembeli, :alamat, :nohp)";
            $result=$this->koneksi->prepare($sql);
            $result->bindParam(":namapembeli", $namapembeli);
            $result->bindParam(":alamat", $alamat);
            $result->bindParam(":nohp", $nohp);
            $result->execute();
            return true;
        }
        catch(PDOException $e)
        {
         echo $e->getMessage();
         return false;   
        }
    }

    public function insertKaryawan($username, $namakaryawan, $jeniskelamin, $nohp, $password, $level )
    {
        try
        {
            //kurang foto profil
            $sql="INSERT INTO karyawan(username, nama_karyawan,alamat_karyawan,jenis_kelamin, no_hp, password, level) 
            VALUES (:username, :namakaryawan, :alamatkaryawan, :jeniskelamin, :nohp, :password, :level)";
            $result=$this->koneksi->prepare($sql);
            $result->bindParam(":username", $namapembeli);
            $result->bindParam(":namakaryawan", $namapembeli);
            $result->bindParam(":alamatkaryawan", $alamat);
            $result->bindParam(":jeniskelamin", $nohp);
            $result->bindParam(":nohp", $nohp);
            $result->bindParam(":password", $password);
            $result->bindParam(":level", $level);
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