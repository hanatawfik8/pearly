<?php
require_once '../includes/db_connection.php';

$appointments = [];

$sql = "
  SELECT a.appointment_id, u.first_name, u.last_name, a.service_name, a.appointment_date, a.status
  FROM appointments a
  JOIN users u ON a.user_id = u.user_id
  ORDER BY a.appointment_date DESC
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
  }
}

$conn->close();
