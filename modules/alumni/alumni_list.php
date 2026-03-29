<?php include "../../includes/header.php"; ?>
<?php include "../../includes/auth_check.php"; ?>
<?php include "../../config/database.php"; ?>
<h2> Hi Alumni! </h2>

<?php $query = "SELECT * FROM alumni ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<a href="add_alumni.php">Add Alumni</a><br><br>

<?php if(isset($_GET['success'])) {
    ?>
    <p style="color:green;">Alumni added successfully</p>
<?php } ?>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Batch</th>
        <th>Job</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['batch']; ?></td>
            <td><?php echo $row['job']; ?></td>
        </tr>
    <?php } ?>

</table>
<?php include "../../includes/footer.php"; ?>