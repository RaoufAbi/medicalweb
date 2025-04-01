<?php
include("../config.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);
        $action = $_POST['action'];

        if ($action === 'delete') {
            // Delete user
            $sql = "DELETE FROM user WHERE User_ID = $user_id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["success" => true, "message" => "User deleted successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to delete user"]);
            }
        } elseif ($action === 'accept') {
            // Update user status
            $sql = "UPDATE user SET Status_Compte = 1 WHERE User_ID = $user_id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["success" => true, "message" => "User accepted successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update user status"]);
            }
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid request"]);
    }
}

mysqli_close($conn);
?>
