<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_username = 'admin';
    $admin_password = 'Gaurav';

    if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error_message)): ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
