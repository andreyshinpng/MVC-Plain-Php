<?php

namespace App\Models;

use App\Services\Db;

class Post
{
    protected $db;

    public $slug;

    public $title;

    public $excerpt;

    public $body;

    public $author;


    public function __construct(string $slug, string $title, string $excerpt, string $body, User $author)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->author = $author;
    }

    public static function getPosts()
    {

        return [
            new Post('my-first-post', 'My First Post', 'Here is an excerpt', 'Lorem ipsum here', new User('andreyshin')),
            new Post('my-second-post', 'My Second Post', 'Here is an excerpt', 'Lorem ipsum here', new User('andreyshin')),
            new Post('my-third-post', 'My Third Post', 'Here is an excerpt', 'Lorem ipsum here', new User('andreyshin')),
        ];
    }

    public static function findBySlug($slug, $posts)
    {
        foreach ($posts as $key => $value) {
            if ($value->slug === $slug) {
                return $value;
            }
        }
    }
}