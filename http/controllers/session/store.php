<?php

    use core\Authenticator;
    use core\Session;
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

    Session::flash('errors', $form->getErrors());
    Session::flash('old', [
        'email' => $email,
    ]);

    redirect('/login');



