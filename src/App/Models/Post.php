<?php

namespace App\Models;

class Post
{
    private $id;

    private $slug;

    private $title;

    private $excerpt;

    private $body;

    private $author_id;

    public static function getPosts()
    {

    }

    public static function findBySlug($slug, $posts)
    {
        foreach ($posts as $key => $value) {
            if ($value->slug === $slug) {
                return $value;
            }
        }
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