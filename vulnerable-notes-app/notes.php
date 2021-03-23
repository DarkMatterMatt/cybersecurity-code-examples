<?php
include('./db.php');

if (!isset($_GET['user'])) {
    header('Location: index.php');
    die;
}

$user = $_GET['user'];

if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
}
else if ($_SESSION['user'] != intval($user)) {
    // broken authorization check
    header('Location: notes.php?user=' . $_SESSION['user']);
}

//--------------------------------------->
include('../include/header.php');
//--------------------------------------->

// vulnerable to SQL injection
$res = dbQuery("SELECT * FROM notes WHERE user = '$user'");
?>

<h1>Notes for User #<?php print $user ?></h1>

<!-- show all the user's notes -->
<?php while ($res && $note = $res->fetchArray()): ?>
    <div class="w3-card w3-container">
        <h3>Note #<?php print $note['id'] ?></h3>
        <p><?php print $note['content'] ?></p>
        <p><a href="#" onClick="deleteNote(<?php print $note['id'] ?>)">Delete</a></p>
    </div>
<?php endwhile; ?>

<form class="w3-card w3-container" onsubmit="addNote(); return false">
    <h3>Add a note</h3>
    <textarea id="content" style="width: 400px; height: 150px"></textarea>
    <br>
    <p><input type="submit" value="Submit"></p>
</form>

<p><a href="signout.php">Sign out</a></p>

<script>
    function escapeHtml(str) {
        const $span = document.createElement("span"); 
        $span.innerText = str;
        return $span.innerHTML;
    }

    async function addNote() {
        // sanitise HTML before sending to server to stop XSS but it isn't foolproof, are you able to find XSS in a note's content anyway? :)
        const content = document.getElementById("content").value;

        await fetch("add_note.php", {
            method: "POST",
            body: escapeHtml(content),
        });
        window.location.reload();
    }

    async function deleteNote(noteId) {
        await fetch("delete_note.php?note_id=" + noteId);
        window.location.reload();
    }
</script>

<!--------------------------------------->
<?php include('../include/footer.php'); ?>
