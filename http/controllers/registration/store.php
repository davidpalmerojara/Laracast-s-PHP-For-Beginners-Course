<?php

    use core\App;
    use core\Authenticator;
    use core\Database;
    use http\forms\RegistrationForm;

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format

    $form = new RegistrationForm();

    if (! $form->validate($email, $password)) {
        view('registration/create.view.php', ['errors' => $form->getErrors()]);
        exit();
    }

    // Check if user already exists in the database

        // If yes reroute to login page with error message
        // Else hash the password and store the user in the database

        $auth = new Authenticator();
        if (! $auth->attemptRegister($email)) {
            view('registration/create.view.php', ['errors' => $auth->getErrors()]);
            exit();
        }

        $auth->register($email, $password);

        redirect('/');