<?php


namespace app\models;

//use app\models\Model;

class Cart extends Model
{
    public $totalItemCount;
    public $totalCost;
    public $productList;

    protected function getTableName()
    {
        return "Cart";
    }
}