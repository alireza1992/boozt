<?php

namespace App\Core\Interfaces;

interface ModelInterface
{
    public static function get(array $where, array $columns = ['*']);

    public static function all();
}