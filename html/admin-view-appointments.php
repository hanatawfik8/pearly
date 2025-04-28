<?php include '../php/get-appointments.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../images/whitening.svg" />
  <link rel="stylesheet" href="../css/forms.css" />
  <link rel="stylesheet" href="../css/admin.css" />
  <script
    src="https://kit.fontawesome.com/32b721850a.js"
    crossorigin="anonymous"></script>
  <title>Pearly - View Appointments</title>
</head>

<body>
  <nav class="container">
    <img src="../images/pearly-logo.svg" alt="Pearly Site Logo" />
    <ul class="nav-links">
      <a href="#" class="active-link">View Appointments</a>
      <img src="../images/yellow-dot.svg" alt="Divider" />
      <a href="#">Create Appointment</a>
    </ul>
    <i class="fa-solid fa-right-from-bracket log-out"></i>
  </nav>
  <main class="container">
    <table>
      <thead>
        <tr>
          <th>Patient Name</th>
          <th>Service</th>
          <th>Date & Time</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($appointments)): ?>
          <?php foreach ($appointments as $appt): ?>
            <tr>
              <td><?= htmlspecialchars($appt['first_name'] . ' ' . $appt['last_name']) ?></td>
              <td><?= htmlspecialchars($appt['service_name']) ?></td>
              <td><?= date('Y-m-d h:i A', strtotime($appt['appointment_date'])) ?></td>
              <td>
                <div class="status">
                  <span>Booked</span>
                </div>
              </td>
              <td><a href="../php/edit-appointment.php?id=<?= $appt['appointment_id'] ?>"><button class="update-btn">Update</button></a></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No appointments found.</td>
          </tr>
        <?php endif; ?>

      </tbody>
    </table>
  </main>
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
  <script src="../js/register.js"></script>
</body>

</html>