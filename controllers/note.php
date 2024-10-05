<?php
    $config = require "config.php";
    $heading = "Note";
    $db = new Database($config['database']);

    $currentUserId = 1;
    $query = "select * FROM notes WHERE id = :id";
    $note = $db->query($query, [':id' => $_GET['id']])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

require "views/note.view.php";