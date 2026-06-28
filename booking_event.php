<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Eventbooking.html?status=error');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$event_date = trim($_POST['event_date'] ?? '');
$event_type = trim($_POST['event_type'] ?? '');
$package = trim($_POST['package'] ?? '');
$guests = intval($_POST['guests'] ?? 0);
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $event_date === '' || $event_type === '' || $package === '') {
    header('Location: Eventbooking.html?status=error');
    exit;
}

$query = "INSERT INTO bookings (name, email, phone, event_date, event_type, package, guests, message, created_at)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($query);

if ($stmt === false) {
    error_log('Booking prepare failed: ' . $conn->error);
    header('Location: Eventbooking.html?status=error');
    exit;
}

$stmt->bind_param('ssssssis', $name, $email, $phone, $event_date, $event_type, $package, $guests, $message);
$success = $stmt->execute();
$stmt->close();

if ($success) {
    header('Location: Eventbooking.html?status=success');
    exit;
}

error_log('Booking insert failed: ' . $conn->error);
header('Location: Eventbooking.html?status=error');
exit;
?>
