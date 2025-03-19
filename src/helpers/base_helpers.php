<?php

declare(strict_types=1);

if (!function_exists('config')) {
    function config(string $configName): array
    {
        $configPath = __DIR__."/../config/{$configName}.php";

        return require $configPath;
    }
}

if (!function_exists('errorLog')) {
    function errorLog(string $errorMessage): void
    {
        $date = date('Y-m-d H:i:s');
        $logPath = __DIR__.'/../logs/app.log';
        $logMessage = sprintf('[%s] %s'.PHP_EOL, $date, $errorMessage);

        error_log($logMessage, 3, $logPath);
    }
}