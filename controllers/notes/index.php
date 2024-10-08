<?php

    use core\App;
    use core\Database;

    $db = App::resolve(Database::class);



    $query = "select * FROM notes WHERE user_id = :user_id";

    $notes = $db->query($query, ['user_id' => $_SESSION['user']['user_id']])->findAll();

    view("notes/index.view.php",
         ['heading' => 'My Notes',
             'notes' => $notes
         ]);
