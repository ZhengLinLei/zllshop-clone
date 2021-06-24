<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    //Empty cart
    if(!isset($_SESSION["item_cart"])){
        $_SESSION["item_cart"] = [];
    }
    if($_GET["type"] == "add"){
        $data_json = json_decode($_POST["data"]);
        
        array_push($_SESSION["item_cart"], $data_json);
        
        $response = '{ "response": 200, "data":';
        $response .= $_POST["data"];
        $response .= '}';
        
        echo $response;
    }else
    if($_GET["type"] == "remove" || $_GET["type"] == "delete_all"){
        if(isset($_SESSION["item_cart"])){
            if($_GET["type"] == "delete_all"){
                $_SESSION["item_cart"] = [];
        
                echo '{"response": "200"}';
            }else
            if($_GET["type"] == "remove"){
                try {
                    array_splice($_SESSION["item_cart"], $_POST["id"], 1);
        
                    echo '{"response": 200, "id": '.$_POST["id"].'}';
                } catch (Exception $e) {
                    echo '{"response": "unexpected_index_'.$_POST["id"].'"}';
                }
            }
        }else{
            echo '{"response": "error_empty_cart"}';
        }
    }else
    if($_GET["type"] == "search"){
        if($_POST["id"] == 0){
            echo '{"response": 0}';
        }else{
            include_once "../../controller/controller.php";
            include_once "../../model/model.php";
            $mvc = new MVCcontroller();
            $data = $mvc->searchDataCategoryById($_POST["id"]);
            if(!empty($data->data)){
                echo '{"response": 200, "data": {"title": "'.$data->data[0][0]["item_name"].'", "img": "'.json_decode($data->data[0][0]["item_image"])->image[0].'"}}';
            }else{
                echo '{"response": "empty"}';
            }
        }
    }else{
        echo '{"response": "unexpected_type"}';
    }
    //Update Cart
    if(isset($_SESSION["user"]) && $_SESSION["user"]["login"]){
        include_once "../../model/model.php";
        include_once "./controller/controller.php";
        include_once "./model/model.php";
        $mvc = new MVCcontrollerAPI();

        if($mvc->updateUserCart($_SESSION["user"]["data"]["id"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"])){
            $_SESSION["user"]["data"]["user_cart"] = $_SESSION["item_cart"];
        }
    }else{
        //Set Item Cart Cookie
        $json = json_encode($_SESSION["item_cart"]);
        setcookie('item_cart', $json, time() + (86400 * 30), "/");
    }
}else{
    echo '{"response": "error_code"}';
}