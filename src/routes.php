<?php

use App\Controllers\MainController;
use App\Controllers\PostController;
use App\Controllers\UserController;

return [
    '~^$~' => [MainController::class, 'main'],
    '~^posts$~' => [PostController::class, 'showAllPosts'],
    '~^posts/(\d+)$~' => [PostController::class, 'showPostById'],
    '~^posts/(\d+)/edit$~' => [PostController::class, 'editPost'],
    '~^posts/add$~' => [PostController::class, 'addPost'],
    '~^users/signup$~' => [UserController::class, 'signUp']
];