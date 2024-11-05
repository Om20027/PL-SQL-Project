-- Database: EVCharging
CREATE DATABASE IF NOT EXISTS EVCharging;
USE EVCharging;

-- Table: ev_owners
CREATE TABLE IF NOT EXISTS ev_owners (
    owner_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  -- store hashed password
    phone VARCHAR(15)
);

-- Table: charging_stations
CREATE TABLE IF NOT EXISTS charging_stations (
    station_id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255) NOT NULL,
    status ENUM('available', 'occupied', 'out_of_service') DEFAULT 'available',
    power_output INT NOT NULL  -- power output in kW
);

-- Table: charging_sessions
CREATE TABLE IF NOT EXISTS charging_sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    station_id INT NOT NULL,
    owner_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    energy_consumed DECIMAL(5, 2),  -- energy consumed in kWh
    FOREIGN KEY (station_id) REFERENCES charging_stations(station_id),
    FOREIGN KEY (owner_id) REFERENCES ev_owners(owner_id)
);

-- Table: bookings
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    station_id INT NOT NULL,
    owner_id INT NOT NULL,
    booking_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
    FOREIGN KEY (station_id) REFERENCES charging_stations(station_id),
    FOREIGN KEY (owner_id) REFERENCES ev_owners(owner_id)
);

-- Table: admins
CREATE TABLE IF NOT EXISTS admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL  -- store hashed password for security
);

-- Insert default admin (Replace 'password' with an actual hashed password)
INSERT INTO admins (username, password) VALUES
('admin', '1234'); -- 'password' hashed with bcrypt
