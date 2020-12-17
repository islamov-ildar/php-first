<?php


namespace app\models;

class Cart extends Model
{
    public $cart_id;
    public $customer_id;
    public $totalItemCount;
    public $totalCost;
    public $productList;

    protected function getTableName()
    {
        return "Cart";
    }
}