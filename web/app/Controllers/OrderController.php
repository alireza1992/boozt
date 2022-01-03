<?php

namespace App\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    private Order $order;

    /**
     *
     */
    public function __construct()
    {
        $this->order = new Order();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $orders = $this->order->dailyGroupedOrders();

        return json_encode($orders);
    }
}