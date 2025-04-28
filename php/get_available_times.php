<?php
require_once '../includes/db_connection.php';

if (!isset($_GET['date'])) {
  echo json_encode([]);
  exit;
}

$selected_date = $_GET['date'];

// Define all possible time slots (4 PM to 10 PM) in 24-hour format
$all_slots = [
  "16:00:00", // 4:00 PM
  "17:00:00", // 5:00 PM
  "18:00:00", // 6:00 PM
  "19:00:00", // 7:00 PM
  "20:00:00", // 8:00 PM
  "21:00:00"  // 9:00 PM
];

// Fetch booked start times for that date
$sql = "SELECT appointment_start_time FROM appointments WHERE appointment_date = ? AND status = 'booked'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selected_date);
$stmt->execute();
$result = $stmt->get_result();

$booked_slots = [];

while ($row = $result->fetch_assoc()) {
  $booked_slots[] = $row['appointment_start_time']; // Store booked times in 24-hour format
}

$stmt->close();
$conn->close();

// Available slots = all slots - booked slots
$available_slots = array_diff($all_slots, $booked_slots);

// Convert available slots to 12-hour format with AM/PM for the dropdown
$available_slots_12hr = [];
foreach ($available_slots as $slot) {
  $available_slots_12hr[] = date('g:00 A', strtotime($slot)); // Convert to 12-hour format (e.g., "4:00 PM")
}

echo json_encode(array_values($available_slots_12hr));
