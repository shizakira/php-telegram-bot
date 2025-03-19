<?php

declare(strict_types=1);

namespace App\Database\Repositories;

abstract class Repository
{
    public function __construct(
        protected readonly \PDO $conn
    ) {
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $statement = $this->conn->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    public function beginTransaction(): void
    {
        $this->conn->beginTransaction();
    }

    public function commit(): void
    {
        $this->conn->commit();
    }

    public function rollBack(): void
    {
        $this->conn->rollBack();
    }
}