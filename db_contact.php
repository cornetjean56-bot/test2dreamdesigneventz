<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'contact_feedback';

$conn = new mysqli($host, $user, $password);

if ($conn->connect_errno) {
    die('Contact database connection failed: ' . $conn->connect_error);
}

if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$database`")) {
    die('Failed to create database: ' . $conn->error);
}

if (!$conn->select_db($database)) {
    die('Failed to select database: ' . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($sql)) {
    die('Failed to create contacts table: ' . $conn->error);
}
?>
