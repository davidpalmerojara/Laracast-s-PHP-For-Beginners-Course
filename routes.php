<?php

    $router = new core\Router();

// GET routes
    $router->get('/', '/index.php');
    $router->get('/about', '/about.php');
    $router->get('/contact', '/contact.php');
    $router->get('/notes', '/notes/index.php')->only('auth');
    $router->get('/notes/create', '/notes/create.php')->only('auth');
    $router->get('/note', '/notes/show.php')->only('auth');
    $router->get('/note/edit', '/notes/edit.php')->only('auth');
    $router->get('/register', '/registration/create.php')->only('guest');
    $router->get('/login', '/session/create.php')->only('guest');

    // POST routes
    $router->post('/notes', '/notes/store.php');
    $router->post('/register', '/registration/store.php');
    $router->post('/session', '/session/store.php')->only('guest');

    // PUT/PATCH routes
    $router->patch('/note', '/notes/update.php')->only('auth');


    // DELETE routes
    $router->delete('/note', '/notes/destroy.php')->only('auth')  ;
    $router->delete('/session', '/session/destroy.php')->only('auth');




