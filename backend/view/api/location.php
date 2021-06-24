<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]) {
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();
    $user = $mvc->get_user_data($_POST["user"]);
    if (empty($user)) {
        die('{"response": "no_user"}');
    }

    if(empty($user[0]["user_location"])){
        $json = (object) [
            "user_money_coin" => $user[0]["money_coin"],
            "user_points" => $user[0]["daily_points"],
            "user_buy_all_money" => $user[0]["user_buy_all_money"],
            "user_location" => null,
            "wechat_id" => $_POST["user"]
        ];
    }else{
        $location = json_decode($user[0]["user_location"]);
        $json = (object) [
            "user_money_coin" => $user[0]["money_coin"],
            "user_points" => $user[0]["daily_points"],
            "user_buy_all_money" => $user[0]["user_buy_all_money"],
            "user_location" => "名字: " . $location->name . "<br>姓名: " . $location->surname . "<br>手机: " . $location->mobile . "<br>电话: " . $location->phone . "<br>国家: " . $location->country . "<br>邮编: " . $location->postal . "<br>省/区: " . $location->province . "<br>城市: " . $location->city . "<br>街面: " . $location->address . "<br>",
            "wechat_id" => $_POST["user"]
        ];
    }
    echo json_encode($json);
} else {
    echo '{"response": "error_code"}';
}
