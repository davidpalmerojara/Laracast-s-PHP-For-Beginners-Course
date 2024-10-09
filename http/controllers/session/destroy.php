<?php

    // log the user out
    use core\Authenticator;

    $auth = new Authenticator();

    $auth->logout();
    redirect('/');