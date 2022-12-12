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
}
?>