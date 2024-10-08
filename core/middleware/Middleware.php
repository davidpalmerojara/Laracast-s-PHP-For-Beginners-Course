<?php

    namespace core\middleware;

    class Middleware
    {
        const MAP = [
            'guest' => Guest::class,
            'auth' => Auth::class,
        ];

        public static function resolve($key)
        {
            if (! $key) return;
            $middleware = Middleware::MAP[$key] ?? false;

            if (!$middleware) {
                throw new \Exception("Middleware not found for {$key}");
            }

            (new $middleware)->handle();
        }
    }