<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Database\Repositories\UserRepository;
use App\Services\TelegramBalanceService;
use App\TelegramBot;
use App\Database\Connection;
use Telegram\Bot\Api;

try {
    $conn = new Connection(config('postgres_database'));
    $userRepository = new UserRepository($conn->getConnection());
    $telegramBalanceService = new TelegramBalanceService($userRepository);
    $telegramApi = new Api(getenv('TELEGRAM_TOKEN'));
    $bot = new TelegramBot($telegramApi, $telegramBalanceService);

    $bot->run();
} catch (Throwable $e) {
    errorLog($e->getMessage());
}



