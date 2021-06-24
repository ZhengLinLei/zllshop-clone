<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    include_once "../../model/model.php";
    include_once "./controller/controller.php";
    include_once "./model/model.php";

    $mvc = new MVCcontrollerAPI();
    
    if($_GET["type"] == "get"){
        if($_SESSION["user"]["data"]["can_get_points"] && ((date("Ymd") - date("Ymd", strtotime($_SESSION["user"]["data"]["daily_points_date"]))) > 0)){
            $num = (($_SESSION["user"]["data"]["today_birthday"])?50:10);
            if($mvc->getPoints($num, $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"])){
                $_SESSION["user"]["data"]["daily_points"] += $num;
                $_SESSION["user"]["data"]["daily_points_date"] = date('Y-m-d', time());
                $_SESSION["user"]["data"]["can_get_points"] = false;

                echo '{"response": 200, "data": {"points": '.$_SESSION["user"]["data"]["daily_points"].'}}';
            }
        }else{
            echo '{"response": "error"}';
        }
    }elseif($_GET["type"] == "change"){
        $rmb = 16;
        $points = 250;

        $pointsUser = $_SESSION["user"]["data"]["daily_points"];

        if($pointsUser >= 50){
            $changeRMB = round(floatval(($pointsUser * $rmb)/$points), 2);;
            $changeEUR = number_format($changeRMB/8, 2, '.', '');

            if($mvc->changePoints(round(floatval($changeRMB), 2), $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"])){
                $_SESSION["user"]["data"]["daily_points"] = 0;
                $_SESSION["user"]["data"]["money_coin_yuan"] += $changeRMB;
                $_SESSION["user"]["data"]["money_coin_euro"] += $changeEUR;

                echo '{"response": 200, "data": {"rmb": '.$changeRMB.', "euro": '.$changeEUR.', "points": '.$pointsUser.'}}';
            }else{
                echo '{"response": "error_db"}';
            }
        }else{
            '{"response": "error_points"}';
        }
    }
}else{
    echo '{"response": "error_code"}';
}