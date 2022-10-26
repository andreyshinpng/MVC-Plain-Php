<?php

// Front Controller

use App\Services\Db;

try {
    function autoload(string $className)
    {
        require_once __DIR__ . '/../src/' . str_replace("\\", "/", $className) . '.php';
    }

    spl_autoload_register('autoload');

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $controllerActionName = $controllerAndAction[1];

    $controller = new $controllerName;
    $controller->$controllerActionName(...$matches);

    if (!$isRouteFound) {
        throw new \App\Exceptions\NotFoundException();
    }
} catch (\App\Exceptions\DbException $e) {
    $view = new \App\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\App\Exceptions\NotFoundException $e) {
    $view = new \App\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}