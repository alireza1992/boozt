<?php

use App\Core\Application;

class m_1_CreateOrderItemsTable
{

    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE order_items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                order_id INT NOT NULL,
                ean VARCHAR(255) NOT NULL,
                quantity INTEGER (11) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
        $sql = "INSERT INTO order_items (order_id, ean, quantity, price, created_at) VALUES 
                                                                                    ('1','123123123','2','23.43','2021-02-02'),
                                                                                    ('2','1231231245','4','24','2021-03-02') ";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE order_items;";
        $db->pdo->exec($SQL);
    }
}