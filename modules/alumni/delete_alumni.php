<?php 
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";

$id = $_GET['id'];

$query = "DELETE FROM alumni WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: alumni_list.php?deleted=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
