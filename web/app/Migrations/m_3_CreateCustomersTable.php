<?php

use App\Core\Application;

class m_3_CreateCustomersTable
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE customers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
        $sql = "INSERT INTO customers (first_name, last_name, email, created_at) VALUES 
                                                                                    ('ali','amrollahi','test@gmail.com','2021-12-02'),
                                                                                    ('john','doe','does@test.com','2021-12-02') ";
        $db->pdo->exec($sql);

    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE customers;";
        $db->pdo->exec($SQL);
    }
}