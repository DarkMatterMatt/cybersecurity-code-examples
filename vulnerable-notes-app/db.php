<?php

// show errors to help with SQL injection
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// every session has a separate database instance
if (isset($_SESSION['db'])) {
    $db = new SQLite3('multiuser-todo-app.' . $_SESSION['db'] . '.db');
}
else {
    $_SESSION['db'] = md5(session_id());
    $_SESSION['db_user0_password'] = base64_encode(random_bytes(9));
    
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
        INSERT INTO users (password)
        VALUES ("' . $_SESSION['db_user0_password'] . '")
    ');
    dbExec('
        INSERT INTO users (password)
        VALUES ("user2")
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
        INSERT INTO notes (user, content)
        VALUES (1, "The first note")
    ');
    dbExec('
        INSERT INTO notes (user, content)
        VALUES (1, "I wonder if it\'s safe to store my super secret notes here?")
    ');
    dbExec('
        INSERT INTO notes (user, content)
        VALUES (2, "My first note")
    ');
    dbExec('
        INSERT INTO notes (user, content)
        VALUES (2, "Just testing, my password is \'user2\'")
    ');
}
