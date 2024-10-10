<?php

    use core\Authenticator;
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
        $form->setErrors('email', 'Account already exists.');
    }

    view('registration/create.view.php', ['errors' => $form->getErrors()]);
    exit();