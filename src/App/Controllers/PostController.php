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
        $this->db = new Db();
    }

    public function showAllPosts()
    {
        $posts = $this->db->query('SELECT * FROM `posts`;', [], Post::class);
//        echo '<pre>';
//        var_dump($posts);
//        echo '</pre>';
//        die;

        $this->view->renderHtml('posts.php', [
            'posts' => $posts
        ]);
    }

    public function showPost($slug)
    {
        $post = $this->db->query("SELECT * FROM `posts` WHERE `slug`='{$slug}';", [], Post::class);

        if ($post === []) {
            $this->view->renderHtml("errors/404.php", [], 404);
        }

        $this->view->renderHtml('post.php', [
            'post' => $post[0]
        ]);
    }
}