<?php

    require 'Validator.php';

    $config = require "config.php";
    $db = new Database($config['database']);

    $heading = "Create a new note";
    $currentUserId = 1;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];

        if (! Validator::string($_POST['body'], 1, 1000)) {
            $errors['body'] = "The note should be between 1 and 1000 characters long.";
        }


        if (empty($errors)) {
            $db->query('INSERT INTO notes (user_id, body) VALUES (:user_id, :body)',
                [':user_id' => $currentUserId, ':body' => $_POST['body']]);
        }
    }

    require "views/note-create.view.php";