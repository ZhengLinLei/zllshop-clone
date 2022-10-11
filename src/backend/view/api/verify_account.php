<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();
    try {
        $text = $_POST["text_verify"];
        $text = explode(",",$text);
        $id = explode("微信ID是", $text[0]);
        $code = explode("验证码是", $text[1]);

        $text[0] = trim(end($id));
        $text[1] = trim(end($code));
    } catch (Exception $e) {
        die($e->getMessage());
    }
    if($mvc->verify_new_account([$text[0], $text[1]], ((isset($_POST['admin']) && $_POST['admin'] == "on")?true:false))){
        $invited_by = $mvc->get_user_data($text[0]);
        if(!empty($invited_by)){
            echo '{"response": 200, "invited_by": "'.$invited_by[0]["invited_by"].'"}';
        }else{
            echo '{"response": "not_exist_user_error"}';
        }
    }else{
        echo '{"response": "error"}';
    }
}else{
    echo '{"response": "error_code"}';
}