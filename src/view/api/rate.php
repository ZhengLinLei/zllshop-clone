<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["security_token"]) && isset($_POST["code"]) && $_POST["code"] == $_SESSION["security_token"]){
    include_once "../../model/model.php";
    include_once "./controller/controller.php";
    include_once "./model/model.php";
    $mvc = new MVCcontrollerAPI();
    if($_GET["type"] == "app" || $_GET["type"] == "buy"){
        if($_POST['rate'] <= 5){
            if($_GET["type"] == "app"){
                if($mvc->rateAPP([$_POST["rate"], $_POST["comment"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["name"]])){
                    $_SESSION["user"]["data"]["rated"] = true;
                    include_once "../../controller/controller.php";
                    $_SESSION["rate"]["app"] = MVCcontroller::getAPPRates("all");
    
                    $html = "<div class='p-4 my-3 bg-white box-shadow-round ratesBox'><div class='d-flex justify-content-between'><div class='name h5 font-weight-bold'>".MVCcontroller::hideName($_SESSION["user"]["data"]["name"])."</div><div class='star text-warning'>";
                        for($i = 1; $i <= $_POST["rate"]; $i++){
                            $html .= "<i class='fas fa-star'></i>";
                        }
                        for($i = $_POST["rate"]; $i <= 4; $i++){
                            $html .= "<i class='far fa-star'></i>";
                        }
                    $html .= "</div></div>";
                    if(!empty($_POST["comment"])){
                        $html .= "<div class='mt-4 py-1'>".$_POST["comment"]."</div>";
                    }
                    $html .= "<div class='time mt-3 text-right'><small class='text-muted'>今天评价的</small></div></div>";
                    echo '{"response": 200, "data": "'.$html.'"}';
                }else{
                    echo '{"response": "insert_error"}';
                }
            }elseif($_GET["type"] == "buy"){
                if($mvc->rateBuy([$_POST["rate"], $_POST["comment"], $_POST["day"], $_POST["id"], $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["name"]])){
                    if($mvc->updateRateHistory($_POST["id"], $_SESSION["user"]["data"]["wechat_id"])){
                        include_once "../../controller/controller.php";
                        $price = $_SESSION["rate_buy"];
                        if($price <= 80){
                            $points = 2;
                        }else{
                            $points = (floor($price/80)*10);
                        }
                        $mvc->getPoints($points, $_SESSION["user"]["data"]["wechat_id"], $_SESSION["user"]["data"]["password"], $reset = false);
                        $_SESSION["user"]["data"]["daily_points"] = $_SESSION["user"]["data"]["daily_points"] + $points;

                        $_SESSION["rate"]["buy"] = MVCcontroller::getBuyRates("all");
                        $_SESSION["user"]["data"]["user_need_rate"] = $_SESSION["user"]["data"]["user_need_rate"] -1;

                        echo '{"response": 200}';
                    }else{
                        echo '{"response": "error_updating_rate_status"}';
                    }
                }else{
                    echo '{"response": "insert_error"}';
                }
            }
        }else{
            echo '{"response": "error_rate_star['.$_POST["rate"].']"}';
        }
    }else{
        echo '{"response": "error_type"}';
    }
}else{
    echo '{"response": "error_code"}';
}