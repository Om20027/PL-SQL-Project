<?php
session_start();
require_once '../config/db.php';
require_once '../functions/functions.php';

if (!isset($_SESSION['owner_id'])) {
    header('Location: ../login.php');
    exit;
}

$owner_id = $_SESSION['owner_id'];
$bookings = fetchUserBookings($owner_id, $pdo);
$sessions = fetchUserSessions($owner_id, $pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('../public/images/dashboard_bg.jpg') no-repeat center center;
            background-size: cover;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 2em;
            color: #1e3c72;
            margin-bottom: 15px;
        }

        h3 {
            color: #1e3c72;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #1e3c72;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            font-size: 1em;
            color: #888;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #1e3c72;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #2a5298;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>User Dashboard</h2>
        <p>Welcome, User! Here are your current bookings and charging sessions.</p>

        <h3>Your Bookings</h3>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Station ID</th>
                    <th>Booking Time</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= $booking['booking_id'] ?></td>
                            <td><?= $booking['station_id'] ?></td>
                            <td><?= $booking['booking_time'] ?></td>
                            <td><?= $booking['start_time'] ?></td>
                            <td><?= $booking['end_time'] ?></td>
                            <td><?= $booking['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Your Charging Sessions</h3>
        <table>
            <thead>
                <tr>
                    <th>Session ID</th>
                    <th>Station ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Energy Consumed (kWh)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($sessions) > 0): ?>
                    <?php foreach ($sessions as $session): ?>
                        <tr>
                            <td><?= $session['session_id'] ?></td>
                            <td><?= $session['station_id'] ?></td>
                            <td><?= $session['start_time'] ?></td>
                            <td><?= $session['end_time'] ?></td>
                            <td><?= $session['energy_consumed'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-data">No charging sessions found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="user_booking.php">Book a New Slot</a>
        <a href="../logout.php">Logout</a>
    </div>
</body>
</html>
