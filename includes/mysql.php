<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chat";

    $conn = new mysqli($servername, $username, $password, $dbname);

    class Connection{

        public $data;
    
        public function SetQuery($sql){
            global $conn;
            try {
                $conn->query($sql);
            } catch(Exception $e) {
                echo "Connection Error ->".$e;
            }
        }

        public function GetData($sql){
            global $conn;
            
            try {
                $data = $conn->query($sql)->fetch_assoc();
            } catch(Exception $e) {
                $data = "Error ->" . $e;
            } finally{
                return $data;
            }
        }
    }

?>