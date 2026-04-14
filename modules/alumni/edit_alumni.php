<?php include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";
?>

<?php
$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM alumni WHERE id='$id' AND user_id='$user_id'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Unauthorized access";
    exit();
}

?>

<?php
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $job = $_POST['job'];

    // IMAGE UPLOAD
    if (!empty($_FILES['profile_image']['name'])) {

        $filename = $_FILES['profile_image']['name'];
        $tempname = $_FILES['profile_image']['tmp_name'];

        $folder = "../../assets/uploads/" . $filename;

        move_uploaded_file($tempname, $folder);

        $query = "UPDATE alumni SET 
                    name='$name',
                    email='$email',
                    course='$course',
                    batch='$batch',
                    job='$job',
                    profile_image='$filename'
                  WHERE id='$id' AND user_id='$user_id'";
    } else {
        $query = "UPDATE alumni SET 
                    name='$name',
                    email='$email',
                    course='$course',
                    batch='$batch',
                    job='$job'
                  WHERE id='$id' AND user_id='$user_id'";
    }

    mysqli_query($conn, $query);
    
    header("Location: alumni_list.php?updated=1");
    exit();
}

?>



<h2>Edit Alumni</h2>

<form method="POST" enctype="multipart/form-data">

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

    <input type="file" name="profile_image">

    <button type="submit" name="update">Update</button>

</form>