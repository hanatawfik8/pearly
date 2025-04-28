<?php
require_once '../includes/db_connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to login page if not logged in
  header("Location: login.php");
  exit;
}

// Get the logged-in user's user_id
$user_id = $_SESSION['user_id']; // Assuming the session stores user_id

// Sanitize form inputs
$appointment_date = $_POST['date'];
$appointment_time = $_POST['time']; // time input directly
$service_name = $_POST['service'];

// Calculate end time (1 hour after start time)
$start_time = date('H:i:s', strtotime($appointment_time));
$end_time = date('H:i:s', strtotime('+1 hour', strtotime($appointment_time)));

// Insert into appointments table
$stmt2 = $conn->prepare("INSERT INTO appointments (user_id, appointment_date, appointment_start_time, appointment_end_time, status, created_at, service_name)
VALUES (?, ?, ?, ?, 'booked', NOW(), ?)");
$stmt2->bind_param("issss", $user_id, $appointment_date, $start_time, $end_time, $service_name);
$stmt2->execute();
$stmt2->close();

$conn->close();

// Redirect after successful booking
header("Location: ../html/user.php");
exit;
