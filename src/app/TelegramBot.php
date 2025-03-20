<?php

declare(strict_types=1);

namespace App;

use App\Services\Contracts\TelegramServiceContract;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramBot
{
    private int $offset = 0;

    public function __construct(
        private readonly Api $telegram,
        private readonly TelegramServiceContract $telegramService
    ) {
    }

    public function run(): void
    {
        while (true) {
            $updates = $this->telegram->getUpdates(['offset' => $this->offset, 'timeout' => 30]);

            foreach ($updates as $update) {
                $this->dispatch($update);
            }
        }
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function dispatch(Update $update): void
    {
        $userId = $update->message?->from?->id;
        $chatId = $update->message?->chat?->id;
        $updateId = $update->updateId;
        $message = $update->message?->text;

        try {
            $response = $this->telegramService->processMessage($userId, $message);
        } catch (\TypeError $e) {
            errorLog($e->getMessage().PHP_EOL);
            $this->offset = $updateId + 1;

            return;
        }

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $response,
        ]);

        $this->offset = $updateId + 1;
    }
}