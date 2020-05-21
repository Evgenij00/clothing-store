<?php
    // index.php - FRONT CONTROLLER!

    //Функции - printr & vardump - для красивого вывода на страницу
    // function printr($var) {
    //     static $int=0;
    //     echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
    //     print_r($var);
    //     echo '</pre>';
    //     $int++;
    // }
    
    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }

    //Функция spl_autoload_register() принимает первым аргументом имя функции, в которую будет передаваться имя класса, каждый раз, когда этот класс ещё не был загружен.
    spl_autoload_register( function($className) {
        require_once __DIR__ . '/../src/' . $className . '.php'; //__DIR__ - директория текущего файла
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) { //controllerAndAction and pattern are global or not?????
        preg_match($pattern, $route, $matches);

        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        echo 'Упс, что-то пошло не так...'; //include error 404;
        return;
    }

    // vardump( new \MyProject\Models\Products\Product() );
    
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $controllerAction = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$controllerAction(...$matches);

