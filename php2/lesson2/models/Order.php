<?php


namespace app\models;


class Order extends Model
{
    public $address;
    public $discount;
    public $weight;
    public $quantity;

    public function getTableName()
    {
        return "Order";
    }
}