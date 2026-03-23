<div class="navbar">

    <a href="/alumni_v2/index.php">Home</a>
    <a href="/alumni_v2/modules/alumni/alumni_list.php">Alumni</a>
    <a href="#">Forum</a>
    <a href="#">Jobs</a>
    <a href="#">Events</a>
    <a href="#">Gallery</a>
    <a href="#">Login</a>

    <?php if (isset($_SESSION['user_name'])) { ?>

        Welcome, <?php echo $_SESSION['user_name']; ?>

        <a href="/alumni_v2/modules/auth/logout.php">Logout</a>

    <?php } else { ?>

        <a href="/alumni_v2/modules/auth/login.php">Login</a>

    <?php } ?>

</div>