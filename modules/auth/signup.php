<?php include "../../includes/header.php"; ?>
<?php include "../../includes/navbar.php"; ?>

<h2>Signup</h2>

<form method="POST" action="auth_controller.php">

    Name:
    <input type="text" name="name" requried>
    <br><br>

    Email:
    <input type="email" name="email" required>
    <br><br>

    password:
    <input type="password" name="password" required>
    <br><bR>

    <button type="submit" name="signup">Signup</button>

</form>

<?php include "../../includes/footer.php"; ?>