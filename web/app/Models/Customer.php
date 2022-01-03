<?php

namespace App\Models;

use App\Core\Application;
use PDO;

class Customer extends BaseModel
{
    public string $firstName ;
    public string $lastName ;
    public string $email ;

    public function getName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'customers';
    }

    /**
     * @return array|false
     */
    public function dailyGroupedCustomers()
    {
        $statement = Application::$app->db->prepare("SELECT created_at,count(created_at) AS 'count' FROM `customers` GROUP BY created_at ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);
    }
}