<?php

require __DIR__.'/../vendor/autoload.php';

use App\Services\TelegramBot;

$bot = new TelegramBot(getenv('TELEGRAM_TOKEN'));
$bot->run();