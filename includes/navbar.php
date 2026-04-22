<?php
include_once __DIR__ . "/../config/database.php";
?>
<div class="navbar">

    <a href="/alumni_v2/index.php">Home</a>
    <a href="/alumni_v2/modules/alumni/alumni_list.php">Alumni</a>
    <a href="#">Forum</a>
    <a href="#">Jobs</a>
    <a href="#">Events</a>
    <a href="#">Gallery</a>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
        <a href="/alumni_v2/modules/admin/dashboard.php">Dashboard</a>
    <?php } ?>

    <?php if (isset($_SESSION['user_id'])) { ?>

        <?php
        $user_id = $_SESSION['user_id'];
        $query = "SELECT profile_image, name FROM alumni WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        ?>

        <a href="/alumni_v2/modules/alumni/my_profile.php">
            <img src="/alumni_v2/assets/uploads/<?php echo $user['profile_image'] ?: 'default.png'; ?>" width="30" style="border-radius:50%; vertical-align:middle;">
            <?php echo $user['name']; ?>
        </a>

        <a href="/alumni_v2/modules/auth/logout.php">Logout</a>



    <?php } else { ?>
        <a href="/alumni_v2/modules/auth/login.php">Login</a>
        <a href="/alumni_v2/modules/auth/signup.php">Signup</a>
    <?php } ?>

</div>