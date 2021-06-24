<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    if($_POST["password"] == "Zheng_9112003"){
        include_once "../../controller/controller.php";
        include_once "../../model/model.php";
        $db = new DbManageModel();
        $query = $_POST["sql"];
        $response = $db->query($query, [], ((strpos($_POST["sql"], "SELECT") === 0)?true:false));

        if($response){
            print_r($response);
        }else{
            echo '{"response": "error"}';
        }
    }else{
        echo '{"response": "error_password_sql"}';
    }
}else{
    echo '{"response": "error_code"}';
}