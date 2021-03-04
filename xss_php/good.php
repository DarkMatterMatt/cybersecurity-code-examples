<?php include('../include/header.php'); ?>
<!--------------------------------------->

<?php
    $name = 'stranger';

    if (isset($_GET['name'])) {
        $name = $_GET['name'];

        // does this fix the vulnerability?
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }
    
    echo 'Hello ' . $name;
?>
<form>
    <!-- not vulnerable to Cross Site Scripting (XSS) -->
    Enter your name: <input name="name" value="<?php echo $name; ?>">
    <input type="submit" value="Submit">
</form>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
