<?php
session_start();
require_once '../functions/functions.php';

if (!checkAdminLoggedIn()) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        h2 {
            margin: 0;
        }

        nav {
            background: #fff;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #0056b3;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-message {
            margin-bottom: 20px;
            font-size: 1.2em;
            color: #333;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h2>Admin Dashboard</h2>
    </header>
    <nav>
        <ul>
            <li><a href="admin_sessions.php">Manage Charging Sessions</a></li>
            <li><a href="admin_stations.php">Manage Charging Stations</a></li>
            <li><a href="admin_bookings.php">Manage Bookings</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="welcome-message">
            <h3>Welcome, Admin!</h3>
            <p>Manage your charging stations and sessions with ease.</p>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date("Y") ?> Electric Vehicle Management System</p>
    </footer>
</body>
</html>
