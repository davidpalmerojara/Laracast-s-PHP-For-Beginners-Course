<?php

    namespace core;

    use core\middleware\Middleware;

    class Router
    {

        protected array $routes = [];

        public function get($uri, $controller): Router
        {
            return $this->add('GET', $uri, $controller);
        }

        public function add($method, $uri, $controller): Router
        {
            $this->routes[] = [
                'uri' => $uri,
                'controller' => $controller,
                'method' => $method,
                'middleware' => null
            ];

            return $this;
        }

        public function post($uri, $controller): Router
        {
            return $this->add('POST', $uri, $controller);
        }

        public function delete($uri, $controller): Router
        {
            return $this->add('DELETE', $uri, $controller);
        }

        public function patch($uri, $controller): Router
        {
            return $this->add('PATCH', $uri, $controller);
        }

        public function put($uri, $controller): Router
        {
            return $this->add('PUT', $uri, $controller);
        }

        public function only($key): Router
        {
            $this->routes[array_key_last($this->routes)]['middleware'] = $key;

            return $this;
        }

        public function route($uri, $method)
        {
            foreach ($this->routes as $route) {
                if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                        Middleware::resolve($route['middleware']);



                    return require base_path($route['controller']);
                }
            }
            abort();
            return null;
        }

        protected function abort($code = 404)
        {
            http_response_code(404);

            require base_path("views/{$code}.php");
            die();
        }
    }
