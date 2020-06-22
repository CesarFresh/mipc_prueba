<?php
    class DB {
        
        private $host = 'localhost';
        private $username = 'root';
        private $password = 'root';
        private $database = 'DB_Univer_Prodesat';
    
        protected function connect(){
            $connect = mysqli_connect($this->host,$this->username,$this->password,$this->database);
            if ($connect -> connect_errno) {
                echo "Failed to connect to MySQL: " . $connect -> connect_error;
                exit();
            } else {
                return $connect;
            }
        }
    }
?>