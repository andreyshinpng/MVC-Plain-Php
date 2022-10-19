<?php

use App\Controllers\MainController;
use App\Controllers\PostController;

return [
    '~^$~' => [MainController::class, 'main'],
    '~^posts$~' => [PostController::class, 'showAllPosts'],
    '~^hello/(.*)$~' => [MainController::class, 'sayHello'],
    '~^posts/(.*)$~' => [PostController::class, 'showPost'],
];