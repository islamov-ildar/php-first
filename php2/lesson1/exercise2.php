<?php

class Db
{
    protected $tableName;
    protected $keyValueArr = [];

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function first($id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        return $sql;
    }

    public function where($key, $value)
    {
        $this->keyValueArr[] = ['colName' => $key, 'valName' => $value];
        return $this;
    }

    public function get()
    {

        $sql = "SELECT * FROM {$this->tableName} ";
        if(!empty($this->keyValueArr)) {

            $sql .= "WHERE ";

            foreach ($this->keyValueArr as $item) {
                $sql .= "{$item['colName']} = {$item['valName']} ";
                if (count($this->keyValueArr) > 1 && $item != end($this->keyValueArr)) {
                    $sql .= "AND ";
                }
            }
        }

        return $sql;
    }

}

$db = new Db();

echo $db->table('user')->first(3) . "<br>";

echo $db->table('product')->where('name', 'Alex')->where('session', 123)->where('id', 5)->get();

