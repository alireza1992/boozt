<?php

namespace App\Models;

use App\Core\Application;
use PDO;

class Order extends BaseModel
{
    public \DateTime $purchase_date;
    public int $customer_id;
    public string $country;
    public string $device;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'orders';
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return ['purchase_date', 'country', 'device'];
    }

    /**
     * @return array|false
     */
    public function dailyGroupedOrders()
    {
        $statement = Application::$app->db->prepare("SELECT created_at,count(created_at) AS 'count' FROM `orders` GROUP BY created_at ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
    }

    /**
     * @return array|false
     */
    public function getTotalRevenue()
    {
        $statement = Application::$app->db->prepare("SELECT SUM(oi.price) as 'sum' from `orders` o left join `order_items` oi on oi.order_id = o.id");
        $statement->execute();
        return $statement->fetchAll();
    }

}