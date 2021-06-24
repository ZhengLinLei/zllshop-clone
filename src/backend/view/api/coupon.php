<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();
    if($_GET["type"] == "new"){
        $value = $_POST["value"];
        $expire_date = $_POST["expire"];
        $code = $mvc->generateRandomString(rand(5, 10));
        $realcode = $mvc->insert_new_coupon($code, $value, $expire_date);
        if($realcode){
            echo $realcode;
        }else{
            echo '{"response": "error"}';
        }
    }else{
        $coupon = $mvc->get_notUsed_coupon(($_GET["type"] == "check")?false:true);
        if(empty($coupon)){
            echo '{"response": "empty"}';
        }else{
            foreach($coupon as $value){
                echo "<div style='display:flex;justify-content:between;flex-direction:column;margin:20px 0;'>";
                    echo "<span>".$value["id"]."</span><span>".$value["code"]."</span><span>".$value["value_yuan"]."￥</span><span>".$value["expire_date"]."</span>";
                echo "</div>";
            }
        }
    }
}else{
    echo '{"response": "error_code"}';
}