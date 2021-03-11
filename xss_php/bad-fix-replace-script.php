<?php include('../include/header.php'); ?>
<!--------------------------------------->

<?php
    $name = "stranger";

    if (isset($_GET['name'])) {
        $name = $_GET['name'];

        // does this fix the vulnerability?
        $name = str_replace("script", "", $name);
    }
    
    // vulnerable to Cross Site Scripting (XSS)
    echo "Hello " . $name;
?>
<form>
    Enter your name: <input name="name">
    <input type="submit" value="Submit">
</form>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
