<?php

namespace App\Models;

use App\Services\Db;
use ReflectionObject;

abstract class ActiveRecordEntity
{
    abstract protected static function getTableName(): string;

    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY `id`;', [], static::class);
    }

    public static function findById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `id` = '{$id}';", [], static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findBySlug(string $slug): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `slug` = '{$slug}';", [], static::class);
        return $entities ? $entities[0] : null;
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameUnderScore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameUnderScore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param'.$index; // param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = "UPDATE " . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $params = [];
        $params2values = [];
        foreach ($filteredProperties as $column => $value) {
            $columns[] = '`' . $column . '`';
            $paramName = ':' . $column;
            $params[] = $paramName;
            $params2values[$paramName] = $value;
        }
        $sql = "INSERT INTO " . static::getTableName() . " (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $params) . ");";
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
    }

    private function delete(): void
    {
        $db = Db::getInstance();
        $sql = "DELETE FROM `" . static::getTableName() . "` WHERE id = :id;";
        $db->query($sql, [':id' => $this->id], static::class);
        $this->id = null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id = :id;', [':id' => $id], static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            "SELECT * FROM `" . static::getTableName() . "` WHERE `" . $columnName . "` = :value LIMIT 1;",
            [':value' => $value], static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }
}