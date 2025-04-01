<?php
include('assets/php/config.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['notif_id'])) {
        $notif_id = intval($_POST['notif_id']);

        // تحديث حالة الإشعار
        $query = "UPDATE notif SET Notif_Status = 1 WHERE Notif_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $notif_id);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "حدث خطأ أثناء التحديث"]);
        }
        $stmt->close();
    } elseif (isset($_POST['mark_all'])) {
        // تحديث جميع الإشعارات كمقروءة
        $query = "UPDATE notif SET Notif_Status = 1";
        if ($conn->query($query)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "حدث خطأ أثناء التحديث"]);
        }
    }
}

$conn->close();
?>
