<?php

declare(strict_types=1);

namespace App\Database\Repositories;

class UserRepository extends Repository
{
    private static string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        $statement = $this->query(
            'select * from '.self::$table.' where username = :username for update',
            ['username' => $username]
        );

        return $statement->fetch() ?: null;
    }

    public function create(string $username): array
    {
        $this->query(
            'insert into '.self::$table.' (username) values (:username )',
            ['username' => $username]
        );

        return [
            'id' => (int) $this->conn->lastInsertId(self::$table.'_id_seq'),
            'username' => $username,
            'balance' => 0.0
        ];
    }

    public function updateBalance(string $username, float $newBalance): void
    {
        $this->query(
            'update '.self::$table.' set balance = :balance where username = :username',
            [
                'balance' => $newBalance,
                'username' => $username
            ]
        );
    }
}