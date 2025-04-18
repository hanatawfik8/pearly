<?php
require_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $appointment_id = $_POST['appointment_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $service_name = $_POST['service_name'];
  $appointment_date = $_POST['appointment_date'];
  $status = $_POST['status'];

  // Update user names
  $updateUser = $conn->prepare("
    UPDATE users 
    JOIN appointments ON users.user_id = appointments.user_id 
    SET users.first_name = ?, users.last_name = ?
    WHERE appointments.appointment_id = ?
  ");
  $updateUser->bind_param("ssi", $first_name, $last_name, $appointment_id);
  $updateUser->execute();

  // Update appointment data
  $updateAppt = $conn->prepare("
    UPDATE appointments 
    SET service_name = ?, appointment_date = ?, status = ? 
    WHERE appointment_id = ?
  ");
  $updateAppt->bind_param("sssi", $service_name, $appointment_date, $status, $appointment_id);
  $updateAppt->execute();

  $conn->close();

  // Redirect back
  header('Location: ../html/admin-view-appointments.php');
  exit;
}
