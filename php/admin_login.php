<?php
// Connect to database
include("../includes/db_connection.php");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Protect against SQL Injection (better way: prepared statements)
$username = $conn->real_escape_string($username);

// Check if the username exists in 'admins' table
$sql = "SELECT * FROM admins WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Username found
  $row = $result->fetch_assoc();
  $hashedPassword = $row['password'];

  // Verify the password
  if (password_verify($password, $hashedPassword)) {
    echo "Admin login successful!";
    // You can start session and redirect to admin dashboard
    // session_start();
    // $_SESSION['admin_id'] = $row['id']; // or username
    header("Location: ../html/admin-view-appointments.php");
    // exit();
  } else {
    echo "Wrong password!";
  }
} else {
  echo "Admin username not found!";
}

// Close connection
$conn->close();
