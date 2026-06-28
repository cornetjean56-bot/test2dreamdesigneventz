<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'booking_event';

$conn = new mysqli($host, $user, $password);

if ($conn->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$database`")) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to create database: ' . $conn->error]);
    exit;
}

if (!$conn->select_db($database)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to select database: ' . $conn->error]);
    exit;
}

$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    event_date DATE NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    package VARCHAR(100) NOT NULL,
    guests INT DEFAULT 0,
    message TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($sql)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to create bookings table: ' . $conn->error]);
    exit;
}
?>
