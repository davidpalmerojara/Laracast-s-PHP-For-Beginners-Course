<?php

    use core\Response;
    use core\Router;

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

    function login($user) {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'user_id' => $user['user_id'],
        ];
        session_regenerate_id(true);
    }

    function logout() {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']  );

    }


