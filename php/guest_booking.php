<?php
require_once '../includes/db_connection.php';

// Sanitize form inputs
$appointment_date = $_POST['date'];
$appointment_time = $_POST['time'];
$service_name = $_POST['service'];
$guest_name = $_POST['patient-name'];
$guest_phone = $_POST['patient-phone'];

// Calculate start and end time
$start_time = date('H:i:s', strtotime($appointment_time));
$end_time = date('H:i:s', strtotime('+1 hour', strtotime($appointment_time)));

// Insert into appointments table for guest
$stmt = $conn->prepare("
    INSERT INTO appointments (guest_name, guest_phone, appointment_date, appointment_start_time, appointment_end_time, status, created_at, service_name)
    VALUES (?, ?, ?, ?, ?, 'booked', NOW(), ?)
");
$stmt->bind_param("ssssss", $guest_name, $guest_phone, $appointment_date, $start_time, $end_time, $service_name);

$stmt->execute();
$stmt->close();
$conn->close();

// Redirect after successful booking
header("Location: ../html/admin-view-appointments.php");
exit;
