<?php

include('./db.php');

// users

dbExec('
    DROP TABLE IF EXISTS users
');

dbExec('
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        password TEXT
    )
');

dbExec('
    INSERT INTO users (
        id,
        password
    ) VALUES (
        0,
        "password123"
    )
');

// notes

dbExec('
    DROP TABLE IF EXISTS notes
');

dbExec('
    CREATE TABLE notes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user INTEGER,
        content TEXT
    )
');

dbExec('
    INSERT INTO notes (
        id,
        user,
        content
    ) VALUES (
        0,
        0,
        "The first note"
    )
');
