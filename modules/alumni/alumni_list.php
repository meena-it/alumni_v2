<?php include "../../includes/header.php"; ?>
<?php include "../../includes/auth_check.php"; ?>
<?php include "../../config/database.php"; ?>
<h2> Hi Alumni! </h2>

<?php $query = "SELECT * FROM alumni ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<a href="add_alumni.php">Add Alumni</a><br><br>

<?php if (isset($_GET['success'])) {
?>
    <p class="success">Alumni added successfully</p>
<?php } ?>

<?php if (isset($_GET['updated'])) { ?>
    <p class="success">Alumni updated successfully</p>
<?php } ?>

<?php if (isset($_GET['deleted'])) { ?>
    <p style="color:red;">Alumni deleted successfully</p>
<?php } ?>


<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Batch</th>
        <th>Job</th>
        <th>Action</th>
        <th>View</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['batch']; ?></td>
            <td><?php echo $row['job']; ?></td>
            <td>
                <a href="edit_alumni.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_alumni.php?id=<?php echo $row['id']; ?>"
                    onclick="return confirm('Are you sure you want to to delete this record?');">Delete</a>      
            </td>
            <td><a href="view_alumni.php?id=<?php echo $row['id']; ?>">View</a></td>
        </tr>
    <?php } ?>

</table>
<?php include "../../includes/footer.php"; ?>