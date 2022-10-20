<?php

namespace App\Models;

use App\Services\Db;

abstract class ActiveRecordEntity
{
    public static function findAll()
    {
        $db = new Db();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY `id`;', [], static::class);
    }

    public static function findById(int $id)
    {
        $db = new Db();
        return ($db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `id` = '{$id}';", [], static::class))[0];
    }

    public static function findBySlug(string $slug)
    {
        $db = new Db();
        return ($db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `slug` = '{$slug}';", [], static::class))[0];
    }

    abstract protected static function getTableName(): string;
}