<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramBot
{
    private Api $telegram;

    public function __construct(string $token)
    {
        $this->telegram = new Api($token);
    }

    public function run(): void
    {
        $offset = 0;

        while (true) {
            $updates = $this->telegram->getUpdates(['offset' => $offset, 'timeout' => 30]);

            foreach ($updates as $update) {
                $updateId = $update['update_id'];
                $message = $update['message']['text'] ?? '';

                $this->telegram->sendMessage([
                    'chat_id' => $update['message']['chat']['id'],
                    'text' => $message
                ]);

                $offset = $updateId + 1;
            }

            sleep(1);
        }
    }
}