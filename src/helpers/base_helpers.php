<?php

if (!function_exists('config')) {
    function config(string $configName): array
    {
        $configPath = __DIR__."/../config/{$configName}.php";

        return require $configPath;
    }
}