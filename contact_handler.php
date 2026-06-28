<?php
require_once 'db_contact.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Contact.html');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '') {
    header('Location: Contact.html?status=error');
    exit;
}

$stmt = $conn->prepare('INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())');
if ($stmt === false) {
    error_log('DB prepare failed: ' . $conn->error);
    header('Location: Contact.html?status=error');
    exit;
}

$stmt->bind_param('sss', $name, $email, $message);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    header('Location: Contact.html?status=success');
    exit;
}

header('Location: Contact.html?status=error');
exit;
?>
