<?php
require_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = intval($_POST['user_id']);
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];

  $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?");
  $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
  $stmt->execute();

  $conn->close();
  header("Location: ../html/user.php"); 
  exit();
}
?>
