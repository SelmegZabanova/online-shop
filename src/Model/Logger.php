<?php

namespace Model;

class Logger extends Model
{
    public static function addLog(string $message, array $data = [])
    {
        $errorMessage = $data['message'];
        $file = $data['file'];
        $line = $data['line'];
        $stmt = self::getPDO()->prepare('INSERT INTO error (message, file, line) VALUES (:message, :file, :line)');
        $stmt->execute(['message' => $errorMessage, 'file' => $file, 'line' => $line]);
    }

}