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

    if (isset($page['variables'])) {
        echo $blade->make($page['page'], $page['variables'])->render();
    } else {
        echo $blade->make($page['page'])->render();
    }

