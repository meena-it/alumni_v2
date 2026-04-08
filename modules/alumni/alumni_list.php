<?php include "../../includes/header.php"; ?>
<?php include "../../includes/auth_check.php"; ?>
<?php include "../../config/database.php"; ?>
<h2> Hi Alumni! </h2>

<?php
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
?>

<?php
if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search']; 

    $query = "SELECT * FROM alumni WHERE name LIKE '%$search%' OR course LIKE '%$search%' ORDER BY id DESC LIMIT $limit OFFSET $offset";

    $count_query = "SELECT COUNT(*) as total FROM alumni WHERE name LIKE '%$search%' OR course LIKE '%$search%'";
} else {
    $query = "SELECT * FROM alumni ORDER BY id DESC LIMIT $limit OFFSET $offset";

    $count_query = "SELECT COUNT(*) as total FROM alumni";
}

$result = mysqli_query($conn, $query);

$count_result = mysqli_query($conn, $count_query);
$total_rows = mysqli_fetch_assoc($count_result)['total'];

$total_pages = ceil($total_rows / $limit);
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

<form method="GET">
    <input type="text" name="search" placeholder="search by name or course" value="<?php echo $_GET['search'] ?? ''; ?>">
    <button type="submit">Search</button>
</form>
<br>

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
<div>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

        <a href="?page=<?php echo $i; ?>&search=<?php echo $_GET['search'] ?? ''; ?>">
            <?php echo $i; ?>
        </a>

    <?php } ?>
</div>

<?php include "../../includes/footer.php"; ?>