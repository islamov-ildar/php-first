<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel //родительский класс, используется именно как библиотека/конструктор, установлен как абстрактный, для запрета пустого вызова
{
    /*protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }*/

    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return Db::getInstance()->queryOne($sql, ["id" => $id]); //TODO здесь добавить проброс имени класса и заменить метод на queryObject($sql, ["id" => $id], static::class)
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        //var_dump(count((array)$this));

        $params = [];

        $sql_first_part = "INSERT INTO {$this->getTableName()} (";
        $sql_second_part = "VALUES (";

        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            //var_dump("$key => $value");
            $sql_first_part .= "$key";
            $sql_second_part .= ":$key";
            if ($value != end($this)) {
                $sql_first_part .= ", ";
                $sql_second_part .= ", ";
            } else {
                $sql_first_part .= ") ";
                $sql_second_part .= ") ";
            }
            $params["$key"] = $value;
        }

        $sql = $sql_first_part . $sql_second_part;

        var_dump($sql);
        Db::getInstance()->execute($sql, $params);
        var_dump(Db::getInstance()->lastInsertId());
        //TODO $this->id = LastInsertId - Done!
        $this->id = (int)(Db::getInstance()->lastInsertId());
        return $this;
    }

    public function update()
    {
        $sql = "UPDATE {$this->getTableName()} ...";
        return Db::getInstance()->execute($sql);
    }

    public function delete()
    {
        $params = ["id" => $this->id];

        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        return Db::getInstance()->execute($sql, $params);

    }

    abstract protected function getTableName(); // абстрактная функция, не содержащая тело, абстрактные методы должны в конце концов каким-либо наследником быть конкретизированы


}