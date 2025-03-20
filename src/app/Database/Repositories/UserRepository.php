<?php

declare(strict_types=1);

namespace App\Database\Repositories;

class UserRepository extends Repository
{
    private static string $table = 'users';

    public function findById(int $userId): ?array
    {
        $statement = $this->query(
            'select * from '.self::$table.' where id = :id for update',
            ['id' => $userId]
        );

        return $statement->fetch() ?: null;
    }

    public function create(int $userId): array
    {
        $this->query(
            'insert into '.self::$table.' (id) values (:id )',
            ['id' => $userId]
        );

        return [
            'id' => $userId,
            'balance' => 0.0
        ];
    }

    public function updateBalance(int $userId, float $newBalance): void
    {
        $this->query(
            'update '.self::$table.' set balance = :balance where id = :id',
            [
                'balance' => $newBalance,
                'id' => $userId
            ]
        );
    }
}