<?php

    use core\App;
    use core\Database;


    $db = App::resolve(Database::class);

    $query = "select * FROM notes WHERE id = :id";


    $note = $db->query($query, [':id' => $_GET['id']])->findOrFail();

    authorize($note['user_id'] === $_SESSION['user']['user_id']);

    view("notes/show.view.php", ['heading' => 'Note', 'note' => $note]);