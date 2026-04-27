<?php
include "../../includes/header.php";
include "../../includes/navbar.php";
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) die("Login required");

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM forum_posts
 WHERE id='$id' AND user_id='$user_id'"
);

$post = mysqli_fetch_assoc($result);

if (!$post) die("Unauthorized");

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query(
        $conn,
        "UPDATE forum_posts
     SET title='$title', content='$content'
     WHERE id='$id' AND user_id='$user_id'"
    );

    header("Location: forum.php");
    exit();
}
?>

<h2>Edit Post</h2>

<form method="POST">
    <input type="text" name="title"
        value="<?php echo $post['title']; ?>"><br><br>

    <textarea name="content" rows="5" cols="50"><?php echo $post['content']; ?></textarea><br><br>

    <button type="submit" name="update">Update</button>
</form>