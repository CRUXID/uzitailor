<?php
class crud extends connect {

    public function login($username,$password)
    {
        try
        {
            $sql="SELECT * FROM karyawan WHERE username=:username AND password=:password";
            $result=$this->konek->prepare($sql);
            $result->bindParam(":username",$username);
            $result->bindParam(":password",$password);
            $result->execute();
            $row=$result->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount()>0)
            {
                $_SESSION['login'] = "login";
                $_SESSION['username'] = $row['username'];
                $_SESSION['idk'] = $row['id_karyawan'];
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
         echo $e->getMessage();
         return false;   
        }
    }

    public function selectBarang()
    {
        $sql ="SELECT kode_barang, nama_barang, harga FROM master_barang";
        $result = $this->konek->prepare($sql);
        $result->execute();
        return $result;
    }

    public function tambahBarang($kode_barang, $nama_barang, $harga)
    {
        $sql = "INSERT INTO master_barang (kode_barang, nama_barang, harga) VALUES (:kode_barang, :nama_barang, :harga)";
        $result = $this->konek->prepare($sql);
        $result->bindParam(":kode_barang", $kode_barang);
        $result->bindParam(":nama_barang", $nama_barang);
        $result->bindParam(":harga", $harga);
        $result->execute();
        return $result;
    }

    public function ubahBarang($kode_barang, $nama_barang, $harga)
    {
        $sql = "UPDATE master_barang SET nama_barang = :nama_barang, harga = :harga WHERE kode_barang = :kode_barang";
        $result = $this->konek->prepare($sql);
        $result->bindParam(":kode_barang", $kode_barang);
        $result->bindParam(":nama_barang", $nama_barang);
        $result->bindParam(":harga", $harga);
        $result->execute();
        return $result;
    }

    public function tambahPembeli($nama_pembeli, $alamat, $no_hp)
    {
        $sql = "INSERT INTO data_pembeli (nama_pembeli, alamat, no_hp) VALUES (:nama_pembeli, :alamat, :no_hp)";
        $result = $this->konek->prepare($sql);
        $result->bindParam(":nama_pembeli", $nama_pembeli);
        $result->bindParam(":alamat", $alamat);
        $result->bindParam(":no_hp", $no_hp);
        $result->execute();
        return $result;
    }

    public function ubahPembeli($id_pembeli, $nama_pembeli, $alamat, $no_hp)
    {
        $sql = "UPDATE data_pembeli SET nama_pembeli = :nama_pembeli, alamat = :alamat, no_hp = :no_hp WHERE id_pembeli = :id_pembeli";
        $result = $this->konek->prepare($sql);
        $result->bindParam(":id_pembeli", $id_pembeli);
        $result->bindParam(":nama_pembeli", $nama_pembeli);
        $result->bindParam(":alamat", $alamat);
        $result->bindParam(":no_hp", $no_hp);
        $result->execute();
        return $result;
    }
}
?>