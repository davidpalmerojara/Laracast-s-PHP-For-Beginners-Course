<?php

    use core\App;
    use core\Database;
    use core\Validator;

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format

    if (!Validator::email($email)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (!Validator::string($password, 7, 255)) {
        $errors['password'] = "Password must be at least 7 characters long.";
    }

    if (! empty($errors)) {
        view('registration/create.view.php', ['errors' => $errors]);
    }
    // Check if user already exists in the database
        $db = APP::resolve(DATABASE::class);
        $user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])
            ->find();

        // If yes reroute to login page with error message
        // Else hash the password and store the user in the database
        if ($user) {
            header('Location: /');
            exit();
        } else {
            $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);
        }

        $user_id = $db->query("SELECT id FROM users WHERE email = :email", ['email' => $email])->find()['id'];

        // User is logged in
        login(['email' => $email, 'user_id' => $user_id]);

        header('Location: /');
        exit();