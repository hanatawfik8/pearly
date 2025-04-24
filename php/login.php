<?php
session_start();
include("../includes/db_connection.php");

// Initialize error and success message variables
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'login' button is set (to make sure the form was submitted)
    if (isset($_POST['submit'])) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Simple login check 
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Use password_verify to check the hashed password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $email;
                $_SESSION['user_id'] = $user['user_id']; // Save their ID
                $success_message = "Login successful!";
                // After verifying user login


                header("Location: /pearly/index.html");
                exit;

            } else {
                $error_message = "Invalid email or password.";
                header("Location: ../html/login.html");
            }
        } else {
            $error_message = "Invalid email or password.";
            header("Location: ../html/login.html");
        }
    }
} else {
    $error_message = "Invalid request.";
    header("Location: ../html/login.html");
}

// Display messages without redirecting
// if (!empty($error_message)) {
//     echo "<div style='color: red;'>$error_message</div>";
// }

// if (!empty($success_message)) {
//     echo "<div style='color: green;'>$success_message</div>";
// }
