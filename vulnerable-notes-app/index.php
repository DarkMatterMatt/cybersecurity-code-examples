<?php include('../include/header.php'); ?>
<!--------------------------------------->

<?php
function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if (!$length) {
        return true;
    }
    return substr($haystack, -$length) === $needle;
}

$urlPrefix = '.';
if (endsWith($_SERVER['REQUEST_URI'], basename(__DIR__))) {
    $urlPrefix = basename(__DIR__);
}
?>

<div class="w3-card w3-container">
    <h1>Welcome to the Vulnerable Notes App</h1>
    <p><a href="<?php print $urlPrefix; ?>/signin.php">Sign in here</a>, or <a href="<?php print $urlPrefix; ?>/register.php">Register here</a></p>
</div>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
