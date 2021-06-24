<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();
    if($_GET["type"] == "request"){
        $json = (object) ["response" => 200];
        $json->cart = json_decode($_POST["json"]);
        if(isset($json->cart->wechat_id) && $json->cart->wechat_id != "false"){
            $user_money = $mvc->get_user_data($json->cart->wechat_id);
            if(empty($user_money)){
                die('{"response": "no_user"}');
            }
        }else{
            $user_money = false;
        }
        
        if($user_money){
            $location = json_decode($user_money[0]["user_location"]);
            $json->user = (object) ["user_money_coin" => $user_money[0]["money_coin"],
                                "user_buy_all_money" => $user_money[0]["user_buy_all_money"], 
                                "user_location" => "名字: ".$location->name."<br>姓名: ".$location->surname."<br>手机: ".$location->mobile."<br>电话: ".$location->phone."<br>国家: ".$location->country."<br>邮编: ".$location->postal."<br>省/区: ".$location->province."<br>城市: ".$location->city."<br>街面: ".$location->address."<br>",
                                "wechat_id" => $json->cart->wechat_id];
        }else{
            $json->user = (object) ["user_money_coin" => null,
                                    "user_buy_all_money" => null, 
                                    "user_location" => null,
                                    "wechat_id" => false];
        }
        

        $ids = [];
        foreach ($json->cart->data as $key => $value) {
            if($value->id != 0){
                array_push($ids, $value->id);
            }
        }
        $item_data = $mvc->get_item_data(implode(",", $ids));
        //FOREACH
        $total_price = 0;
        foreach ($json->cart->data as $key => $value) {
            if($value->id == 0){
                $yuan = 0;
                $euro = 0;
                $ship = 0;
                $img = '/view/resource/img/database/jiedan_taobao_pdd.jpg';
                $name = "接单";
            }else{
                $num = $mvc->search_same_id($item_data, $value->id);
                if($num != -1){
                    $yuan = $item_data[$num]["item_price_yuan"];
                    $euro = $item_data[$num]["item_price_euro"];
                    $ship = $item_data[$num]["item_price_ship"];
                    $name = $item_data[$num]["item_name"];
                    $img = json_decode($item_data[$num]["item_image"])->image[0];
                }else{
                    die('{"response": "error-server-near-searchSameID"}');
                }
            }
            $value->item_name = $name;
            $value->item_image = $img;
            $value->item_price_yuan = $yuan;
            $value->item_price_euro = $euro;
            $value->item_price_ship = $ship;
            $value->item_total_price = floatval($yuan)*intval($value->number_item);
            $total_price += $value->item_total_price;
        }
        $json->cart->total_price = $total_price;
        echo json_encode($json);
    }else if($_GET["type"] = "upload"){
        $json = json_decode($_POST["json"]);
        if($json->user->wechat_id){
            if($json->cart->use_money == "true"){
                $final_money = ((!empty($_POST["minusMoney"]))?$json->user->user_money_coin - $_POST["minusMoney"]:$json->user->user_money_coin);
                if(!$mvc->reset_user_money($final_money, $json->user->wechat_id)){
                    die('{"response": "error_server"}');
                }
                $json->cart->minus_user_money = $_POST["minusMoney"];
                $json->cart->user_remaining_money = $final_money;
            }
            $json->cart->real_price = $resultPrice = $_POST["resultPrice"];
            $json->cart->gap_price = (empty($_POST["priceGap"]))?0:$_POST["priceGap"];
            $json->cart->price_comment = (empty($_POST["priceComment"]))?"没备注":$_POST["priceComment"];

            $dbData = json_encode($json->cart);
            if($mvc->push_new_historyBuy($json->user->wechat_id, $dbData, $_POST["resultPrice"])){
                $ids = "";
                foreach ($json->cart->data as $key => $value) {
                    $ids .= $value->id.(($key < count($json->cart->data)-1)?",":"");
                }
                if($mvc->update_item_buyTimes($ids)){
                    if($mvc->update_user_buy_times($resultPrice, $json->user->wechat_id)){
                        echo '{"response": 200, "id": '.$mvc->get_last_id_history()[0]['id'].'}';
                    }else{
                        echo '{"response": "error Updating user buy times"}';
                    }
                }else{
                    echo '{"response": "error Updating items buy times"}';
                }
            }else{
                echo '{"response": "error DB"}';
            }

        }else{
            echo '{"response":"not need register"}';
        }
    }
}else{
    echo '{"response": "error_code"}';
}