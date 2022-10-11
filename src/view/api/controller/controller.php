<?php

class MVCcontrollerAPI{
    function findIssetWechatId($wechat_id){
        $model = new DbQueryManage();

        $query = 'SELECT `name` FROM '.$model->tableName["user"].' WHERE `wechat_id` = ?';
        $param = [$wechat_id];

        return $model->runQuerySQL($query, $param, true);
    }
    function createUser($wechat_id, $name, $password, $inv){
        $model = new DbQueryManage();

        $verify_code = rand();
        $query = 'INSERT INTO '.$model->tableName["user"].' (`wechat_id`, `name`, `password`, `verify_code`, `invited_by`) VALUES (?, ?, ?, ?, ?)';
        $param = [$wechat_id, $name, $password, $verify_code, $inv];
        
        if($model->runQuerySQL($query, $param)){
            return $verify_code;
        }else{
            return false;
        }
    }
    function loginUser($wechat_id, $password){
        $model = new DbQueryManage();

        $query = 'SELECT * FROM '.$model->tableName["user"].' WHERE `wechat_id` = ? AND `password` = ?';
        $param = [$wechat_id, $password];

        return $model->runQuerySQL($query, $param, true);
    }
    function createUserSession($login){
        $_SESSION["user"] = ["login"=> true, "data" => ["id" => $login[0]["id"], "wechat_id" => $login[0]["wechat_id"], "name" => $login[0]["name"],
                             "password" => $login[0]["password"], "money_coin_yuan" => ($login[0]["money_coin"] == 0)?0:number_format($login[0]["money_coin"], 2, '.', ''),
                             "money_coin_euro" => ($login[0]["money_coin"] == 0)?0:number_format($login[0]["money_coin"]/8, 2, '.', ''), "user_location" => $login[0]["user_location"],
                             "user_buy_times" => $login[0]["user_buy_times"], "user_buy_all_money_yuan" => $login[0]["user_buy_all_money"],
                             "user_cart" => json_decode($login[0]["user_cart"]), "daily_points" => $login[0]["daily_points"], "daily_points_date" => $login[0]["daily_points_date"], "can_get_points" => (((date("Ymd") - date("Ymd", strtotime($login[0]["daily_points_date"]))) > 0)?true:false),
                             "user_buy_all_money_euro" => ($login[0]["user_buy_all_money"] == 0)?0:number_format($login[0]["user_buy_all_money"]/8, 2, '.', ''),
                             "user_range" => $login[0]["user_range"], "user_role" => $login[0]["user_role"], 
                             "user_birthday" => $login[0]["user_birthday"], "today_birthday" => (((date("md", strtotime($login[0]["user_birthday"])) - date("md", time())) == 0)?true:false), "email" => $login[0]["email"], "email_verify_code" => $login[0]["email_verify_code"],
                             "user_need_rate" => $this->needRate($login[0]["wechat_id"])]];

        if($_SESSION["user"]["data"]["today_birthday"]){
            $_SESSION["user"]["data"]["today_year"] = date("Y", time()) - date("Y", strtotime($login[0]["user_birthday"]));
        }
        $_SESSION["item_cart"] = $_SESSION["user"]["data"]["user_cart"];
    }
    function needRate($user){
        $model = new DbQueryManage();
        $query = 'SELECT * FROM '.$model->tableName["buy_history"].' WHERE `user` = ? AND `status` = "已签收" AND `rate` = 0';
        $param = [$user];

        return count($model->runQuerySQL($query, $param, true));
    }
    function searchCouponCode($code){
        $model = new DbQueryManage();

        $query = 'SELECT * FROM '.$model->tableName["coupon"].' WHERE `code` = ? AND `expire_date` >= ?';
        $param = [$code, date("Y-m-d")];

        return $model->runQuerySQL($query, $param, true);
    }
    function checkUsedCoupon($id, $user){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["coupon"].' SET `used_by_someone` = 1, `user_used` = ? WHERE `id` = ?';
        $param = [$user, $id];

        return $model->runQuerySQL($query, $param);
    }
    function getPoints($num, $user, $password, $reset = true){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `daily_points` = `daily_points` + ?'.(($reset)?', `daily_points_date` = CURRENT_DATE()':'').' WHERE `wechat_id` = ? AND `password` = ?';
        $param = [intval($num), $user, $password];

        return $model->runQuerySQL($query, $param);
    }
    function changePoints($money, $user, $password){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `daily_points` = "0" WHERE `wechat_id` = ? AND `password` = ?';
        $param = [$user, $password];
        if($model->runQuerySQL($query, $param)){
            return $this->incrementUserMoney($user, $password, $money);
        }else{
            return false;
        }
    }
    function incrementUserMoney($user, $password, $value){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `money_coin` = `money_coin` + ? WHERE `wechat_id` = ? AND `password` = ?';
        $param = [round(floatval($value), 2), $user, $password];

        return $model->runQuerySQL($query, $param);
    }
    function updateUserLocation($id, $user, $password, $location){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `user_location` = ? WHERE `id` = ? AND `wechat_id` = ? AND `password` = ?';
        $param = [$location, $id, $user, $password];

        return $model->runQuerySQL($query, $param);
    }
    function changeUserPassword($id, $user, $password, $new_password){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `password` = ? WHERE `id` = ? AND `wechat_id` = ? AND `password` = ?';
        $param = [$new_password, $id, $user, $password];

        return $model->runQuerySQL($query, $param);
    }
    function changeUserProfile($type, $user, $password, $data){
        $model = new DbQueryManage();

        if($type == "wechat_id"){
            $query = 'UPDATE '.$model->tableName["user"].' SET `wechat_id` = ?, `verify_code`= ? WHERE `wechat_id` = ? AND `password` = ?';
            $param = [$data[0], $data[1], $user, $password];
        }else{
            $query = 'UPDATE '.$model->tableName["user"].' SET `'.$type.'` = ? WHERE `wechat_id` = ? AND `password` = ?';
            $param = [$data, $user, $password];
        }

        return $model->runQuerySQL($query, $param);
    }
    function changeUserEmail($email, $user, $password){
        $model = new DbQueryManage();

        $verify_code = rand(1000, 9999);
        $query = 'UPDATE '.$model->tableName["user"].' SET `email` = ?, `email_verify_code`= ? WHERE `wechat_id` = ? AND `password` = ?';
        $param = [$email, $verify_code, $user, $password];
        
        if($model->runQuerySQL($query, $param)){
            return $verify_code;
        }else{
            return false;
        }
    }
    function verifyUserEmail($code, $email, $user, $password){
        $model = new DbQueryManage();

        $query = 'UPDATE '.$model->tableName["user"].' SET `email_verify_code`= 0 WHERE `email_verify_code` = ? AND `email` = ? AND `wechat_id` = ? AND `password` = ?';
        $param = [$code, $email, $user, $password];
        
        return $model->runQuerySQL($query, $param);
    }
    function updateUserCart($id, $user, $password){
        $model = new DbQueryManage();
        $json = json_encode($_SESSION["item_cart"], JSON_UNESCAPED_UNICODE);
        $query = 'UPDATE '.$model->tableName["user"].' SET `user_cart` = ? WHERE `id` = ? AND `wechat_id` = ? AND `password` = ?';
        $param = [$json, $id, $user, $password];

        return $model->runQuerySQL($query, $param);
    }
    //RATE APP
    function rateAPP($param){
        $model = new DbQueryManage();
        $query = 'INSERT INTO '.$model->tableName["rate_app"].' (`rate`, `argue`, `user`, `name`) VALUES (?,?,?,?)';
        return $model->runQuerySQL($query, $param);
    }
    //RATE BUY
    function rateBuy($param){
        $model = new DbQueryManage();
        $query = 'INSERT INTO '.$model->tableName["rate_buy"].' (`rate`, `argue`, `day`, `buy_id`, `user`, `name`) VALUES (?,?,?,?,?,?)';
        return $model->runQuerySQL($query, $param);
    }
    function updateRateHistory($id, $user){
        $model = new DbQueryManage();
        $query = 'UPDATE '.$model->tableName["buy_history"].' SET `rate` = 1 WHERE `id` = ? AND `user` = ?';
        return $model->runQuerySQL($query, [$id, $user]);
    }
    //SEND MAIL
    function sendMail($to, $name, $title, $body){
        $header = 'From: '.$name.' <robot@zllshop.es> ' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion(). "\r\n";
        $header .= 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $title = "=?utf-8?B?".base64_encode($title)."?=\n";

        return mail($to, $title, $body, $header);
    }
}