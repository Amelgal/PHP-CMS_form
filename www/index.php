<?php
    //  функцию автозагрузки
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . $className . '.php';
    });

    // роутинг
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

    if (!$isRouteFound) {
        echo 'Страница не найдена!';
        return;
    }
    unset($matches[0]);
//var_dump(...$matches);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    //передаст элементы массива в качестве аргументов методу в том порядке, в котором они находятся в массиве
    $controller->$actionName(...$matches);