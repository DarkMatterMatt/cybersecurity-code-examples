<?php
include('./db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    print 'Invalid request method. This file only accepts POST request.';
    die;
}

if (!isset($_SESSION['user'])) {
    print 'Must log in first.';
    die;
}

$user = $_SESSION['user'];
$content = file_get_contents('php://input');

// use prepared statement to avoid SQL injection
$stmt = $db->prepare('
    INSERT INTO notes (
        user,
        content
    ) VALUES (
        :user,
        :content
    )
');
$stmt->bindValue(':user', $user, SQLITE3_INTEGER);
$stmt->bindValue(':content', $content, SQLITE3_TEXT);

// print 'Executing: ' . $stmt->getSQL(true) . PHP_EOL;
print 'Executing: INSERT INTO notes (user, content) VALUES (:user, :content))' . PHP_EOL;
$stmt->execute();
