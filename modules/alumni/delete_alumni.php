<?php 
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";

$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$query = "DELETE FROM alumni WHERE id='$id' AND user_id='$user_id'";

if (mysqli_affected_rows($conn) == 0) {
    echo "Unauthorized or record not found";
    exit();
}

if (mysqli_query($conn, $query)) {
    header("Location: alumni_list.php?deleted=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
