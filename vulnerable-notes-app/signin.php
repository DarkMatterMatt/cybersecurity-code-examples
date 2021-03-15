<?php
include('./db.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['user_id']) || !isset($_POST['password'])) {
        print 'Missing `user_id` or `password` parameters';
        die;
    }
    $user = $_POST['user_id'];
    $password = $_POST['password'];

    // use prepared statement to avoid SQL injection
    $stmt = $db->prepare('
        SELECT id FROM users
        WHERE id = :id AND password = :password
    ');
    $stmt->bindValue(':id', $user, SQLITE3_INTEGER);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    print '<!-- Executing: ' . $stmt->getSQL(false) . ' -->' . PHP_EOL;
    $res = $stmt->execute()->fetchArray();

    if ($res) {
        // save which user we are
        $_SESSION['user'] = $user;

        // have signed up, redirect to notes page.
        header('Location: notes.php?user=' . $user);
        die;
    }

    $errorMessage = 'Invalid user id or password.';
}
?>

<!--------------------------------------->
<?php include('../include/header.php'); ?>
<!--------------------------------------->

<form method="post" class="w3-card w3-container">
    <h1>Sign in</h1>
    <?php if ($errorMessage): ?>
        <p class="w3-text-red">Error: <?php print $errorMessage; ?></p>
    <?php endif; ?>
    <p>User ID: <input name="user_id" type="number" required></p>
    <p>Password: <input name="password" type="password" required></p>
    <input type="submit" value="Submit" style="margin-bottom: 10px">
    <p><a href="register.php">Register here</a></p>
</form>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
