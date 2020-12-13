<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel //родительский класс, используется именно как библиотека/конструктор, установлен как абстрактный, для запрета пустого вызова
{
    //protected $tableName = "";

    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function getOne($id) {
        $sql = "SELECT FROM {$this->getTableName()} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }
    public function getAll() {
        $sql = "SELECT FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }
    public function insert() {
        $sql = "INSERT INTO {$this->getTableName()}";
        return $this->db->query($sql);
    }

    public function delete() {
        $sql = "DELETE FROM {$this->getTableName()}";
        return $this->db->query($sql);
    }

    abstract protected function getTableName() ; // абстрактная функция, не содержащая тело, абстрактные методы должны в конце концов каким-либо наследником быть конкретизированы

}