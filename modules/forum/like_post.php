<?php
include "../../config/database.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Login required"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

//Check exixting like
$check = mysqli_query($conn,
"SELECT * FROM forum_likes
WHERE post_id='$post_id' AND user_id='$user_id'");

if (mysqli_num_rows($check) > 0) {
    // Unlike
    mysqli_query($conn,
    "DELETE FROM forum_likes
    WHERE post_id='$post_id' AND user_id='$user_id'");
    $liked = false;
} else {
    // Like
    mysqli_query($conn,
    "INSERT INTO forum_likes (post_id, user_id)
    VALUES ('$post_id', '$user_id')");
    $liked = true;
}

// Get updated count
$count_result = mysqli_query($conn,
"SELECT COUNT(*) AS total FROM forum_likes WHERE post_id='$post_id'");

$count = mysqli_fetch_assoc($count_result)['total'];

echo json_encode([
    "liked" => $liked,
    "count" => $count
]);
?>