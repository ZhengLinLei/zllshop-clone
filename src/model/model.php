<?php
class MVCmodel{
    static public function include_modules($type){
        include_once "./view/import/".$type.".php";
    }
    static public function include_submodules($folder, $type){
        include_once "./view/import/".$folder."/".$type.".php";
    }
}
//Database class manage
class DbManage{
    public $host = "localhost:3306";
    public $user = "zll";
    public $password = "Zheng_9112003";
    public $dbName = "zllshop";
    public $tableName = ["item" => "shop_item_buy", "user" => "user", "coupon" => "coupon", "buy_history" => "buy_history", "rate_app" => "rate_app",  "rate_buy" => "rate_buy"];
    public function pdo(){
        try {
            return new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8mb4', $this->user, $this->password);;
        } catch (PDOException $e) {
            print "Error!";
            die();
        }
    }
    public function runQuerySQL($query, $param = [], $select = false){
        $prepare = $this->pdo()->prepare($query);
        $data_return = $prepare->execute($param);

        if($select){
            $data_return = $prepare->fetchAll();
        }
        return $data_return;
    }
}

class DbCategoryManage extends DbManage{
    function selectDataCategory($query, $param = []){
        $prepare = $this->pdo()->prepare($query);
        $prepare->execute($param);

        $data_return = $prepare->fetchAll();
        return $data_return;
    }
}
class DbBuyHistoryManage extends DbManage{
    function selectDataHistory($query, $param = []){
        $prepare = $this->pdo()->prepare($query);
        $prepare->execute($param);

        $data_return = $prepare->fetchAll();
        return $data_return;
    }
}