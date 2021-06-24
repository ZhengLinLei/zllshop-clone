<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();
    $response = "";
    if(!empty($_POST["role"])){
        if($mvc->update_user_range_role("role", $_POST["id"], $_POST["role"])){
            $response .= '{"response":200}';
        }else{
            $response .= '{"response":"error_role_db"}';
        }
    }
    if(!empty($_POST["range"])){
        if($mvc->update_user_range_role("range", $_POST["id"], $_POST["range"])){
            $response .= '{"response":200}';
        }else{
            $response .= '{"response":"error_range_db"}';
        }
    }
    echo $response;
}else{
    echo '{"response": "error_code"}';
}