<?php
// Connect to database
include("../includes/db_connection.php");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Admin details
$username = 'admin123';
$password = 'yourAdminPassword'; // Plain password you want

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO admins (username, password) VALUES ('$username', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
  echo "Admin created successfully!";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
