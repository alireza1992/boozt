<?php

use App\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    /**
     *
     */
    public function testGetOrdersTable()
    {
        $order = Order::tableName();
        $this->assertEquals('orders',$order);
    }
}