<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO ev_owners (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        header('Location: login.php');
        exit;
    } else {
        $error_message = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #333;
        }

        .register-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .register-container p.error {
            color: #d9534f;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 1rem;
            margin: 10px 0 5px;
            color: #333;
            text-align: left;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #1e3c72;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1e3c72;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #2a5298;
        }

        .register-container p.error {
            color: #ff4d4d;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>User Registration</h2>
        <?php if (isset($error_message)): ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
