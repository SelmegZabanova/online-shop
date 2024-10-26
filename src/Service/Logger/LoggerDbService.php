<?php

namespace Service\Logger;

class LoggerDbService implements LoggerServiceInterface
{
    protected static \PDO $pdo ;

    public static function getPDO()
    {
        if(!isset(self::$pdo)){
            self::$pdo = new \PDO('pgsql:host=postgres_db;port=5432;dbname=mydb', 'user', 'pass');
        }
        return self::$pdo;
    }

    public function error(string $message, array $data = [])
    {
        $errorMessage = $data['message'];
        $file = $data['file'];
        $line = $data['line'];
        $stmt = self::getPDO()->prepare('INSERT INTO error (message, file, line) VALUES (:message, :file, :line)');
        $stmt->execute(['message' => $errorMessage, 'file' => $file, 'line' => $line]);

    }
    public function info(string $message, array $data = [])
    {

    }
    public function warning(string $message, array $data = [])
    {

    }

}