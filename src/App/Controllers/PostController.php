<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\View\View;

class PostController
{
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function allPosts()
    {
        $posts = Post::getPosts();
        $this->view->renderHtml('posts.php', [
            'posts' => $posts
        ]);
    }

    public function showPost($slug) {
        $this->view->renderHtml('post.php', [
            'post' => Post::findBySlug($slug, Post::getPosts())
        ]);
    }
}