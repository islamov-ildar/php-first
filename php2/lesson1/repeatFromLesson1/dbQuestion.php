<?php

class Db {
    protected $tableName;
    protected $keyValueArr = [];



    public function table($tableName) {
        //Сохранить имя таблицы
        $this->tableName = $tableName;
        return $this;
    }

    public function first($id) {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        return $sql;
    }

    public function where ($key, $value) {

        $this->keyValueArr[]=['colName' => $key, 'valName' => $value];

        return $this;
    }
    public function get() {

        $sql = "SELECT * FROM {$this->tableName} WHERE ";

        foreach ($this->keyValueArr as $item) {
            $sql .= "{$item['colName']} = {$item['valName']} ";
            if (count($this->keyValueArr) > 1  && $item != end($this->keyValueArr)) {
                $sql .= "AND ";
            }
        }

        return $sql;
    }

}

$db = new Db();

echo $db->table('user')->first(3) . "<br>";

echo $db->table('product')->where('name', 'Alex')->where('session', 123)->where('id', 5)->get();

//$db->where('name', 'Alex')->where('name12', 'Alex12');

var_dump($db);
//SELECT * FROM product WHERE name = Alex AND session = 123 AND id = 5