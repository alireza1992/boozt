<?php

use App\Core\Application;

class m_2_CreateOrdersTable
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE orders (
                id INT AUTO_INCREMENT PRIMARY KEY,
                customer_id INT NOT NULL,
                purchase_date timestamp NOT NULL,
                country VARCHAR(255) NOT NULL,
                device VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
        /**
         * Seed dummy data
         */
        $sql = "INSERT INTO orders (customer_id, purchase_date, country, device, created_at) VALUES 
                                                                                    ('1','2021-02-02','iran','iphone','2021-02-02'),
                                                                                    ('2','2021-03-02','usa','iphone','2021-03-02') ";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE orders;";
        $db->pdo->exec($SQL);
    }
}