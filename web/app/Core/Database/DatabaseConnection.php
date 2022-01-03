<?php

namespace App\Core\Database;


class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;

    private $conn;
    private \PDO $pdo;

    /**
     * Singleton Design Pattern
     */
    private function __construct()
    {
        $config = [
            'Database' => [
                'dsn' => 'mysql:host=mysqldb;dbname=test;charset=utf8;port=3306',
                'user' => 'root',
                'password' => 'root',
            ]
        ];
        $this->pdo = new \PDO($config['Database']['dsn'], $config['Database']['user'], $config['Database']['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): ?DatabaseConnection
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
     * @return \PDO
     */
    public function pdo(): \PDO
    {
        return $this->pdo;
    }
}