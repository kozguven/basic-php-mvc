<?php

class Router
{
    protected $routes = [];

    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->executeController($params);
                return;
            }
        }

        echo "No route matched.";
    }

    protected function executeController($params)
    {
        $controllerName = ucfirst($params['controller']) . 'Controller';
        $methodName = $params['action'] ?? 'index';

        if (file_exists('../app/controllers/' . $controllerName . '.php')) {
            require_once '../app/controllers/' . $controllerName . '.php';
            $controller = new $controllerName;
            if (method_exists($controller, $methodName)) {
                unset($params['controller']);
                unset($params['action']);
                call_user_func_array([$controller, $methodName], $params);
            } else {
                echo "Method $methodName not found in controller $controllerName";
            }
        } else {
            echo "Controller $controllerName not found";
        }
    }

    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}