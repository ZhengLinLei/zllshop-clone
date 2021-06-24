<?php
class MVCcontroller{
    function include_template($type){
        include_once "./view/".$type.".php";
    }
    function include_modules($type){
        include_once "./view/import/".$type.".php";
    }
    #new item
    function insert_new_item($arr){
        $db = new DbManageModel();

        $query = 'INSERT INTO '.$db->tableName["item"].'(`item_name`, `item_description`, `item_price_yuan`, `item_price_euro`, `item_price_ship`, `item_class`, `item_word`, `item_tag`, `item_image`, `item_seller`) VALUES (?,?,?,?,?,?,?,?,?,?)';
        return $db->query($query, $arr);
    }
    #new coupon
    function insert_new_coupon($code, $value, $expire_date){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["coupon"].' WHERE `code` = ?';
        $param = [$code];
        
        if(empty($db->query($query, $param, true))){
            $code .= time();
        }

        $query = 'INSERT INTO '.$db->tableName["coupon"].'(`code`, `value_yuan`, `expire_date`) VALUES (?,?,?)';
        $param = [$code, $value, $expire_date];

        if($db->query($query, $param)){
            return $code;
        }
    }
    function get_notUsed_coupon($expired = false){
        $model = new DbManageModel();

        $query = 'SELECT * FROM '.$model->tableName["coupon"].' WHERE `used_by_someone` = ? AND `expire_date` '.(($expired)?'<':'>=').' ? ORDER BY `id` DESC';
        $param = [0, date("Y-m-d")];

        return $model->query($query, $param, true);
    }
    #verify account
    function verify_new_account($arr, $admin = false){
        $db = new DbManageModel();

        $query = 'UPDATE '.$db->tableName["user"].' SET `verify_code`= 0 '.(($admin)?',`user_role`= "代理"':'').'WHERE `wechat_id` = ? AND `verify_code` = ?';
        $param = $arr;
        
        return $db->query($query, $param);
    }
    #buy
    function get_user_data($user){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["user"].' WHERE `wechat_id` = ?';
        $param = [$user];
        return $db->query($query, $param, true);
    }
    function get_item_data($str){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["item"].' WHERE `id` IN ('.$str.')';

        return $db->query($query, [], true);
    }
    function search_same_id($data, $number){
        foreach ($data as $key => $value) {
            if(intval($value["id"]) == intval($number)){
                return $key;
            }
        }
        return -1;
    }
    function reset_user_money($num, $id){
        $db = new DbManageModel();

        $query = 'UPDATE '.$db->tableName["user"].' SET `money_coin`= ? WHERE `wechat_id` = ?';
        $param = [$num, $id];
        
        return $db->query($query, $param);
    }
    function push_new_historyBuy($user, $data, $price){
        $db = new DbManageModel();

        $query = 'INSERT INTO '.$db->tableName["buy_history"].'(`user`, `history`, `price_value`) VALUES (?,?,?)';
        $param = [$user, $data, $price];
        
        return $db->query($query, $param);
    }
    function update_item_buyTimes($ids){
        $db = new DbManageModel();

        $query = 'UPDATE '.$db->tableName["item"].' SET `item_sell_times`= `item_sell_times`+1 WHERE `id` IN ('.$ids.')';
        
        return $db->query($query, []);
    }
    function update_user_buy_times($price, $user){
        $db = new DbManageModel();

        $query = 'UPDATE '.$db->tableName["user"].' SET `user_buy_times`= `user_buy_times`+1, `user_buy_all_money` = `user_buy_all_money` + ? WHERE `wechat_id` = ? ';
        
        return $db->query($query, [$price, $user]);
    }
    function get_last_id_history(){
        $db = new DbManageModel();

        $query = 'SELECT `id` FROM '.$db->tableName["buy_history"].' ORDER BY `id` DESC LIMIT 1';
        
        return $db->query($query, [], true);
    }
    //Update History Buy
    function todo_user_history(){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["buy_history"].' WHERE `status` != ?';
        return $db->query($query, ["已签收"], true);
    }
    function todo_user_history_fly($type){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["buy_history"].' ';
        if($type == "yes"){
            $query .= 'WHERE `status` = "已运送" OR `status` = "已到达国家" OR `status` = "等待签收"';
        }else{
            $query .= 'WHERE `status` = "未发货" OR `status` = "已入仓库" OR `status` = "已批准"';
        }
        return $db->query($query, [], true);
    }
    function check_id_history($user){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["buy_history"].' WHERE `id` = ?';
        return $db->query($query, [$user], true);
    }
    function check_user_history($user){
        $db = new DbManageModel();

        $query = 'SELECT * FROM '.$db->tableName["buy_history"].' WHERE `user` = ? AND `status` != "已签收" ORDER BY `id` DESC';
        return $db->query($query, [$user], true);
    }
    function update_history($type, $id, $value){
        $db = new DbManageModel();
        $query = 'UPDATE '.$db->tableName["buy_history"].' SET `'.$type.'` = ? WHERE `id` = ?';
        return $db->query($query, [$value, $id]);
    }
    //Range Role
    function update_user_range_role($type, $id, $value){
        $db = new DbManageModel();
        if($type == "range"){
            $query = 'UPDATE '.$db->tableName["user"].' SET `user_range` = ? WHERE `wechat_id` = ?';
        }elseif($type == "role"){
            $query = 'UPDATE '.$db->tableName["user"].' SET `user_role` = ? WHERE `wechat_id` = ?';
        }
        return $db->query($query, [$value, $id]);
    }
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}