<?php

namespace App\Database;

class Connection
{
    private \PDO $conn;

    public function __construct(
        private readonly array $config
    ) {
        $this->init();
    }

    public function getConnection(): \PDO
    {
        return $this->conn;
    }

    private function createDsn(): string
    {
        return sprintf(
            '%s:host=%s;port=%s;dbname=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['port'],
            $this->config['database']
        );
    }

    private function init(): void
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->conn = new \PDO(
            $this->createDsn(),
            $this->config['username'],
            $this->config['password'],
            $options
        );
    }
}