<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $mvc = new MVCcontroller();

    if($_GET["type"] == "todo_id" || $_GET["type"] == "todo_id_fly"){
        if($_GET["type"] == "todo_id"){
            $data = $mvc->todo_user_history();
        }else{
            $data = $mvc->todo_user_history_fly($_GET["status"]);
        }
        if(empty($data)){
            die('{"response":"empty"}');
        }else{
            $html = "";
            foreach ($data as $key => $value) {
                $json = json_decode($value["history"]);
                $html .= "<div>单号: ".$value["id"]."<br>买家: ".$value["user"]."<br>时间:".$value["date_buy"]."<br>价钱:".$value["price_value"]."<br>跟踪:".$value["status"]."<br>物流:".$value["code"]."<br>运送:".$value["ship_code"]."<br>备注: ".$json->price_comment."<br><br>物品: ";
                foreach ($json->data as $key2 => $value2) {
                    $html .= "<div>id: <a href='../item?item=".$value2->id."' target='_blank'>".$value2->id."</a><br>Image: <img src='..".$value2->item_image."' style='width: 30px'></div>";
                }
                $html .= "</div><br><br><hr>";
            }
    
            echo $html;
        }
    }else{
        if($_GET["type"] == "check_user" || $_GET["type"] == "check_id"){
            $data = (($_GET["type"] == "check_user")?$mvc->check_user_history($_POST["user"]):$mvc->check_id_history($_POST["id"]));
            if(empty($data)){
                die('{"response":"empty"}');
            }else{
                $html = "";
                foreach ($data as $key => $value) {
                    $json = json_decode($value["history"]);
                    $html .= "<div>单号: ".$value["id"]."<br>买家: ".$value["user"]."<br>时间:".$value["date_buy"]."<br>跟踪:".$value["status"]."<br>物流:".$value["code"]."<br>运送:".$value["ship_code"]."<br>备注: ".$json->price_comment."<br><br>物品: ";
                    foreach ($json->data as $key2 => $value2) {
                        $html .= "<div>id: <a href='../item?item=".$value2->id."' target='_blank'>".$value2->id."</a><br>Image: <img src='..".$value2->item_image."' style='width: 30px'></div>";
                    }
                    $html .= "</div><br><br><hr>";
                }
    
                echo $html;
            }
        }else{
            if(in_array($_GET["type"], ["status", "code", "ship_code"])){
                if($mvc->update_history($_GET["type"], $_POST["id"], $_POST["value"])){
                    die('{"response": 200}');
                }else{
                    die('{"response":"error-database"}');
                }
            }else{
                die('"response":"error-type"');
            }
        }
    }
}