<?php 
    $Ahost = "localhost";
    $Auser = "root";
    $Apass = "";
    $Adb = "db_tailor";

    //make connection mysql
    $koneksi = mysqli_connect($Ahost, $Auser, $Apass, $Adb);
    //check connection msyql
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    class conn {
        private $host = $Ahost;
        private $user = $Auser;
        private $pass = $Apass;
        private $db = $Adb;
        protected $conn;

        public function __construct() {
            try {
                $this -> conn = new PDO ("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
                $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e -> getMessage();
            } return $this -> conn;
        }
    }
    
    //set timezone
    date_default_timezone_set('Asia/Jakarta');
?>