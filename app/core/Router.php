<?php
class Router {
    protected $routes = [];

    public function add($route, $controller, $action) {
        $this->routes[] = [
            'route' => $route,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($url) {
        $url = $this->removeQueryString($url);
        foreach ($this->routes as $route) {
            if ($url == $route['route']) {
                $controllerFile = '../app/controllers/' . $route['controller'] . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $route['controller']();
                    if (method_exists($controller, $route['action'])) {
                        call_user_func([$controller, $route['action']]);
                        return;
                    }
                }
            }
        }
        echo "404 Not Found";
    }

    protected function removeQueryString($url) {
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