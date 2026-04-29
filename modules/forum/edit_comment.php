<?php
include "../../includes/header.php";
include "../../includes/navbar.php";
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) die("Login required");

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM forum_comments
 WHERE id='$id' AND user_id='$user_id'");

$comment = mysqli_fetch_assoc($result);

if (!$comment) die("Unauthorized");

if (isset($_POST['update'])) {

    $text = $_POST['comment'];

    mysqli_query($conn,
    "UPDATE forum_comments
     SET comment='$text'
     WHERE id='$id' AND user_id='$user_id'");

    header("Location: forum.php");
    exit();
}
?>

<h2>Edit Comment</h2>

<form method="POST">

<textarea name="comment" rows="4" cols="50"><?php echo $comment['comment']; ?></textarea>

<br><br>

<button type="submit" name="update">Update</button>

</form>
