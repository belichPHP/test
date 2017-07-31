<?php
namespace app\core;

use PDO;


class Model
{
    protected static $pdo;


    public static function connect()
    {
        $connection = include "db.php";
        self::$pdo = new PDO($connection['host'], $connection['username'], $connection['password']);
    }
}