<?php
session_start();
require_once '../functions/functions.php';

if (!checkAdminLoggedIn()) {
    header('Location: admin_login.php');
    exit;
}

$bookings = fetchBookings($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Bookings</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Manage Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Station ID</th>
                <th>Owner ID</th>
                <th>Booking Time</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $booking['booking_id'] ?></td>
                    <td><?= $booking['station_id'] ?></td>
                    <td><?= $booking['owner_id'] ?></td>
                    <td><?= $booking['booking_time'] ?></td>
                    <td><?= $booking['start_time'] ?></td>
                    <td><?= $booking['end_time'] ?></td>
                    <td><?= $booking['status'] ?></td>
                    <td>
                        <a href="update_booking_status.php?id=<?= $booking['booking_id'] ?>&status=completed">Complete</a> |
                        <a href="update_booking_status.php?id=<?= $booking['booking_id'] ?>&status=canceled">Cancel</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
