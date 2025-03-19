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

            sleep(1);
        }
    }

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function dispatch(Update $update): void
    {
        $updateId = $update->updateId;
        $message = $update->message->text;
        $username = $update->message->from->username;
        $chatId = $update->message->chat->id;

        $response = $this->telegramService->processMessage($username, $message);

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $response,
        ]);

        $this->offset = $updateId + 1;
    }
}