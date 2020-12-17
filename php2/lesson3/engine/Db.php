<?php

namespace app\engine;
//виртуальная подпапка пространства имен (при возникновении одинаковых имен классов), для обращения к классу необходимо учитывать эту подпапку

use app\traits\TSingletone;

final class Db
{
    protected $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'login' => 'root',
        'password' => 'root',
        'database' => 'shop',
        'charset' => 'utf8mb4'
    ];

    //паттерн SINGLETONE
    /*protected function __construct(){} //закрытие конструктора в protected не позволяет создать экземпляр Db напрямую
    protected function __clone(){}
    protected function __wakeup(){}


    protected static $instance = null;

    public static function getInstance() { //описание статической функции проверки единственности экземпляра Db
        if(is_null(static::$instance)) {
            static::$instance = new static(); //сохраняем экземпляр текущего класса в статической переменной
            //var_dump("Новый экземпляр DB создан");
        }

        return static::$instance;
    }*/

    use TSingletone; //Подключение трейта синглтон

    protected $connection = null;

    protected function getConnection()
    {

        if (is_null($this->connection)) {
            //var_dump("Подключаюсь к БД!");
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']); //т.к. класс PDO находится в глобальном пространстве имен, а наш класс Db - нет, то для доступа к классу PDO надо перед ним ставить левый слеш
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    protected function prepareDsnString() {
        $testQuery = sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
        );
        //var_dump($testQuery);
        return $testQuery;
}

    protected function query($sql, $params)
    {
        //var_dump($sql, $params);
        $stmt = $this->getConnection()->prepare($sql);
        //$stmt->bindValue(":id", 1, \PDO::PARAM_INT); //одиночная привязка переменной к запросу
        $stmt->execute($params);
        return $stmt;
    }

    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }

    public function lastInsertId() {
        //TODO верните последний id - Done!
        return $this->connection->lastInsertID();
    }

    public function queryObject($sql, $params = [], $class) {
        $stmt = $this->query($sql, $params = []);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $stmt->fetch(); //TODO надо доделать чтобы возвращался объект а не массив см.статьи и видео 02:00:00
    }

    public function queryOne($sql, $params)
    {
        //$sql = "SELECT name FROM users WHERE email = :id";
        //$params = ["id" => 1];
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        //выполнить $sql
        return $this->query($sql, $params)->fetchAll();
    }
}