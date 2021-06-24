<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    function logoutFnc(){
        unset($_SESSION["user"]);

        if(isset($_COOKIE['user']) && isset($_COOKIE['password'])){
            unset($_COOKIE['user']); 
            setcookie('user', null, -1, '/'); 

            unset($_COOKIE['password']); 
            setcookie('password', null, -1, '/'); 
        }
        unset($_SESSION["item_cart"]);
    }
    if($_GET["type"] == "logout"){
        logoutFnc();

        echo '{"response": 200}';
    }else{
        include_once "../../model/model.php";
        include_once "./controller/controller.php";
        include_once "./model/model.php";
        $mvc = new MVCcontrollerAPI();

        if($_GET["type"] == "location"){
            $location = (object) ["name" => $_POST["name"], "surname" => $_POST["surname"],
                                  "mobile" => $_POST["mobile"], "phone" => $_POST["phone"],
                                  "country" => $_POST["country"], "postal" => $_POST["postal"], "province" => $_POST["province"], "city" => $_POST["city"], "address" => $_POST["address"]];
            $location = json_encode($location);
            $mvc->updateUserLocation($_SESSION["user"]["data"]["id"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $location);
            
            $_SESSION["user"]["data"]["user_location"] = $location;
            echo '{"response": 200}';
        }elseif ($_GET["type"] == "password") {
            if($_POST["old_password"] != $_SESSION["user"]["data"]["password"]){
                echo '{"response": "incorrect_password"}';
            }else{
                $mvc->changeUserPassword($_SESSION["user"]["data"]["id"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $_POST["new_password"]);
                $_SESSION["user"]["data"]["password"] = $_POST["new_password"];
                echo '{"response": 200}';
            }
        }elseif($_GET["type"] == "profile"){
            if(isset($_POST['wechat_id']) && !empty($_POST['wechat_id'])){
                $responseIdName = $mvc->findIssetWechatId($_POST["wechat_id"]);
                
                if(empty($responseIdName)){
                    $verify_code = rand();
                    if($mvc->changeUserProfile("wechat_id", $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], [$_POST["wechat_id"], $verify_code])){
                        $_SESSION["account_load"] = ["id" => $_POST["wechat_id"], "verify_code" => $verify_code];
                        logoutFnc();
                        exit('{"response": 200, "data": {"type": "wechat_id", "verify_code": "'.$verify_code.'"}}');
                    }
                }else{
                    exit('{"response": "exist", "data": {"name": "'.$responseIdName[0]["name"].'"}}');
                }
            }else{
                if(isset($_POST['user_name']) && !empty($_POST['user_name'])){
                    $mvc->changeUserProfile("name", $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $_POST["user_name"]);
                    $_SESSION["user"]["data"]["name"] = $_POST["user_name"];
                }
                if(isset($_POST['birthday']) && !empty($_POST['birthday']) && $_SESSION["user"]["data"]["user_birthday"] == "0000-00-00"){
                    $mvc->changeUserProfile("user_birthday", $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $_POST["birthday"]);
                    $_SESSION["user"]["data"]["user_birthday"] = $_POST["birthday"];
                }else{
                    exit('{"response": "error_birthday"}');
                }
                echo '{"response": 200, "data": {"type": "other"}}';
            }
        }elseif($_GET["type"] == "email"){
            if($_GET["content"] == "send"){
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $number_verify = $mvc->changeUserEmail($_POST["email"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"]);
                    if($number_verify){
                        $html = file_get_contents("./data/mail/verify_email.txt");
                        foreach(array_map('intval', str_split($number_verify)) as $index => $value){
                            $html =  str_replace("**&".$index."&**", $value, $html);
                        }
                        if($mvc->sendMail($_POST["email"], "验证码 · ZLLSHOP", "电子邮件验证", $html)){
                            $_SESSION["user"]["data"]["email"] = $_POST["email"];
                            $_SESSION["user"]["data"]["email_verify_code"] = $number_verify;
            
                            echo '{"response": 200, "data": {"email": "'.$_POST["email"].'"}}';
                        }else{
                            echo '{"response": "error", "error": "发送失败"}';
                        }
                    }else{
                        echo '{"response": "error", "error": "系统繁忙，请稍后尝试"}';
                    }
                }else{
                    echo '{"response": "error", "error": "电子邮件不正确"}';
                }
            }elseif($_GET["content"] == "verify_code"){
                if($_POST["verify_code"] == $_SESSION["user"]["data"]["email_verify_code"] && $_POST["email"] == $_SESSION["user"]["data"]["email"]){
                    if($mvc->verifyUserEmail($_POST["verify_code"], $_POST["email"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"])){
                        $_SESSION["user"]["data"]["email_verify_code"] = 0;
                        echo '{"response": 200}';
                    }else{
                        echo '{"response": "error", "error": "验证失败，请重新"}';
                    }
                }else{
                    echo '{"response": "error", "error": "验证码不正确"}';
                }
            }
        }
    }
}else{
    echo '{"response": "error_code"}';
}