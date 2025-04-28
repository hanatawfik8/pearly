<?php
require_once '../includes/db_connection.php';

$error_message = "";

if (!isset($_GET['id'])) {
  $error_message = "Invalid request. Appointment ID is missing.";
} else {
  $appointment_id = $_GET['id'];

  $sql = "
    SELECT a.appointment_id, u.first_name, u.last_name, a.service_name, a.appointment_date, a.status, a.appointment_start_time
    FROM appointments a
    JOIN users u ON a.user_id = u.user_id
    WHERE a.appointment_id = ?
  ";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $appointment_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $error_message = "Appointment not found.";
  } else {
    $appt = $result->fetch_assoc();
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Appointment</title>
  <link rel="stylesheet" href="../css/forms.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <main>
    <div class="card">
      <?php if ($error_message): ?>
        <!-- Error Message Display -->
        <div class="error-message">
          <p><?= htmlspecialchars($error_message) ?></p>
        </div>
      <?php endif; ?>

      <?php if (isset($appt)): ?>
        <h1>Edit Appointment</h1>
        <form action="update-appointment.php" method="POST">
          <input type="hidden" name="appointment_id" value="<?= $appt['appointment_id'] ?>">

          <div class="field-container">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($appt['first_name']) ?>" required>
          </div>

          <div class="field-container">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($appt['last_name']) ?>" required>
          </div>

          <div class="field-container">
            <label>Service Type</label>
            <div class="custom-select">
              <select name="service" id="service">
                <option value="Whitening">Whitening</option>
                <option value="Bonding">Bonding</option>
                <option value="Implants">Implants</option>
                <option value="Filling">Filling</option>
                <option value="Crowns">Crowns</option>
                <option value="Root Canal">Root Canal</option>
              </select>
              <span class="custom-arrow"></span>
            </div>
          </div>

          <div class="field-container">
            <label for="date">Appointment Date</label>
            <input type="date" id="date" name="date" class="booking-inputs" value="<?= $appt['appointment_date'] ?>" />
            <i class="fa-solid fa-calendar-days booking-i"></i>
          </div>
          <div class="field-container">
            <label for="time">Appointment Time</label>
            <div class="custom-select">
              <select name="time" id="time">
                <?php if (!empty($appt['appointment_start_time'])): ?>
                  <?php
                  $formatted_time = date('g:i A', strtotime($appt['appointment_start_time']));
                  ?>
                  <option value="<?= $formatted_time ?>" selected>
                    <?= $formatted_time ?>
                  </option>
                <?php else: ?>
                  <option value="">Select a time slot</option>
                <?php endif; ?>
              </select>
              <span class="custom-arrow"></span>
            </div>
          </div>

          <div class="field-container">
            <label for="status">Status:</label>
            <select name="status" id="status" required>
              <option value="booked" <?= $appt['status'] === 'booked' ? 'selected' : '' ?>>Booked</option>
              <option value="completed" <?= $appt['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
              <option value="cancelled" <?= $appt['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
          </div>

          <button type="submit">Save Changes</button>
          <button type="button" id="cancelBtn">Cancel</button>
        </form>
      <?php endif; ?>
    </div>
  </main>
  <script src="../js/get_available_time.js"></script>
  <script>
    // Handle cancel button
    $('#cancelBtn').click(function() {
      window.location.href = '../html/admin-view-appointments.php';
    });

    // Handle date change to reload available times
    $('#date').change(function() {
      var selectedDate = $(this).val();
      $.ajax({
        url: 'get_available_times.php',
        method: 'GET',
        data: {
          date: selectedDate
        },
        success: function(response) {
          $('#time').html('<option value="">Select a time slot</option>' + response);
        },
        error: function() {
          alert('Failed to load available times.');
        }
      });
    });
  </script>
</body>

</html>