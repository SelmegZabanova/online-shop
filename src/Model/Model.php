<?php

namespace Model;

class Model
{

    protected static \PDO $pdo ;

    public static function getPDO()
    {
        if(!isset(self::$pdo)){
            self::$pdo = new \PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        }
        return self::$pdo;

    }


}