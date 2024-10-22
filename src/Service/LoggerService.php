<?php

namespace Service;

class LoggerService
{
    public static function record($exception)
    {
        $message = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();

        $errorFile = './../Storage/Log/error.txt';

        file_put_contents($errorFile, $message, FILE_APPEND);
        file_put_contents($errorFile, $file, FILE_APPEND);
        file_put_contents($errorFile, $line, FILE_APPEND);
    }

}