<?php

    use core\Session;

    $heading = 'Register';

    view('registration/create.view.php', [
        'errors' => Session::get('errors'),
    ]);
