<?php

class Route
{
    private $routes = [];

    public function addRoute($method, $pattern, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback,
        ];
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $route) {
            if ($requestMethod === $route['method'] && $requestUri === $route['pattern']) {
                call_user_func($route['callback']);
                return;
            }
        }

        // Route non trouvée
        http_response_code(404);
        echo "404 Not Found réponse routeur";
    }
}

