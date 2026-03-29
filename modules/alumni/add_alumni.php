<?php
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";
?>


<?php
if (isset($_POST['submit'])) {

    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];
    $batch  = $_POST['batch'];
    $job    = $_POST['job'];

    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO alumni (user_id, name, email, course, batch, job)
              VALUES ('$user_id', '$name', '$email', '$course', '$batch', '$job')";

    if (mysqli_query($conn, $query)) {
        header("Location: alumni_list.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<h2>Add Alumni</h2>

<form method="POST">

    Name:<br>
    <input type="text" name="name" required><br><br>

    Email:<br>
    <input type="email" name="email"><br><br>

    Course:<br>
    <input type="text" name="course"><br><br>

    Batch:
    <input type="text" name="batch"><br><br>

    Job:
    <input type="text" name="job"><br><br>

    <button type="submit" name="submit">Add Alumni</button>

</form>