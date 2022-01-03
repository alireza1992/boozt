<?php

use App\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     *
     */
    public function testCanGetCustomersName()
    {
        $customer = new Customer();
        $customer->firstName = 'alireza';
        $customer->lastName = 'amrollahi';
        $name = $customer->getName();
        $this->assertSame('alireza amrollahi', $name);
    }

    /**
     *
     */
    public function testGetCustomersTable()
    {
        $customer = Customer::tableName();
        $this->assertEquals('customers', $customer);
    }
}