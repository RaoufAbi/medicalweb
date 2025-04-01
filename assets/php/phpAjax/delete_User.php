<?php
include("../config.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // التحقق من أن 'user_id' موجود وهو رقمي
    if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);

        // للتصحيح: التأكد من استقبال قيمة user_id بشكل صحيح
        error_log("Received user_id: $user_id");

        // تكوين استعلام SQL مباشر للحذف
        $sql = "DELETE FROM user WHERE User_ID = $user_id";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true, "message" => "User deleted successfully"]);
        } else {
            error_log("Error executing query: " . mysqli_error($conn));  // تسجيل الخطأ في حال فشل الاستعلام
            echo json_encode(["success" => false, "message" => "Failed to delete user"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid user ID"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

mysqli_close($conn);
?>
