<?php include "../../includes/header.php"; ?>
<?php include "../../includes/footer.php"; ?>

<h2>Login</h2>

<form method="POST" action="auth_controller.php">

    Email:
    <input type="email" name="email" required>
    <br><br>

    Password:
    <input type="password" name="password" required>
    <br><br>

    <button type="submit" name="login">Login</button>

</form>

<?php include "../../includes/footer.php"; ?>