<?php

use PHPUnit\Framework\TestCase;

class OrderItemsTest extends TestCase
{
    /**
     *
     */
    public function testGetOrderItemsTable()
    {
        $orderItems = \App\Models\OrderItems::tableName();
        $this->assertEquals('order_items',$orderItems);
    }
}