<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\Db;
use App\View\View;
use ReflectionObject;

class PostController
{
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

    public function showPostById(int $id)
    {
        $post = Post::findById($id);
        if ($post == null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            exit;
        }
        $this->view->renderHtml('post.php', [
            'post' => $post,
        ]);
    }

    public function editPost(int $id)
    {
        $post = Post::findById($id);
        if ($post == null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            exit;
        }

        $post->setTitle('Hello world!');
        $post->save();
//        $this->view->renderHtml('edit.php', [
//            'post' => ''
//        ]);
    }

    public function addPost(): void
    {
        $author = User::getById(1);

        $post = new Post();
        $post->setAuthor($author);
        $post->setTitle('New post title');
        $post->setBody('New post body');

        $post->save();
    }
}