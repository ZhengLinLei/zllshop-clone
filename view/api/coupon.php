<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    include_once "../../model/model.php";
    include_once "./controller/controller.php";
    include_once "./model/model.php";

    $mvc = new MVCcontrollerAPI();
    $response = $mvc->searchCouponCode($_POST["coupon_code"]);

    if(empty($response)){
        echo '{"response": "empty"}';
    }else{
        if($response[0]["used_by_someone"]){
            echo '{"response": "used"}';
        }else{
            $mvc->checkUsedCoupon($response[0]["id"], $_SESSION["user"]["data"]["wechat_id"]);
            $mvc->incrementUserMoney($_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $response[0]["value_yuan"]);

            $_SESSION["user"]["data"]["money_coin_yuan"] += $response[0]["value_yuan"];
            $_SESSION["user"]["data"]["money_coin_euro"] += number_format($response[0]["value_yuan"]/8, 2, '.', '');

            echo '{"response": 200, "data": {"yuan": "'.$_SESSION["user"]["data"]["money_coin_yuan"].'", "euro": "'.$_SESSION["user"]["data"]["money_coin_euro"].'"}}';
        }
    }
}else{
    echo '{"response": "error_code"}';
}