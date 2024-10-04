<?php


    $heading = "Your notes";
    $config = require "config.php";
    $db = new Database($config['database']);

    $query = "select * FROM notes WHERE user_id = 1";
    $notes = $db->query($query)->fetchAll();

require "views/notes.view.php";