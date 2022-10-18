<?php

use App\Controllers\MainController;
use App\Controllers\PostController;

return [
    '~^$~' => [MainController::class, 'main'],
    '~^posts$~' => [PostController::class, 'allPosts'],
    '~^hello/(.*)$~' => [MainController::class, 'sayHello'],
    '~^posts/(.*)$~' => [PostController::class, 'showPost'],
];