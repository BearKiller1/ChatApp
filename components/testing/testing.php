<?php
    include "../../includes/mysql.php";
    $db = new Connection();

    $data = $db->GetData("SELECT * FROM users");
    
    var_dump($data);

?>