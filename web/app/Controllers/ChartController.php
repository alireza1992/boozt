<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Order;

class ChartController extends Controller
{
    private Customer $customer;
    private Order $order;

    /**
     *
     */
    public function __construct()
    {
        $this->customer = new Customer();
        $this->order = new Order();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $orders = $this->order->all();
        $customers = $this->customer->all();
        $totalRevenue = $this->order->getTotalRevenue();
        $params = [
            'orderCounts' => count($orders),
            'customerCounts' => count($customers),
            'totalRevenue' => $totalRevenue[0]['sum']
        ];
        return $this->render('chart', $params);
    }
}