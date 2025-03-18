<?php

declare(strict_types=1);

namespace App\Database;

readonly class QueryBuilder
{
    public function __construct(
        private \PDO $conn
    ) {
    }

    public function query(string $sql, $params = [], string $className = \stdClass::class): \PDOStatement
    {
        $statement = $this->conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $className);
        $statement->execute($params);

        return $statement;
    }

    public function exec(string $sql): false|string
    {
        $this->conn->exec($sql);

        return $this->conn->lastInsertId();
    }
}