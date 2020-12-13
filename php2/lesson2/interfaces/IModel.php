<?php

namespace app\interfaces;

//в интерфейсе перечисляются все методы класса

interface IModel
{
    public function getOne($id);
    public function getAll();
    //public function getTableName(); //перенесено в абстрактную функцию класса Model.php
    public function insert();
    public function delete();

}