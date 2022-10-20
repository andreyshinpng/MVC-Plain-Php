<?php

use App\Controllers\MainController;
use App\Controllers\PostController;

return [
    '~^$~' => [MainController::class, 'main'],
    '~^posts$~' => [PostController::class, 'showAllPosts'],
    '~^posts/(.*)$~' => [PostController::class, 'showPostBySlug'],
];