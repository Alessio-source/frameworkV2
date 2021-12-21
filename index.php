<?php

    require_once __DIR__ . '/vendor/autoload.php';
    require __DIR__ . '/functions/template.php';
    use Classes\routes;
    use Jenssegers\Blade\Blade;

    $request = $_SERVER['REQUEST_URI'];
    $blade = new Blade('views', 'cache');

    $router = new routes();

    require __DIR__ . '/routes/web.php';
    require __DIR__ . '/routes/api.php';

    $page = $router::getRoute($request);

    if(isset($page['controller'])) {
        require __DIR__ . "/controllers/$page[controller].php";
        require __DIR__ . '/functions/controller.php';
        
        $method = $_SERVER['REQUEST_METHOD'];

        if(isset($page['function'])) {
            $class = $page['controller'];
            $function = $page['function'];
            $class::$function();
        } else {
            switch ($method) {
                case 'GET':
                    $page['controller']::index();
                    break;
                case 'POST':
                    $page['controller']::create();
                    break;
                case 'PUT':
                    $page['controller']::update();
                    break;
                case 'DELETE':
                    $page['controller']::delete();
                    break;
            }
        }

    } else {
        if (isset($page['variables'])) {
            echo $blade->make($page['page'], $page['variables'])->render();
        } else {
            echo $blade->make($page['page'])->render();
        }
    }

    
