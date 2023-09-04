<?php
session_start();
include('db.php');

$customer_login_error = '';
$customer_registration_error = '';

//customer_login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_login'])) {
    $customer_username = $_POST['customer_username'];
    $customer_password = $_POST['customer_password'];

    $query = "SELECT * FROM users WHERE username = '$customer_username'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($customer_password, $user['password']) && $user['user_type'] === 'customer') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $customer_login_error = "Invalid customer credentials.";
        }
    } else {
        $customer_login_error = "Invalid customer credentials.";
    }
}

//customer_registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_register'])) {
    $customer_username = $_POST['customer_username'];
    $customer_password = $_POST['customer_password'];  // Make sure to hash the password
    $customer_user_type = 'customer';  // Set the user type to 'customer'

    // Insert new customer into the users table
    $insert_query = "INSERT INTO users (username, password, user_type) VALUES ('$customer_username', '$customer_password', '$customer_user_type')";
    $insert_result = mysqli_query($connection, $insert_query);

    if ($insert_result) {
        // Registration successful, you can redirect or display a success message
        header("Location: admin/dashboard.php");
        exit();
    } else {
        // Registration failed, handle errors or display an error message
        $registration_error = "Registration failed. Please try again.";
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Welcome to the Customer</h1>

    <!-- Customer Login Form -->
    <h2>Customer Login</h2>
    <form method="post">
        <input type="text" name="customer_username" placeholder="Username" required><br>
        <input type="password" name="customer_password" placeholder="Password" required><br>
        <input type="submit" name="customer_login" value="Login">
    </form>
    <?php echo $customer_login_error; ?>

     <!-- Customer Registration Form -->
     <h2>Customer Registration</h2>
    <form method="post">
        <input type="text" name="customer_username" placeholder="Username" required><br>
        <input type="password" name="customer_password" placeholder="Password" required><br>
        <input type="submit" name="customer_register" value="Register">
    </form>
    <?php if (isset($registration_error)) echo $registration_error; ?>

</body>
</html>