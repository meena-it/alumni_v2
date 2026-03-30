<?php include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";
?>

<?php 
$id = $_GET['id'];

$query = "SELECT * FROM alumni WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<?php 
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $job = $_POST['job'];

    $query = "UPDATE alumni SET 
                name='$name',
                email='$email',
                course='$course',
                batch='$batch',
                job='$job'
            WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: alumni_list.php?updated=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<h2>Edit Alumni</h2>

<form method="POST">

    Name:<br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    Email:<br>
    <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>

    Course:<br>
    <input type="text" name="course" value="<?php echo $row['course']; ?>"><br><br>

    Batch:<br>
    <input type="text" name="batch" value="<?php echo $row['batch']; ?>"><br><br>

    Job:<br>
    <input type="text" name="job" value="<?php echo $row['job']; ?>"><br><br>

    <button type="submit" name="update">Update</button>

</form>