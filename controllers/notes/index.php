<?php

    use core\App;
    use core\Database;

    $db = App::resolve(Database::class);



    $query = "select * FROM notes WHERE user_id = 1";

    $notes = $db->query($query)->findAll();

    view("notes/index.view.php",
         ['heading' => 'My Notes',
             'notes' => $notes
         ]);
