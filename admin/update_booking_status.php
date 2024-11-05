<?php
session_start();
require_once '../config/db.php';
require '../functions/functions.php';

if (!checkAdminLoggedIn()) {
    header('Location: admin_login.php');
    exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $booking_id = $_GET['id'];
    $status = $_GET['status'];

    $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE booking_id = ?");
    $stmt->execute([$status, $booking_id]);

    header('Location: admin_bookings.php');
    exit;
}
?>
