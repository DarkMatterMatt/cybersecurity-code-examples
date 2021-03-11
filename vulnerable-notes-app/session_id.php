<?php include('../include/header.php'); ?>
<!--------------------------------------->

<?php
    if (isset($_GET['session_id'])) {
        if (preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $_GET['session_id'])) {
            session_id($_GET['session_id']);
        }
        else {
            echo 'Invalid size or characters detected, only a-z, A-Z, 0-9, - (hyphen)<br>and , (comma) are allowed. Length must be 1 <= len <= 128.';
        }
    }
    session_start();
?>

<p>
    Your current session_id is <span class="w3-codespan"><?php echo htmlspecialchars(session_id(), ENT_QUOTES, 'UTF-8'); ?></span>
</p>
<form>
    Enter your new session_id: <input name="session_id">
    <input type="submit" value="Submit">
</form>


<!--------------------------------------->
<?php include('../include/footer.php'); ?>
