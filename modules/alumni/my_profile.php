<?php
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM alumni WHERE user_id=$user_id";
$result = mysqli_query($conn, $query);
$alumni = mysqli_fetch_assoc($result);
?>

<!-- <h2>My Profile</h2>
<p>Name: <?php echo $alumni['name']; ?></p>
<p>Email: <?php echo $alumni['email']; ?></p>
<p>Course: <?php echo $alumni['course']; ?></p>
<p>Batch: <?php echo $alumni['batch']; ?></p>
<p>Job: <?php echo $alumni['job']; ?></p>

<a href="edit_alumni.php">Edit Profile</a> -->

<div class="profile-container">

    <h2>My Profile</h2>
    <div class="profile-card">

        <?php if (!empty($alumni['profile_image'])) { ?>
            <img src="/alumni_v2/assets/uploads/<?php echo $alumni['profile_image']; ?>" width="120" style="border-radius: 50%" ;>
        <?php } else { ?>
            <img src="/alumni_v2/assets/uploads/default.png" width="120">
        <?php } ?>


        <p><strong>Name:</strong> <?php echo $alumni['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $alumni['email']; ?></p>
        <p><strong>Course:</strong> <?php echo $alumni['course']; ?></p>
        <p><strong>Batch:</strong> <?php echo $alumni['batch']; ?></p>
        <p><strong>Job:</strong> <?php echo $alumni['job']; ?></p>

        <a href="edit_alumni.php" class="btn-edit">Edit Profile</a>

    </div>
</div>