<?php
include "../../config/database.php";

session_start();

if (!isset($_SESSION['user_id'])) die("Login required");

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM forum_posts
 WHERE id='$id' AND user_id='$user_id'"
);

header("Location: forum.php");
exit();
