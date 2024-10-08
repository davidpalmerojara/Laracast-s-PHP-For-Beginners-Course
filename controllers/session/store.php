<?php

    use core\App;
    use core\Database;
    use core\Validator;

    $db = APP::resolve(DATABASE::class);
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!Validator::email($email)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (!Validator::string($password)) {
        $errors['password'] = "Password does not match.";
    }

    if (!empty($errors)) {
        view('session/create.view.php', ['errors' => $errors]);
    }

    $user = $db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->find();

    // check email
    if (!$user) {
        view('session/create.view.php', ['errors' => ['email' => 'User not found']]);
    }

    // check password

    if (!password_verify($password, $user['password'])) {
        view('session/create.view.php', ['errors' => ['password' => 'Password does not match']]);
    }

    //  User is logged in

    login(['email' => $user['email'], 'user_id' => $user['id']]);
    header('Location: /');
    exit();