<?php
    session_start();
    include "../../includes/mysql.php";

    $name = $_REQUEST['name'];
    $gender_id = $_REQUEST['gender_id'];
    $parnter_gender_id = $_REQUEST['partner_gender_id']; 

    $sql = "SELECT COUNT(*) AS count FROM users WHERE name = '$name'  LIMIT 1";

    $userChecker = $conn->query($sql)->fetch_assoc()['count'];

    if($userChecker > 0){
        echo 1;
    }
    else if($userChecker == 0){

        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";

        $id = $conn->query($sql)->fetch_assoc()['id'];
        
        $_SESSION["user_id"] = $id;
        $_SESSION["gender_id"] = $gender_id;
        $_SESSION["parnter_gender_id"] = $parnter_gender_id;
        
        echo 2;

        $sql = "INSERT INTO users 	(name, gender_id, partner_gender_id)
                VALUES 	    ('$name', $gender_id, $parnter_gender_id) ";

        $result = $conn->query($sql);
    }


?>