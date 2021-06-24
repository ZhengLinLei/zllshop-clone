<?php
class DbQueryManage extends DbManage{
    function runQuerySQL($query, $param = [], $select = false){
        $prepare = $this->pdo()->prepare($query);
        $data_return = $prepare->execute($param);

        if($select){
            $data_return = $prepare->fetchAll();
        }
        return $data_return;
    }
}