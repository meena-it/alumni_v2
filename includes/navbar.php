<?php
include_once __DIR__ . "/../config/database.php";
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="navbar">

    <a class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"
        href="/alumni_v2/index.php">Home</a>

    <a class="<?php echo ($current_page == 'alumni_list.php') ? 'active' : ''; ?>"
        href="/alumni_v2/modules/alumni/alumni_list.php">Alumni</a>
    <a href="#">Forum</a>
    <a href="#">Jobs</a>
    <a href="#">Events</a>
    <a href="#">Gallery</a>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
        <a class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>"
            href="/alumni_v2/modules/admin/dashboard.php">Dashboard</a>
    <?php } ?>

    <?php if (isset($_SESSION['user_id'])) { ?>

        <?php
        $user_id = $_SESSION['user_id'];
        $query = "SELECT profile_image, name FROM alumni WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        ?>

        <a class="<?php echo ($current_page == 'my_profile.php') ? 'active' : ''; ?>"
            href="/alumni_v2/modules/alumni/my_profile.php">
            <img src="/alumni_v2/assets/uploads/<?php echo $user['profile_image'] ?: 'default.png'; ?>" width="30" style="border-radius:50%; vertical-align:middle;">
            <?php echo $user['name']; ?>
        </a>

        <a href="/alumni_v2/modules/auth/logout.php">Logout</a>

    <?php } else { ?>
        <a href="/alumni_v2/modules/auth/login.php">Login</a>
        <a href="/alumni_v2/modules/auth/signup.php">Signup</a>
    <?php } ?>

</div>