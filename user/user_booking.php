<?php
session_start();
require_once '../config/db.php';
require_once '../functions/functions.php';

// Fetch charging stations for the selection dropdown
$stations = fetchChargingStations($pdo);

// Handle form submission for booking a charging slot
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $station_id = $_POST['station_id'];
    $owner_id = $_SESSION['owner_id'];
    
    // Combine date and time selections for start and end time
    $start_date = $_POST['start_date'];
    $start_hour = $_POST['start_hour'];
    $start_minute = $_POST['start_minute'];
    $start_ampm = $_POST['start_ampm'];
    $start_time = date("Y-m-d H:i:s", strtotime("$start_date $start_hour:$start_minute $start_ampm"));
    
    $end_date = $_POST['end_date'];
    $end_hour = $_POST['end_hour'];
    $end_minute = $_POST['end_minute'];
    $end_ampm = $_POST['end_ampm'];
    $end_time = date("Y-m-d H:i:s", strtotime("$end_date $end_hour:$end_minute $end_ampm"));

    // Insert booking into the bookings table
    $stmt = $pdo->prepare("INSERT INTO bookings (station_id, owner_id, booking_time, start_time, end_time) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->execute([$station_id, $owner_id, $start_time, $end_time]);

    // Insert into charging_sessions table
    $energy_consumed = $_POST['energy_consumed'] ?? NULL;  // Optional field if applicable
    $stmt = $pdo->prepare("INSERT INTO charging_sessions (station_id, owner_id, start_time, end_time, energy_consumed) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$station_id, $owner_id, $start_time, $end_time, $energy_consumed]);

    $success_message = "Booking and session successfully created!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User - Book Charging Slot</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        /* General styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://example.com/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select, input[type="date"], button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book a Charging Slot</h2>
        <?php if (isset($success_message)): ?>
            <p class="success"><?= $success_message ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="station_id">Select Charging Station:</label>
                <select id="station_id" name="station_id" required>
                    <?php foreach ($stations as $station): ?>
                        <option value="<?= $station['station_id'] ?>"><?= $station['location'] ?> (<?= $station['status'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Start Time Selection -->
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <div style="display: flex; gap: 5px;">
                    <select name="start_hour" required>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="start_minute" required>
                        <?php for ($i = 0; $i <= 59; $i += 5): ?>
                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="start_ampm" required>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
            </div>

            <!-- End Time Selection -->
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time:</label>
                <div style="display: flex; gap: 5px;">
                    <select name="end_hour" required>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="end_minute" required>
                        <?php for ($i = 0; $i <= 59; $i += 5): ?>
                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="end_ampm" required>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
            </div>

            <!-- Optional Energy Consumed Field -->
            <div class="form-group">
                <label for="energy_consumed">Energy Consumed (kWh):</label>
                <input type="number" id="energy_consumed" name="energy_consumed" step="0.01" min="0">
            </div>

            <button type="submit">Book Slot</button>
        </form>
    </div>
</body>
</html>
