<?php

    use core\Session;

    $heading = 'Log in';
    view('session/create.view.php', [
        'errors' => Session::get('errors'),
    ]);
