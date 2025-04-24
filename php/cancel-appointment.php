<?php
require_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['appointment_id'])) {
        $appointment_id = intval($_POST['appointment_id']);

        // Prepare the SQL query to update the appointment status
        $sql = "UPDATE appointments SET status = 'cancelled' WHERE appointment_id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointment_id);

        if ($stmt->execute()) {
            // Redirect to the profile page or display success message
            header("Location: ../html/user.php"); // Or wherever you want to redirect the user
            exit();
        } else {
            // Handle error if the query fails
            echo "Error cancelling appointment. Please try again later.";
        }
    } else {
        echo "Invalid appointment ID.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
