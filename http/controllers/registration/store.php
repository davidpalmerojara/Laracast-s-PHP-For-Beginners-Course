<?php

    use core\Authenticator;
    use core\Session;
    use http\forms\RegistrationForm;

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format

    $form = new RegistrationForm();

    if ($form->validate($email, $password)) {
        $auth = new Authenticator();
        if ($auth->attemptRegister($email)) {
            $auth->register($email, $password);
            redirect('/');
        }
        $form->setErrors('register', 'Account already exists.');
    }

    Session::flash('errors', $form->getErrors());
    Session::flash('old', [
        'email' => $email,
    ]);

    redirect('/register');