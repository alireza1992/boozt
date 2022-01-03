<?php

namespace App\Core\Database;

use App\Core\Application;
use App\Core\Interfaces\DatabaseInterface;
use \PDOStatement;

class Database implements DatabaseInterface
{
    public \PDO $pdo;

    public function __construct()
    {
        $instance = DatabaseConnection::getInstance();
        $this->pdo = $instance->pdo();
    }


    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/../../Migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        /**
         * skip current folder and parent folder
         */
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR . "/../../Migrations/". $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no Migrations to apply");
        }
    }

    /**
     *
     */
    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    /**
     * @return array|false
     */
    public function getAppliedMigrations(): array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM Migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * @param array $newMigrations
     */
    public function saveMigrations(array $newMigrations): void
    {
        $str = implode(',', array_map(fn($migrations) => "('$migrations')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO Migrations (migration) VALUES $str");
        $statement->execute();
    }

    /**
     * @param string $sql
     * @return PDOStatement
     */
    public function prepare(string $sql): PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * @param string $message
     */
    private function log(string $message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
}