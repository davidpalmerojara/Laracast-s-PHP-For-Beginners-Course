<?php

    use core\Authenticator;
    use http\forms\LoginForm;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $form = new LoginForm();

    if (!$form->validate($email, $password)) {
        view('session/create.view.php', ['errors' => $form->getErrors()]);
        exit();
    }

    $auth = new Authenticator();

    if (!$auth->attempt($email, $password)) {
        view('session/create.view.php', ['errors' => $auth->getErrors()]);
        exit();
    }

    $auth->login(['email' => $auth->getUser()['email'], 'user_id' => $auth->getUser()['id']]);
    redirect('/');