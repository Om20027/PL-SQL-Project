<?php
session_start();
require_once '../functions/functions.php';

if (!checkAdminLoggedIn()) {
    header('Location: admin_login.php');
    exit;
}

$stations = fetchChargingStations($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Charging Stations</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Manage Charging Stations</h2>
    <table>
        <thead>
            <tr>
                <th>Station ID</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stations as $station): ?>
                <tr>
                    <td><?= $station['station_id'] ?></td>
                    <td><?= $station['location'] ?></td>
                    <td><?= $station['status'] ?></td>
                    <td>
                        <!-- Edit or delete actions (implement as needed) -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
