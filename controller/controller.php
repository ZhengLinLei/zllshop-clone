<?php
class DataReturn{
    function __construct($data, $group = 0){
        $this->length = count($data);
        $this->parseLen = ceil($this->length/40);
        $this->data = array_chunk($data, 40);
        $this->group = $group;
    }
    function pagination(){
        $uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        $preUrl = (isset($_GET['search']))?$uri[0].'?search='.$_GET["search"].'&':'?';
        $html = '<ul class="pagination mx-2">';

        for ($i = 1;$i <= $this->parseLen; $i++) { 
            $num = ($this->group * 10) + $i;
            //Top
            if($i == 1 && $num != 1){
                $html.= '<li class="page-item"><a class="page-link bg-light" href="'.$preUrl.'num='.($num-1).'"> <i class="fas fa-angle-left"></i> </a></li>';
            }
            //Middle
            if((!isset($_GET["num"]) && $i == 1) || (isset($_GET["num"]) && $num == $_GET["num"])){
                $html.= '<li class="page-item active"><a class="page-link" href="'.$preUrl.'num='.$num.'">'.$num.'</a></li>';
            }else{
                $html.= '<li class="page-item"><a class="page-link" href="'.$preUrl.'num='.$num.'">'.$num.'</a></li>';
            }
            //End
            if($i == $this->parseLen && $this->parseLen == 10){
                $html.= '<li class="page-item"><a class="page-link bg-light" href="'.$preUrl.'num='.($num+1).'"> <i class="fas fa-angle-right"></i> </a></li>';
            }
        }

        $html .= '</ul>';

        echo $html;
    }
}
class MVCcontroller{

    function include_template(){

        include_once "./view/template.php";
    }

