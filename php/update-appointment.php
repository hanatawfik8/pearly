<?php
require_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $appointment_id = $_POST['appointment_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $service_name = $_POST['service'];
  $appointment_date = $_POST['appointment_date'];
  $appointment_start_time = $_POST['appointment_time'];
  $status = $_POST['status'];

  // Calculate end time automatically (add 1 hour)
  $start = new DateTime($appointment_start_time);
  $end = clone $start;
  $end->modify('+1 hour');
  $appointment_end_time = $end->format('H:i:s');

  // Update users table
  $updateUser = $conn->prepare("
        UPDATE users 
        JOIN appointments ON users.user_id = appointments.user_id 
        SET users.first_name = ?, users.last_name = ?
        WHERE appointments.appointment_id = ?
    ");
  $updateUser->bind_param("ssi", $first_name, $last_name, $appointment_id);
  $updateUser->execute();

  // Update appointments table
  $updateAppt = $conn->prepare("
        UPDATE appointments 
        SET service_name = ?, appointment_date = ?, appointment_start_time = ?, appointment_end_time = ?, status = ?
        WHERE appointment_id = ?
    ");
  $updateAppt->bind_param("sssssi", $service_name, $appointment_date, $appointment_start_time, $appointment_end_time, $status, $appointment_id);
  $updateAppt->execute();

  $conn->close();

  // Redirect back after updating
  header('Location: ../html/admin-view-appointments.php');
  exit;
}
