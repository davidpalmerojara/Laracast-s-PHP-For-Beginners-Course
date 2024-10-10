<?php

    use core\Response;
    use core\Router;
    use core\Session;

    function dd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";

        die();
    }

    function urlIs($value): bool
    {
        return $_SERVER['REQUEST_URI'] === $value;
    }

    function authorize($condition, $status = Response::FORBIDDEN)
    {
        if (!$condition) {
            abort($status);
        }
    }

    function abort($code = 404)
    {
        http_response_code(404);

        require base_path("views/{$code}.php");
        die();
    }

    function base_path($path = ''): string
    {
        return BASE_PATH . $path;
    }

    function view($path = '', $attributes = [])
    {
        extract($attributes);
        require base_path("views/" . $path);
    }

    function redirect($route) {
        header('Location: ' . $route);
        exit();
    }

    function old($key, $default = '') {
        return Session::get('old')[$key] ?? $default;
    }




