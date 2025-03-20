<?php

declare(strict_types=1);

namespace App\Services;

use App\Database\Repositories\UserRepository;
use App\Services\Contracts\TelegramServiceContract;

class TelegramBalanceService implements TelegramServiceContract
{
    private static string $balanceResponse = 'Ваш баланс:';
    private static string $negativeBalanceError = 'Баланс не может быть отрицательным';

    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function processMessage(int $userId, string $message): string
    {
        $this->userRepository->beginTransaction();

        $user = $this->userRepository->findByUsername($userId) ?? $this->userRepository->create($userId);

        $amount = $this->sanitizeBalance($message);

        if ($amount) {
            $newBalance = $user['balance'] + $amount;

            if ($newBalance < 0) {
                $this->userRepository->rollBack();

                return self::$negativeBalanceError;
            }

            $this->userRepository->updateBalance($userId, $newBalance);
            $this->userRepository->commit();

            return sprintf(self::$balanceResponse.' $%.2f', $newBalance);
        }

        $this->userRepository->commit();

        return sprintf(self::$balanceResponse.' $%.2f', $user['balance']);
    }

    private function sanitizeBalance(string $message): ?float
    {
        $floatNormalized = str_replace(',', '.', trim($message));

        if (!preg_match('/^-?(0|[1-9]\d*)(\.\d+)?$/', $floatNormalized)) {
            return null;
        }

        return (float) $floatNormalized;
    }
}