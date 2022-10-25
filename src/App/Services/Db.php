<?php

namespace App\Services;

class Db
{
    private $pdo;

    public static $instancesCount = 0;

    private static $instance;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        self::$instancesCount++;
        $dbSettings = (require __DIR__ . '/../../settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'],
            $dbSettings['user'],
            $dbSettings['password']
        );
        $this->pdo->exec('SET NAMES UTF-8');
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