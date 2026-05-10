<?php
class Router {
    private $routes = [];

    public function get(string $path,  $callback, $middlewares = []) {
        $this->routes['GET'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function post(string $path,  $callback, $middlewares = []) {
        $this->routes['POST'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove base folder prefix
        // todo: remove the prefix
        $base = '/projects/national-health-db';
        if (strpos($path, $base) === 0) {
            $path = substr($path, strlen($base));
        }

        foreach ($this->routes[$method] ?? [] as $route => $data) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);

                // Run middlewares
                foreach ($data['middlewares'] as $mw) {
                    $result = call_user_func($mw);
                    if ($result === false) {
                        http_response_code(403);
                        echo "Forbidden";
                        return;
                    }
                }

                // Run controller
                if (is_array($data['callback'])) {
                    $controller = new $data['callback'][0]();
                    $methodName = $data['callback'][1];
                    return call_user_func_array([$controller, $methodName], $matches);
                } else {
                    return call_user_func_array($data['callback'], $matches);
                }
            }
        }

        http_response_code(404);
        echo "404 - Not Found";
    }
}
