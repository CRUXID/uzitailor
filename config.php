<?php 
    class connect {
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "db_tailor";
        protected $konek;

        public function __construct() {
            try {
                $this -> konek = new PDO ("mysql:host=" . $this -> host . ";dbname=" . $this -> db, $this -> user, $this -> pass);
                $this -> konek -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e -> getMessage();
            } return $this -> konek;
        }
    }
?>