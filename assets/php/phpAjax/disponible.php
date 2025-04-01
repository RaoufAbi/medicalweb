<?php
include("../config.php"); // Include your database connection

if (isset($_POST['user_id']) && isset($_POST['status'])) {
    $userId = $_POST['user_id'];
    $status = $_POST['status'];

    // Set the new status value for 'disponibilite'
    $disponibilite = ($status === 'delivered') ? 1 : 0;

    // Update the database with the new 'disponibilite' value
    $updateQuery = "UPDATE user SET disponibilite = $disponibilite WHERE User_ID = '$userId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
 