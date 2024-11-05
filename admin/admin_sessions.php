<?php
session_start();
require_once '../functions/functions.php';

if (!checkAdminLoggedIn()) {
    header('Location: admin_login.php');
    exit;
}

$sessions = fetchChargingSessions($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Charging Sessions</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Manage Charging Sessions</h2>
    <table>
        <thead>
            <tr>
                <th>Session ID</th>
                <th>Station ID</th>
                <th>Owner ID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Energy Consumed (kWh)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sessions as $session): ?>
                <tr>
                    <td><?= $session['session_id'] ?></td>
                    <td><?= $session['station_id'] ?></td>
                    <td><?= $session['owner_id'] ?></td>
                    <td><?= $session['start_time'] ?></td>
                    <td><?= $session['end_time'] ?></td>
                    <td><?= $session['energy_consumed'] ?></td>
                    <td>
                        <!-- Edit or delete actions (implement as needed) -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
