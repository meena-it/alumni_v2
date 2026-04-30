<?php
include "../../includes/header.php";
include "../../includes/navbar.php";
include "../../config/database.php";

if (!isset($_SESSION['user_id'])) {
    die("Login required");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_comment'])) {

    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    mysqli_query(
        $conn,
        "INSERT INTO forum_comments (post_id, user_id, comment) VALUES ('$post_id', '$user_id', '$comment')"
    );

    header("Location: forum.php");
    exit();
}

if (isset($_GET['like'])) {

    $post_id = $_GET['like'];
    $user_id = $_SESSION['user_id'];

    // Check if already liked
    $check = mysqli_query(
        $conn,
        "SELECT * FROM forum_likes
         WHERE post_id='$post_id' AND user_id='$user_id'"
    );

    if (mysqli_num_rows($check) > 0) {
        // Unlike
        mysqli_query(
            $conn,
            "DELETE FROM forum_likes
         WHERE post_id='$post_id' AND user_id='$user_id'"
        );
    } else {
        // Like
        mysqli_query(
            $conn,
            "INSERT INTO forum_likes (post_id, user_id)
         VALUES ('$post_id', '$user_id')"
        );
    }

    header("Location: forum.php");
    exit();
}


if (isset($_POST['post'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "INSERT INTO forum_posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";

    mysqli_query($conn, $query);

    header("Location: forum.php");
    exit();
}

$result = mysqli_query(
    $conn,
    "SELECT forum_posts.*, users.name 
FROM forum_posts
JOIN users ON forum_posts.user_id = users.id
ORDER BY forum_posts.id DESC "
);
?>

<h2>Forum</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Post title" required><br><br>
    <textarea name="content" rows="5" cols="50"
        placeholder="Write something..." requried></textarea><br><br>

    <button type="submit" name="post">Post</button>
</form>

<hr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="card">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo nl2br($row['content']); ?></p>
        <small>
            Posted by <?php echo $row['name']; ?>
            on <?php echo $row['created_at']; ?>
        </small>


        <?php
        $post_id = $row['id'];

        // Count likes
        $count_result = mysqli_query(
            $conn,
            "SELECT COUNT(*) AS total FROM forum_likes WHERE post_id='$post_id'"
        );
        $like_count = mysqli_fetch_assoc($count_result)['total'];

        // Check if current user liked
        $user_id = $_SESSION['user_id'];
        $liked_result = mysqli_query(
            $conn,
            "SELECT * FROM forum_likes WHERE post_id='$post_id' AND user_id='$user_id'"
        );
        $is_liked = mysqli_num_rows($liked_result) > 0;
        ?>

        <p>
            👍 <?php echo $like_count; ?> Likes

            <a href="forum.php?like=<?php echo $post_id; ?>">
                <?php echo $is_liked ? "Unlike" : "Like"; ?>
            </a>
        </p>

        <?php if ($row['user_id'] == $_SESSION['user_id']) { ?>

            <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>

            |

            <a href="delete_post.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Delete this post?')">
                Delete
            </a>
        <?php } ?>

        <form method="POST">
            <input type="hidden" name="post_id"
                value="<?php echo $row['id']; ?>">

            <input type="text"
                name="comment"
                placeholder="Write a comment..."
                required>

            <button type="submit" name="add_comment">
                Comment
            </button>
        </form>

        <?php
        $comments = mysqli_query(
            $conn,
            "SELECT forum_comments.*, users.name
            FROM forum_comments
            JOIN users ON forum_comments.user_id = users.id
            WHERE post_id='{$row['id']}'
            ORDER BY id ASC"
        );
        ?>

        <?php while ($c = mysqli_fetch_assoc($comments)) { ?>

            <div style="margin-left:20px; padding:8px; background:#f9f9f9; margin-top:5px;">

                <strong><?php echo $c['name']; ?>:</strong>

                <?php echo $c['comment']; ?>

                <br>

                <small><?php echo $c['created_at']; ?></small>

            </div>
            <?php if ($c['user_id'] == $_SESSION['user_id']) { ?>

                <a href="edit_comment.php?id=<?php echo $c['id']; ?>">Edit</a>

                |

                <a href="delete_comment.php?id=<?php echo $c['id']; ?>"
                    onclick="return confirm('Delete comment?')">
                    Delete
                </a>

            <?php } ?>

        <?php } ?>
    </div>

    <br>

<?php } ?>

<?php include "../../includes/footer.php"; ?>