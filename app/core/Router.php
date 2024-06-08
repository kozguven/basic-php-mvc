<?php

class Router
{
    protected $routes = [];

    /**
     * Adds a new route to the router with the given route and parameters.
     *
     * @param string $route The route to be added.
     * @param array $params The parameters associated with the route. Default is an empty array.
     * @return void
     */
    public function add($route, $params = []): void
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
    /**
     * Dispatches the given URL to the appropriate controller and action.
     *
     * @param string $url The URL to be dispatched.
     * @return void
     */
    public function dispatch($url): void
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
    /**
     * Executes the controller and action specified in the given parameters.
     *
     * @param array $params An associative array containing the controller and action names.
     *                      The keys should be 'controller' and 'action', respectively.
     *                      The 'action' key is optional, and if not provided, the default action is 'index'.
     * @throws None
     * @return void
     */
    protected function executeController($params): void
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
    /**
     * Removes the query string variables from the given URL.
     *
     * @param string $url The URL from which to remove the query string variables.
     * @return string The URL with the query string variables removed.
     */
    protected function removeQueryStringVariables($url): string
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
