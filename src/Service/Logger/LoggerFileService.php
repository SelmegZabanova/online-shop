<?php

namespace Service\Logger;

class LoggerFileService implements LoggerServiceInterface
{
    public function error(string $message, array $data = [])
    {
        $errorFile = './../Storage/Log/error.txt';
        date_default_timezone_set('Europe/Moscow');
        $date = date('Y-m-d H:i:s');
        $data["Datetime"]="$date";

        foreach($data as $value){
            file_put_contents($errorFile, "$value \n", FILE_APPEND);
            echo '\n';
        }
    }
    public function info(string $message, array $data = [])
    {
        $infoFile = './../Storage/Log/info.txt';
        date_default_timezone_set('Europe/Moscow');
        $date = date('Y-m-d H:i:s');
        $data["Datetime"]="$date";
        foreach($data as $value){
            file_put_contents($infoFile, "$value \n", FILE_APPEND);
            echo '\n';
        }

    }
    public function warning(string $message, array $data = [])
    {
        $warningFile = './../Storage/Log/warning.txt';
        date_default_timezone_set('Europe/Moscow');
        $date = date('Y-m-d H:i:s');
        $data["Datetime"]="$date";
        foreach($data as $value){
            file_put_contents($warningFile, "$value \n", FILE_APPEND);
            echo '\n';
        }
    }

}