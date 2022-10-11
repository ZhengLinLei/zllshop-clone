<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["admin_security_token"]){
    $user = "zhenglinlei";
    $password = "Zheng9112003";
    if($_POST["user"] == $user && $_POST["password"] == $password){
        $_SESSION["admin"] = true; 
        echo '{"response": 200}';
    }else{
        echo '{"response": "incorrect_data"}';
    }
}else{
    echo '{"response": "error_code"}';
}