<?php
    // class DB{
    //     static $servername = "localhost";
    //     static $username = "root";
    //     static $password = "";
    //     static $dbname = "localhost";
    
    //     // Create connection
    //     static $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    // }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chat";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

?>