<?php

namespace Classes;

class routes
{

    public static $routes = [];

    public static function getRoutes() {
        return self::$routes;
    }

    public static function addRoute($route, $page, $variables = null) {
        if($variables == null) {
            array_push(self::$routes, ['route'=> $route, 'page' => $page]);
        } else {
            array_push(self::$routes, ['route'=> $route, 'page' => $page, 'variables' => $variables]);
        }
    }

    public static function addApi($route, $page, $variables = null) {
        if($variables == null) {
            array_push(self::$routes, ['api'=> $route, 'page' => $page]);
        } else {
            array_push(self::$routes, ['api'=> $route, 'page' => $page, 'variables' => $variables]);
        }
    }

    public static function getRoute($route) {

        foreach (self::$routes as $path) {
            $result = array_search($route, $path);

            if($result != false) {

                return $path;
            }

        }

        return ['page' => 'errors/404'];

    }

    public static function addController($uri, $controller, $function = null) {
        if($function == null) {
            array_push(self::$routes, ['controller'=> $controller, 'uri' => $uri]);
        } else {
            array_push(self::$routes, ['controller'=> $controller, 'function' => $function, 'uri' => $uri]);
        }
    }

}