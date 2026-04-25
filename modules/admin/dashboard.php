<?php
include "../../includes/header.php";
include "../../includes/auth_check.php";
include "../../config/database.php";

// Admin only
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$users  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM users"))['total'];

$alumni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM alumni"))['total'];

$images = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) total FROM alumni WHERE profile_image IS NOT NULL AND profile_image != '' AND profile_image != 'default.png'"
))['total'];

$admins = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) total FROM users WHERE role='admin'"
))['total'];

$normal_users = $users - $admins;
$no_images = $alumni - $images;

?>

<h2>Admin Dashboard</h2>

<div class="dashboard-grid">

    <div class="card">Total Users <br><strong><?php echo $users; ?></strong></div>

    <div class="card">Total Alumni <br><strong><?php echo $alumni; ?></strong></div>

    <div class="card">Profiles With Images <br><strong><?php echo $images; ?></strong></div>

    <div class="card">Admin Users <br><strong><?php echo $admins; ?></strong></div>

</div>

<div class="chart-grid">

    <div class="card">
        <canvas id="roleChart"></canvas>
    </div>

    <div class="card">
        <canvas id="imageChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"> </script>

<script>
    const roleCtx = document.getElementById('roleChart');

    new Chart(roleCtx, {
        type: 'pie',
        data: {
            labels: ['Admins', 'Users'],
            datasets: [{
                data: [<?php echo $admins; ?>, <?php echo $normal_users; ?>]
            }]
        },

        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'User Roles'
                }
            }
        }
    });

    const imageCtx = document.getElementById('imageChart');

    new Chart(imageCtx, {
        type: 'doughnut',
        data: {
            labels: ['With Image', 'No Image'],
            datasets: [{
                data: [<?php echo $images; ?>, <?php echo $no_images; ?>]
            }]
        },

        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Profiles'
                }
            }
        }

    });
</script>
<?php include "../../includes/footer.php"; ?>