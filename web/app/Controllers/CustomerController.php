<?php

namespace App\Controllers;
use App\Models\Customer;

class CustomerController extends Controller
{
    private Customer $customer;
    /*
     *
     */
     public function __construct()
    {
        $this->customer = new Customer();
    }

    /**
     * @return false|string
     */
    public function index(): string
    {
        $customers = $this->customer->dailyGroupedCustomers();
        return json_encode($customers);
    }
}