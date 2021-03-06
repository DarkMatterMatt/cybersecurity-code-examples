<?php
session_start();

if (!isset($_SESSION['user'])) {
    print "Must log in first.";
    die;
}

if (!isset($_GET['note_id'])) {
    print "Missing query parameter `note_id`.";
    die;
}

include('./db.php');

$user = $_SESSION['user'];
$noteId = $_GET['note_id'];

// SQL injection in id, id in parentheses so that only current user's notes can be deleted.
dbExec("
    DELETE FROM notes
    WHERE user = $user AND (id = $noteId)
");
