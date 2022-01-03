<?php

namespace App\Models;


class OrderItems extends BaseModel
{

    public string $ean ;
    public int $order_id;
    public int $quantity ;
    public float $price ;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'order_items';
    }
}