<?php

    use core\App;
    use core\Database;


    $db = App::resolve(Database::class);



    $currentUserId = 1;
    $query = "DELETE FROM notes WHERE id = :id";


    $note = $db->query("SELECT * FROM notes WHERE id = :id", [':id' => $_POST['id']])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query($query, [':id' => $_POST['id']]);

    header("Location: /notes");
    exit();
