<?php 
include "../../includes/header.php";
include "../../includes/navbar.php";
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) {
    die("Login required");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['post'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO forum_posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";

    mysqli_query($conn, $query);

    header("Location: forum.php");
    exit();
}

$result = mysqli_query($conn, 
"SELECT forum_posts.*, users.name 
FROM forum_posts
JOIN users ON forum_posts.user_id = users.id
ORDER BY forum_posts.id DESC ");
?>

<h2>Forum</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Post title" required><br><br>
    <textarea name="content" rows="5" cols="50"
    placeholder="Write something..." requried></textarea><br><br>

    <button type="submit" name="post">Post</button>
</form>

<hr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<div class="card">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo nl2br($row['content']); ?></p>
    <small>
        Posted by <?php echo $row['name']; ?>
        on <?php echo $row['created_at']; ?>
    </small>
</div>

<br>

<?php } ?>

<?php include "../../includes/footer.php"; ?>