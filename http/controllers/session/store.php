<?php

    use core\Authenticator;
    use http\forms\LoginForm;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $form = new LoginForm();

    if ($form->validate($email, $password)) {
        if ((new Authenticator)->attempt($email, $password)) {
            redirect('/');
            exit();
        }
        $form->setErrors('email', 'No matching account found for that email and password.');
    }

    view('session/create.view.php', ['errors' => $form->getErrors()]);
    exit();



