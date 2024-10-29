<?php

namespace Service\Logger;

use Model\Logger;

class LoggerDbService implements LoggerServiceInterface
{
    public function error(string $message, array $data = []): void
    {
        Logger::addLog($message, $data);
    }

    public function info(string $message, array $data = [])
    {

    }
    public function warning(string $message, array $data = [])
    {

    }

}