<?php

    use core\App;
    use core\Database;
    use core\Validator;


    $db = App::resolve(Database::class);


    // Find the corresponding note from the database based on the provided ID
    $query = "select * FROM notes WHERE id = :id";

    $note = $db->query($query, [':id' => $_POST['id']])->findOrFail();

    // Authorize the user before allowing them to edit the note
    authorize($note['user_id'] === $_SESSION['user']['user_id']);

    // Validate the form
    $errors = [];

    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = "The note should be between 1 and 1000 characters long.";
    }

    // If there are validation errors, re-render the edit view with the errors
    if (count($errors)) {
        view("notes/edit.view.php", ['heading' => 'Edit Note',
            'errors' => $errors,
            'note' => $note
        ]);
    }

    // If no validations errors, update the note in the database
    $query = 'UPDATE notes SET body = :body WHERE id = :id';

    $db->query($query,
               [':body' => $_POST['body'], ':id' => $_POST['id']]);

    header("Location: /notes");



