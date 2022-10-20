<?php

namespace App\Models;

use App\Services\Db;

class Post extends ActiveRecordEntity
{
    private $id;

    private $slug;

    private $title;

    private $excerpt;

    private $body;

    private $author_id;

    public static function getTableName(): string
    {
        return 'posts';
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

    public function getAuthor()
    {
        return User::findById($this->author_id);
    }

}