<?php

session_start();

// every session has a separate database instance
if (isset($_SESSION['db'])) {
    $db = new SQLite3('multiuser-todo-app.' . $_SESSION['db'] . '.db');
}
else {
    $_SESSION['db'] = md5(session_id());
    
    $db = new SQLite3("multiuser-todo-app.$_SESSION[db].db");
    dbReset();
}

function dbQuery($sql) {
    global $db;
    // print what is happening in a HTML comment (to help learning SQL injection), also vulnerable to XSS
    print '<!-- querying: ' . $sql . ' -->' . PHP_EOL;
    return $db->query($sql);
}

function dbExec($sql) {
    global $db;
    // print what is happening in a HTML comment (to help learning SQL injection), also vulnerable to XSS
    print '<!-- executing: ' . $sql . ' -->' . PHP_EOL;
    return $db->exec($sql);
}

function dbReset() {
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
}
