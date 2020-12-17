<?php


namespace app\models;


class Order extends Model
{
    public $order_id;
    public $customer_id;
    public $address;
    public $discount;
    public $weight;
    public $quantity;

    public function getTableName()
    {
        return "Order";
    }
}