<?php
session_start();
//Require files
require_once "./controller/controller.php";
require_once "./model/model.php";

$mvc = new MVCcontroller();

if(!isset($_SESSION["PWA"]["version"]) || empty($_SESSION["PWA"]["version"]) || empty($_SESSION["PWA"]["update_date"])){
    $_SESSION["PWA"]["version"] = '1.2.10';
    $_SESSION["PWA"]["update_date"] = '2021-01-16';
}
if(!isset($_SESSION['db']['total']) || empty($_SESSION['db']['total'])){
    $_SESSION['db']['total'] = $mvc->getTotalRows("item")[0]['id'];
}
//USER
if(isset($_COOKIE["user"]) && isset($_COOKIE["password"]) && !isset($_SESSION["user"]) && empty($_SESSION["user"])){
    include_once "./view/api/controller/controller.php";
    include_once "./view/api/model/model.php";

    $mvcAPI = new MVCcontrollerAPI();
    $login = $mvcAPI->loginUser($_COOKIE["user"], base64_decode(base64_decode($_COOKIE["password"])));
    if(!empty($login)){
        $mvcAPI->createUserSession($login);
    }else{
        if(isset($_SESSION["user"])){
            unset($_SESSION["user"]);
        }else{
            unset($_COOKIE['user']); 
            setcookie('user', null, -1, '/'); 

            unset($_COOKIE['password']); 
            setcookie('password', null, -1, '/'); 
        }
    }
}else{
    if((isset($_COOKIE["item_cart"]) && !empty($_COOKIE["item_cart"])) && !isset($_SESSION["item_cart"])){
        $_SESSION["item_cart"] = json_decode($_COOKIE["item_cart"]);
    }
}

$mvc->include_template();
