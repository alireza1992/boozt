<?php

namespace App\Models;

use App\Core\Application;
use App\Core\Interfaces\ModelInterface;
use App\Core\Model;
use PDO;
use \PDOStatement;

/**
 * An ORM like class
 */
abstract class BaseModel extends Model implements ModelInterface
{
    abstract public static function tableName(): string;

    /**
     * @param string $sql
     * @return PDOStatement
     */
    public static function prepare(string $sql): PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    /**
     * @param array $where
     * @param array|string[] $columns
     * @return array|false
     */
    public static function get( array $where, array $columns = ['*'])
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $columns = implode(',', $columns);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT $columns FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array|false
     */
    public static function all()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}