<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\Db;
use App\View\View;

class PostController
{
    public $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function showAllPosts()
    {
        $this->view->renderHtml('posts.php', [
            'posts' => Post::findAll()
        ]);
    }

    public function showPostBySlug($slug)
    {
        $post = Post::findBySlug($slug);
        if ($post == null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            exit;
        }
        $this->view->renderHtml('post.php', [
            'post' => $post,
        ]);
    }
}