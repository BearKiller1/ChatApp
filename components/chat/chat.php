<?php
    session_start();
    include "../../includes/mysql.php";

    $data = array();
    $user = $_SESSION["user_id"];

    $chat   = new Chat();
    $method = $_REQUEST["method"];
    $chat->$method();

    class Chat {

        public function GetPartner(){
            global $conn;
            global $data;
            $my_gender = $_SESSION["gender_id"];
            $partner_gender = $_SESSION['parnter_gender_id'];

            $sql = "SELECT * 
                    FROM    users
                    WHERE   users.gender_id = $partner_gender 
                    AND partner_gender_id = $my_gender 
                    AND status_id = 4 LIMIT 1";

            $partner = $conn->query($sql)->fetch_assoc();

            if($partner == NULL || $partner == ""){
                $data["result"] = 0;
            }
            else{
                $data["result"] = 1;
                // Here We Want to:
                //  1. output that partner is found
                //  2. Create new chat 
                //  3. Add this Found partner and user both in that chat
                //  4. update partners and users status to 2 (onchat)
            }
        }

        public function ChangeStatus(){
            $status = $_REQUEST["status"];
            global $conn;
            global $user;
            $sql = "UPDATE users SET status_id = $status WHERE id = $user";
            $partner = $conn->query($sql)->fetch_assoc();
        }
    }

    echo json_encode(["result" => $data["result"]]);


    // $sql = "SELECT * FROM products";

    // $result = $conn->query($sql);
    // foreach ($result as $key => $value) {
    //     var_dump($value);
    // }
?>