    function include_modules($type){
        MVCmodel::include_modules($type);
    }
    function include_submodules($folder, $type){
        MVCmodel::include_submodules($folder, $type);
    }
    //DB
    function getTotalRows($type){
        $model = new DbCategoryManage();

        $query = 'SELECT `id` FROM '.$model->tableName[$type].' ORDER BY `id` DESC LIMIT 1';
        $data = $model->selectDataCategory($query);

        return $data;
    }
    //Category
    function getDataCategory($type, $num){
        if(isset($_SESSION["load_item"][$type][$num]) && !empty($_SESSION["load_item"][$type][$num])){
            $data = $_SESSION["load_item"][$type][$num]["data"];
        }else{
            $model = new DbCategoryManage();

            //Create query
            if($type == "all"){
                $query = 'SELECT * FROM '.$model->tableName["item"].' ORDER BY `id` DESC LIMIT '.$num * 400 .',400';
                $data = $model->selectDataCategory($query);
            }else{
                $query = 'SELECT * FROM '.$model->tableName["item"].' WHERE `item_class` = ? ORDER BY `id` DESC LIMIT '.$num * 400 .',400';
                $param = [$type];
                $data = $model->selectDataCategory($query, $param);
            }
            $_SESSION["load_item"][$type][$num]["data"] = $data;
        }
        
        return new DataReturn($data, $num);
    }
    function searchDataCategory($search, $type){
        if(isset($_SESSION["search_item"][$search][$type]) && (!empty($_SESSION["search_item"][$search][$type]))){
            $data = $_SESSION["search_item"][$search][$type]["data"];
        }else{
            $model = new DbCategoryManage();

            //Create query
            if($type == "all"){
                $query = 'SELECT * FROM '.$model->tableName["item"].' WHERE `item_name` LIKE "%'.$search.'%" OR JSON_SEARCH(JSON_EXTRACT(item_word, "$.word"), "one","%'.$search.'%") IS NOT NULL ORDER BY `id` DESC';
                $param = [];
            }else{
                $query = 'SELECT * FROM '.$model->tableName["item"].' WHERE `item_class` = ? AND (`item_name` LIKE "%'.$search.'%" OR JSON_SEARCH(JSON_EXTRACT(item_word, "$.word"), "one","%'.$search.'%")) IS NOT NULL ORDER BY `id` DESC';
                $param = [$type];
            }
            $data = $model->selectDataCategory($query, $param);

            $_SESSION["search_item"][$search][$type]["data"] = $data;
        }
        
        return new DataReturn($data);
    }
    function searchDataCategoryById($id, $more = false){
        $model = new DbCategoryManage();

        $query = 'SELECT * FROM '.$model->tableName["item"].' WHERE `id` '.(($more)?'IN ':'= ').'('.$id.') ORDER BY `id` DESC';

        $data = $model->selectDataCategory($query, []);
        return new DataReturn($data);
    }
    function getDataCategoryJieDan(){
        $response = [["id" => 0, "item_name" => "📦 接单", "item_description" => "各种网站网页接单，可以拿图或者链接🔗。<br><br> 淘宝，拼多多，阿里巴巴，小红书，等等...<br><br><i class='fas fa-barcode'></i>", "item_price_yuan" => 0, "item_price_euro" => 0, "item_price_ship" => 0, "item_tag" => '{"tag": ["淘宝", "拼多多", "等等..."]}', "item_image" => '{"image": ["/view/resource/img/database/jiedan_taobao_pdd.jpg"]}', "item_sell_times" => "很多个"]];
        return new DataReturn($response);
    }
    function getBuyHistory($user, $id = 0, $type = "all"){
        $model = new DbBuyHistoryManage();

        $query = (($id > 0)?'SELECT * FROM '.$model->tableName["buy_history"].' WHERE `user` = ? AND `id` = ? ORDER BY `id` DESC LIMIT 1':(('SELECT * FROM '.$model->tableName["buy_history"].' WHERE `user` = ?')));
        if($id <= 0){
            switch ($type) {
                case 'country':
                    $query .= "AND `status` = '未发货'";
                    break;
                
                case 'warehouse':
                    $query .= "AND (`status` = '已入仓库' OR `status` = '已批准')";
                    break;

                case 'plane':
                    $query .= "AND (`status` = '已运送')";
                    break;

                case 'arrive':
                    $query .= "AND (`status` = '已到达国家' OR `status` = '等待签收')";
                    break;
    
                case 'rate':
                    $query .= "AND `rate` = 0 AND (`status` = '已签收' OR `status` = '已取消')";
                    break;
                    
            }
            $query .= " ORDER BY `id` DESC LIMIT 40";
        }
        $param = ($id > 0)?[$user, $id]:[$user];

        $data = $model->selectDataHistory($query, $param);
        return $data;
    }
    function dateComment($date){
        $timeUNIX = strtotime($date);
        $timePass = time() - $timeUNIX;
        if($timePass/604800 <= 4){
            if($timePass <= 86400){
                return "今天评价的";
            }else{
                return ceil($timePass/86400)."天前评价的";
            }
        }elseif($timePass/2628000 <= 12){
            return ceil($timePass/2628000)."个月前评价的";
        }else{
            return $date;
        }
    }
    //RATE PAGE
    function checkUserRated($user){
        $model = new DbManage();

        $query = 'SELECT * FROM '.$model->tableName["rate_app"].' WHERE `user` = ?';
        $param = [$user];

        $data = $model->runQuerySQL($query, $param, true);
        $_SESSION["user"]["data"]["rated"] = ((empty($data))?false:true);
    }
    public static function getAPPRates($type){
        $model = new DbManage();

        $query = (($type == "all")?'SELECT * FROM '.$model->tableName["rate_app"].' ORDER BY `id` DESC LIMIT 50':'SELECT * FROM '.$model->tableName["rate_app"].' WHERE `rate` = '.$type.' ORDER BY `id` DESC LIMIT 50');
        $data = $model->runQuerySQL($query, [], true);
        return $data;
    }
    public static function getBuyRates($type){
        $model = new DbManage();

        $query = (($type == "all")?'SELECT * FROM '.$model->tableName["rate_buy"].' ORDER BY `id` DESC LIMIT 30':'SELECT * FROM '.$model->tableName["rate_buy"].' WHERE `rate` = '.$type.' ORDER BY `id` DESC LIMIT 30');
        $data = $model->runQuerySQL($query, [], true);
        return $data;
    }
    public static function hideName($name){
        return str_replace(array_slice(preg_split('//u', $name, null, PREG_SPLIT_NO_EMPTY), 0, -1), '*', $name);
    }
    function checkIssetBuyHistory($id){
        $model = new DbManage();

        $query = 'SELECT * FROM '.$model->tableName["buy_history"].' WHERE `id` = ?';
        $data = $model->runQuerySQL($query, [$id], true);
        return $data;
    }
    function checkRateBuyUser($user, $id){
        $buy = $this->checkIssetBuyHistory($id);
        if(!empty($buy)){
            if($buy[0]["user"] == $user && $buy[0]["rate"] == 0 && ($buy[0]["status"] == "已签收" || $buy[0]["status"] == "已取消")){
                return true;
            }
        }
        return false;
    }
    //INVITE
    function getUserData($id){
        $model = new DbManage();

        $query = 'SELECT * FROM '.$model->tableName["user"].' WHERE `id` = ? LIMIT 1';
        $data = $model->runQuerySQL($query, [$id], true);
        return $data;
    }
}