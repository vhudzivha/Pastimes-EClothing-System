<?php
session_start();
include 'DBConn.php';

// Admin login
if(!isset($_SESSION['admin_logged'])){
    if(isset($_POST['admin_login'])){
        if($_POST['password'] == 'admin123'){
            $_SESSION['admin_logged'] = true;
        } else {
            echo "<p style='color:red;text-align:center;'>Wrong password</p>";
        }
    } else {
        ?>
        <h2 style="text-align:center;">Admin Login</h2>
        <form method="POST" style="text-align:center;">
            <input type="password" name="password" placeholder="Admin Password" required><br><br>
            <button name="admin_login">Login</button>
        </form>
        <?php
        exit();
    }
}

// Approve user
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    $conn->query("UPDATE tblUser SET status='approved' WHERE id=$id");
    header("Location: admin.php");
    exit();
}

// 🔴 IMPORTANT: DEFINE VARIABLES HERE
$pendingUsers = $conn->query("SELECT * FROM tblUser WHERE status='pending'")->fetchAll();
$allUsers = $conn->query("SELECT * FROM tblUser")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

<div class="card shadow p-4">

<h2 class="text-center mb-4">Admin Panel</h2>

<h4 class="text-warning">Pending Users</h4>

<?php if(count($pendingUsers) > 0): ?>
    <table class="table table-bordered">
        <tr>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <?php foreach($pendingUsers as $row): ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td>
                <a href="?approve=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">
                    Approve
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No pending users</p>
<?php endif; ?>

<hr>

<h4 class="text-primary">All Users</h4>

<table class="table table-bordered">
    <tr>
        <th>Username</th>
        <th>Status</th>
    </tr>
    <?php foreach($allUsers as $row): ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td>
            <?php if($row['status'] == 'approved'): ?>
                <span class="badge bg-success">Approved</span>
            <?php else: ?>
                <span class="badge bg-warning text-dark">Pending</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="text-center mt-3">
    <a href="logout.php" class="btn btn-dark">Logout</a>
</div>

</div>

</div>

</body>
</html>