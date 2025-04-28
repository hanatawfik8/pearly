<?php include '../includes/db_connection.php'; ?>

<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user'])) {
  header("Location: login.html");
  exit();
}
$user_id = intval($_SESSION['user_id']); // Cast to integer for safety


// Fetch user info
$user_sql = "SELECT first_name, last_name, email FROM users WHERE user_id = $user_id";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();

// Fetch upcoming appointment
$appoint_sql = "SELECT * FROM appointments WHERE user_id = $user_id AND appointment_date >= CURDATE() AND status != 'Cancelled' ORDER BY appointment_date LIMIT 1";
$appoint_result = $conn->query($appoint_sql);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient Profile</title>
  <link rel="icon" href="../images/whitening.svg" />
  <link rel="stylesheet" href="../css/forms.css">
  <link rel="stylesheet" href="../css/user.css" />
  <script
    src="https://kit.fontawesome.com/32b721850a.js"
    crossorigin="anonymous"></script>
</head>

<body>
  <nav class="nav-container">
    <img
      loading="lazy"
      src="../images/pearly-logo.svg"
      alt="Pearly Site Logo" />
    <ul class="nav-links">
      <a class="active-link" href="../index.html">Home</a>
      <img loading="lazy" src="../images/yellow-dot.svg" alt="Divider" />
      <a href="../index.html#about-us">About Us</a>
      <img loading="lazy" src="../images/yellow-dot.svg" alt="Divider" />
      <a href="../index.html#services">Services</a>
    </ul>
    <div class="right">
      <button class="contact">
        <a href="mailto:">Contact Us</a>
      </button>
      <form action="">
        <button
          type="submit"
          class="fa-solid fa-right-from-bracket log-out"></button>
      </form>
    </div>
  </nav>
  <div class="App-container">
    <div class="header">
      <img src="../images/user-circles-set.png" alt="Profile Picture" />
      <div class="profile-info">
        <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
      </div>
      <button class="edit-profile-btn">Edit Profile</button>
    </div>

    <?php if ($appoint_result && $appoint_result->num_rows > 0): ?>
      <?php $appointment = $appoint_result->fetch_assoc(); ?>
      <div class="upcoming-appointment">
        <h3>Upcoming Appointment</h3>
        <div class="appointment-details">
          <div class="date-time">
            <p><?php echo htmlspecialchars($appointment['appointment_date']); ?></p>
            <p><?php echo date('g:i A', strtotime($appointment['appointment_start_time'])); ?></p>
          </div>
          <div class="doctor-service">
            <p>Dr. Ahmed</p>
            <p><?php echo htmlspecialchars($appointment['service_name']); ?></p>
          </div>
        </div>
        <div class="action-buttons">
          <button class="view-details-btn">View Details</button>
          <form action="../php/cancel-appointment.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" style="display:inline-block">
            <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>" />
            <button type="submit" class="cancel-appointment-btn">Cancel Appointment</button>
          </form>
        </div>
      </div>
    <?php else: ?>
      <div class="empty-state">
        <img src="../images/99900fdb-93a9-40e9-bbe4-708548704ecc.jpg" alt="No appointments" class="empty-icon" style="width: 100px; height: 100px;">
        <h3>No Upcoming Appointments</h3>
        <p>You don't have any scheduled visits right now</p>
        <a href="booking.html"><button class="book-appointment-btn">Book Now</button></a>
      </div>
    <?php endif; ?>



    <?php
    $history_sql = "SELECT appointment_date, appointment_start_time, service_name, status FROM appointments 
                WHERE user_id = $user_id ORDER BY appointment_date DESC";
    $history_result = $conn->query($history_sql);

    if ($history_result->num_rows > 0):
    ?>
      <div class="appointment-history">
        <h3>Appointment History</h3>
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Service</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $history_result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars(date('F j, Y', strtotime($row['appointment_date']))) ?></td>
                <td><?= date('g:i A', strtotime($row['appointment_start_time'])) ?></td>
                <td><?= htmlspecialchars($row['service_name']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    </tbody>
    </table>
  </div>
  </div>
  <!-- edit_popup_window -->
  <div id="editProfileModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Edit Profile</h2>
      <form action="../php/update-profile.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id ?>" />

        <label>First Name</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

        <label>Last Name</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit" class="save-btn">Save Changes</button>
      </form>
    </div>
  </div>

  <footer class="container">
    <div class="row">
      <div class="col">
        <img src="../images/pearly-logo.svg" alt="Pearly Site Logo" />
        <p class="site-description">
          Our Dentist Cares For Your Pearly Whites.
        </p>
        <div class="icons">
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="col">
        <h2 class="list-header">Quick Links</h2>
        <ul>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />
            <a href="#">Home</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">About Us</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Services</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Book an Appointment</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Contact</a>
          </li>
        </ul>
      </div>

      <div class="col">
        <h2 class="list-header">Services</h2>
        <ul>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Whitening
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Bonding
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Implants
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Fillings
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Crowns
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" />Root
            Canal
          </li>
        </ul>
      </div>

      <div class="col">
        <h2 class="list-header">Support</h2>
        <ul>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Terms of use</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Privacy</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">FAQs</a>
          </li>
          <li>
            <img src="../images/yellow-dot.svg" class="yellow-dot" /><a
              href="#">Help</a>
          </li>
        </ul>
      </div>

      <div class="col">
        <h2>Get In Touch</h2>
        <p>Subscribe Our Newsletter To Get Our Latest Updated News!</p>
        <form class="newsletter-form">
          <input type="text" placeholder="Your Email" />
          <button class="send">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </form>
      </div>
    </div>
    <div class="extra-info-section">
      <div class="row">
        <div class="col">
          <i class="fa-solid fa-copyright"></i> Pearly - 2025 All rights
          reserved.
        </div>
        <img src="../images/yellow-dot.svg" alt="Divider" />
        <div class="col">
          <i class="fa-solid fa-location-dot"></i> 205, Port Washington Road
        </div>
        <img src="../images/yellow-dot.svg" alt="Divider" />
        <div class="col"><i class="fa-solid fa-phone"></i> 127 889 706</div>
        <img src="../images/yellow-dot.svg" alt="Divider" />
        <div class="col">
          <i class="fa-solid fa-envelope"></i> johnsmith@pearly.com
        </div>
      </div>
    </div>
  </footer>
  <script src="../js/user.js"></script>
</body>

</html>