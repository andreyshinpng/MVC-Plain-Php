<?php

namespace App\Models;

use App\Services\Db;

abstract class ActiveRecordEntity
{
    public static function findAll(): array
    {
        $db = new Db();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY `id`;', [], static::class);
    }

    public static function findById(int $id): ?self
    {
        $db = new Db();
        $entities = $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `id` = '{$id}';", [], static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findBySlug(string $slug): ?self
    {
        $db = new Db();
        $entities = $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `slug` = '{$slug}';", [], static::class);
        return $entities ? $entities[0] : null;
    }

    abstract protected static function getTableName(): string;
}