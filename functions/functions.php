<?php
require_once __DIR__ . '/../config/db.php';

function fetchChargingStations($pdo) {
    $stmt = $pdo->query("SELECT * FROM charging_stations");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchChargingSessions($pdo) {
    $stmt = $pdo->query("SELECT * FROM charging_sessions");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchBookings($pdo) {
    $stmt = $pdo->query("SELECT * FROM bookings");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function checkAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}
function fetchUserBookings($owner_id, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE owner_id = ?");
    $stmt->execute([$owner_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchUserSessions($owner_id, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM charging_sessions WHERE owner_id = ?");
    $stmt->execute([$owner_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
