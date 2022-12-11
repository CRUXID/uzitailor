<?php
class crud extends koneksi {

    public function selectBarang()
    {
        $sql ="SELECT kode_barang, nama_barang, harga FROM master_barang";
        $result = $this->koneksi->prepare($sql);
        $result->execute();
        return $result;
    }

    public function insertBarang($email, $pass, $name)
    {
        try
        {
            $sql="INSERT INTO user_detail(user_email, user_password, user_fullname, level) VALUES (:email, :pass, :name, 2)";
            $result=$this->koneksi->prepare($sql);
            $result->bindParam(":email",$email);
            $result->bindParam(":pass", $pass);
            $result->bindParam(":name", $name);
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