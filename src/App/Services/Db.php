<?php

namespace App\Services;

class Db
{
    private $pdo;

    public function __construct()
    {
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
}