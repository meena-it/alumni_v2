<?php 
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";
?>

<?php
$id = $_GET['id'];

$query = "SELECT * FROM alumni WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Record not found";
    exit();
}
?>

<!-- <h2>Alumni Profile</h2> -->
 <?php if ($row['user_id'] == $_SESSION['user_id']) { ?>
    <p><em>This is your profile</em></p>
<?php } ?>

<p><strong>Name:</strong> <?php echo $row['name']; ?></p>
<p><strong>Email:</strong> <?php echo $row['email']; ?></p>
<p><strong>Course:</strong> <?php echo $row['course']; ?></p>
<p><strong>Batch:</strong> <?php echo $row['batch']; ?></p>
<p><strong>Job:</strong> <?php echo $row['job']; ?></p>

<br>

<a href="alumni_list.php">Back to List</a>

