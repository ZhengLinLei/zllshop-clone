<?php
session_start();
header("Content-Type: application/json");

if(isset($_SESSION["admin_security_token"]) && isset($_GET["code"]) && $_GET["code"] == $_SESSION["admin_security_token"]){
    include_once "../../controller/controller.php";
    include_once "../../model/model.php";
    $title = $_POST["title"];
    $description = $_POST["decription"];
    $description = str_replace('\n', '<br>', $description);
    //CODES
    $alert = ["**海关**", "**电**", "**价钱**", "**征税**"];
    $alertHtml = ["<div class='px-3 small-round py-2 mt-4 small alert-warning'><div><span class='font-weight-bold'>温馨提示: </span>因商品，会有小小的概率被海关查询 (自理)</div><div class='mt-2'>请先私聊<a href='../info'>了解</a></div></div>",
                  "<div class='px-3 small-round py-2 mt-4 small alert-warning'><div><span class='font-weight-bold'>温馨提示: </span>带电商品，价格不稳定 (价格会有些变动)</div><div class='mt-2'>请先私聊<a href='../info'>了解</a></div></div>",
                  "<div class='px-3 small-round py-2 mt-4 small alert-warning'><div><div class='font-weight-bold'>温馨提示: </div>因物流消息，此商品价格不稳定 (价格会有些变动)</div><div class='mt-2'>请先私聊<a href='../info'>了解</a></div></div>",
                  "<div class='px-3 small-round py-2 mt-4 small alert-warning'><div><span class='font-weight-bold'>温馨提示: </span>体积问题，会有小小的概率征税 (自理)</div><div class='mt-2'>请先私聊<a href='../info'>了解</a></div></div>"];
    $description = str_replace($alert, $alertHtml, $description);
    $price_yuan = $_POST["price"];
    $price_euro = number_format(floatval($_POST["price"])/8, 2, '.', '');
    $real_fileName = $_POST["image_name"];
    $ship = $_POST["ship"];
    $class = $_POST["class"];
    #----------------
    $word = explode(",", $_POST["words"]);
    $word_str = '{ "word": ["'.implode('","',$word).'"]}';
    $word = $word_str;
    #----------------
    $tag = '{"tag": ["'.$_POST["tag1"].'", "'.$_POST["tag2"].'", "'.$_POST["tag3"].'"]}';
    #-----------------
    $seller = $_POST["user_ship"];
    $fileNameDB = [];
    $returnDir = "../../..";
    $image_folder_path = "/view/resource/img/database/";
    foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name) {
        $file_name = $_FILES["images"]["name"][$key];
        $file_tmp = $_FILES["images"]["tmp_name"][$key];
        $ext = pathinfo($file_name,PATHINFO_EXTENSION);

        $date_now = date("Ymd");

        if(!is_dir($returnDir.$image_folder_path.$date_now)){
            mkdir($returnDir.$image_folder_path.$date_now, 0777);
            chmod($returnDir.$image_folder_path.$date_now, 0777);
        }
        $image_pathDB = $image_folder_path.$date_now."/".$real_fileName.$key.".".$ext;
        $image_path = $returnDir.$image_pathDB;

        if(!file_exists($image_path)){
            move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], $image_path);
        }
        else {
            $image_pathDB = $image_folder_path.$date_now."/".$real_fileName.$key.time().".".$ext;
            $image_path = $returnDir.$image_pathDB;
            move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"][$key], $image_path);
        }
        array_push($fileNameDB, $image_pathDB);
    }
    if($_FILES["images2"]["error"][0] == 0){
        foreach($_FILES["images2"]["tmp_name"] as $key=>$tmp_name) {
            $file_name = $_FILES["images2"]["name"][$key];
            $file_tmp = $_FILES["images2"]["tmp_name"][$key];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);
    
            $date_now = date("Ymd");
    
            $image_pathDB = $image_folder_path.$date_now."/d".$real_fileName.$key.".".$ext;
            $image_path = $returnDir.$image_pathDB;
    
            if(!file_exists($image_path)){
                move_uploaded_file($file_tmp = $_FILES["images2"]["tmp_name"][$key], $image_path);
            }
            else {
                $image_pathDB = $image_folder_path.$date_now."/d".$real_fileName.$key.time().".".$ext;
                $image_path = $returnDir.$image_pathDB;
                move_uploaded_file($file_tmp = $_FILES["images2"]["tmp_name"][$key], $image_path);
            }
            array_push($fileNameDB, $image_pathDB);
        }
    }
    $fileNameDB_str = '{"image": ["'. implode('","', $fileNameDB) .'"]}';
    $image = $fileNameDB_str;

    $arr_data = [$title, $description, $price_yuan, $price_euro, $ship, $class, $word, $tag, $image, $seller];
    $mvc = new MVCcontroller();
    if($mvc->insert_new_item($arr_data)){
        echo '{"response": 200}';
    }else{
        echo '{"response": "error"}';
    }
}else{
    echo '{"response": "error_code"}';
}