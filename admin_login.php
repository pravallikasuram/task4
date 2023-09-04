<?php
session_start();
include('db.php');

$admin_login_error = '';
$customer_login_error = '';

// Admin Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    
    $query = "SELECT * FROM users WHERE username = '$admin_username'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($admin_password, $user['password']) && $user['user_type'] === 'admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $admin_login_error = "Invalid admin credentials.";
        }
    } else {
        $admin_login_error = "Invalid admin credentials.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>

    
    <form method="post">
        <input type="text" name="admin_username" placeholder="Username" required><br>
        <input type="password" name="admin_password" placeholder="Password" required><br>
        <input type="submit" name="admin_login" value="Login">
    </form>
    <?php echo $admin_login_error; ?>
</body>
</html>    