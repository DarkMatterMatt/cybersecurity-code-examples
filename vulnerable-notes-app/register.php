<?php
include('./db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        // use prepared statement to avoid SQL injection
        $stmt = $db->prepare('
            INSERT INTO users (
                password
            ) VALUES (
                :password
            )
        ');
        $stmt->bindValue(':password', $_POST['password'], SQLITE3_TEXT);

        // print 'Executing: ' . $stmt->getSQL(false) . PHP_EOL;
        print 'Executing: INSERT INTO users (password) VALUES (:password)' . PHP_EOL;
        $stmt->execute();

        $user = $db->lastInsertRowID();

        // save which user we are
        $_SESSION['user'] = $user;

        // have signed up, redirect to notes page.
        header('Location: notes.php?user=' . $user);
    }
    else {
        print 'Missing `password` parameter';
    }
    die;
}
?>

<!--------------------------------------->
<?php include('../include/header.php'); ?>
<!--------------------------------------->

<form method="post" class="w3-card w3-container">
    <h1>Register</h1>
    <p>User ID: will be automatically generated by the system.</p>
    <p>Password: <input name="password" type="password"></p>
    <input type="submit" value="Submit" style="margin-bottom: 10px">
    <p><a href="signin.php">Sign in here</a></p>
</form>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
