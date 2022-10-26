<?php

namespace App\Services;

use App\Exceptions\DbException;

class Db
{
    private $pdo;

    private static $instance;

    private function __construct()
    {
        $dbSettings = (require __DIR__ . '/../../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
                $dbSettings['user'],
                $dbSettings['password']
            );
            $this->pdo->exec('SET NAMES UTF-8');
        } catch (\PDOException $e) {
            throw new DbException('Database connection error: ' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if ($result === false) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}