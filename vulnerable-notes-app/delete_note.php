<?php
include('./db.php');

if (!isset($_SESSION['user'])) {
    print 'Must log in first.';
    die;
}

if (!isset($_GET['note_id'])) {
    print 'Missing query parameter `note_id`.';
    die;
}

$user = $_SESSION['user'];
$noteId = $_GET['note_id'];

// SQL injection in id
dbExec("
    DELETE FROM notes
    WHERE user = $user AND (id = \"$noteId\")
");
