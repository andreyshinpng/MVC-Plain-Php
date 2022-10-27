<?php

namespace App\Models;

use App\Services\Db;
use http\Exception\InvalidArgumentException;

class Post extends ActiveRecordEntity
{
    protected $id;

    protected $title;

    protected $excerpt;

    protected $body;

    protected $author_id;

    public static function getTableName(): string
    {
        return 'posts';
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

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setExcerpt(string $excerpt)
    {
        $this->excerpt = $excerpt;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function setAuthor($author)
    {
        $this->authorId = $author->getId();
    }
}