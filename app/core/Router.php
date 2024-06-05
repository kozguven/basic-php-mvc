<?php

class Router
{
    public function dispatch($url)
    {
        $url = trim($url, '/');
        $url = explode('/', $url);

        $controllerName = ucfirst(array_shift($url)) . 'Controller';
        $methodName = array_shift($url) ?? 'index';
        $params = $url;

        if (file_exists('../app/controllers/' . $controllerName . '.php')) {
            require_once '../app/controllers/' . $controllerName . '.php';
            $controller = new $controllerName;
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $params);
            } else {
                echo "Method $methodName not found in controller $controllerName";
            }
        } else {
            echo "Controller $controllerName not found";
        }
    }
}