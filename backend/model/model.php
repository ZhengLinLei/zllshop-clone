<?php
//Database class manage
class DbManage{
    public $host = "localhost:3306";
    public $user = "zll";
    public $password = "Zheng_9112003";
    public $dbName = "zllshop";
    public $tableName = ["item" => "shop_item_buy", "user" => "user", "coupon" => "coupon", "buy_history" => "buy_history"];
    public function pdo(){
        try {
            return new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8mb4', $this->user, $this->password);;
        } catch (PDOException $e) {
            print "Error!";
            die();
        }
    }
}

class DbManageModel extends DbManage{
    function query($query, $param = [], $select = false){
        $prepare = $this->pdo()->prepare($query);
        $data_return = $prepare->execute($param);
        if($select){
            $data_return = $prepare->fetchAll();
        }
        return $data_return;
    }
}