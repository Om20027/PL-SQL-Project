<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EV Charging Station</title>
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
            background: url('images/ev_charging_station.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            text-align: center;
        }

        .welcome-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 90%;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ffd700;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        a {
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: rgba(255, 215, 0, 0.8);
            color: #333;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome to the EV Charging Station</h2>
        <p>Sign up as a new user: <a href="signup.php">Sign-Up</a></p>
        <p>Log in as an <a href="login.php">User</a> or <a href="admin/admin_login.php">Admin</a> to continue.</p>
    </div>
</body>
</html>
