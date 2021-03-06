<?php

$db = new SQLite3('multiuser-todo-app.db');

function dbQuery($sql) {
    global $db;
    // print what is happening in a HTML comment (to help learning SQL injection)
    print '<!-- querying: ' . $sql . ' -->' . PHP_EOL;
    return $db->query($sql);
}

function dbExec($sql) {
    global $db;
    // print what is happening in a HTML comment (to help learning SQL injection)
    print '<!-- executing: ' . $sql . ' -->' . PHP_EOL;
    return $db->exec($sql);
}
