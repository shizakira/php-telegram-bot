<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface TelegramServiceContract
{
    public function processMessage(int $userId, string $message): string;
}