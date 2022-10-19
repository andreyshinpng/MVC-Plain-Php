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
        $posts = $this->db->query('SELECT * FROM `posts`;');

        $this->view->renderHtml('posts.php', [
            'posts' => $posts
        ]);
    }

    public function showPost($slug)
    {
        $post = $this->db->query("SELECT * FROM `posts` WHERE `slug`='{$slug}';");

        if ($post === []) {
            echo '<pre>';
            var_dump($post);
            echo '</pre>';
            die();
        }

        $this->view->renderHtml('post.php', [
            'post' => $post[0]
        ]);
    }
}