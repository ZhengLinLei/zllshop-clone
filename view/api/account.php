<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    include_once "../../model/model.php";
    include_once "./controller/controller.php";
    include_once "./model/model.php";

    if($_GET["type"] == "register"){
        $mvc = new MVCcontrollerAPI();
        $responseIdName = $mvc->findIssetWechatId($_POST["wechat_id"]);

        if(empty($responseIdName)){
            $number_verify = $mvc->createUser($_POST["wechat_id"], $_POST["name"], $_POST["password"], (isset($_POST["inv"])?$_POST["inv"]:NULL));
            if($number_verify){
                $_SESSION["account_load"] = ["id" => $_POST["wechat_id"], "verify_code" => $number_verify];

                echo '{"response": 200, "data": {"verify_code": '.$number_verify.'}}';
            }else{
                echo '{"response": "error_520"}';
            }
        }else{
            echo '{"response": "exist", "data": {"name": "'.$responseIdName[0]["name"].'"}}';
        }
    }elseif($_GET["type"] == "login"){
        $mvc = new MVCcontrollerAPI();
        $login = $mvc->loginUser($_POST["wechat_id"], $_POST["password"]);

        if(empty($login)){
            echo '{"response": "empty"}';
        }else{
            if($login[0]["verify_code"] != 0){
                $_SESSION["account_load"] = ["id" => $login[0]["wechat_id"], "verify_code" => $login[0]["verify_code"]];
                echo '{"response": "verify", "data":{"verify_code": '.$login[0]["verify_code"].'}}';
            }else{
                $mvc->createUserSession($login);
                
                if($_POST["autologin"] == "true"){
                    setcookie("user", $login[0]["wechat_id"], time()+2629800, "/");
                    setcookie("password", base64_encode(base64_encode($login[0]["password"])), time()+2629800, "/");
                }
                echo '{"response": 200, "data":{"autologin": '.$_POST["autologin"].'}}';
            }
        }
    }
}else{
    echo '{"response": "error_code"}';
}