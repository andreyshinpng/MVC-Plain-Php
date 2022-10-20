<?php

namespace App\Models;

use App\Services\Db;

class Post
{
    private $id;

    private $slug;

    private $title;

    private $excerpt;

    private $body;

    private $author_id;

    public static function findAll()
    {
        $db = new Db();
        return $db->query('SELECT * FROM `posts`;', [], Post::class);
    }

    public static function findBySlug(string $slug)
    {
        $db = new Db();
        return ($db->query("SELECT * FROM `posts` WHERE `slug` = '{$slug}';", [], Post::class))[0];
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getExcerpt()
    {
        return $this->excerpt;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

}