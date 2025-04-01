<?php
include("../config.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Salle_ID']) && is_numeric($_POST['Salle_ID'])) {
        $salle_id = $_POST['Salle_ID'];

        // بدء المعاملة لضمان تنفيذ الحذف معًا
        mysqli_begin_transaction($conn);

        try {
            // حذف جميع الأسرة (bed) المرتبطة بـ Salle_ID
            $sql_bed = "DELETE FROM bed WHERE Salle_ID = $salle_id";
            if (!mysqli_query($conn, $sql_bed)) {
                throw new Exception("Error deleting from bed: " . mysqli_error($conn));
            }

            // حذف الغرفة (salle) بعد حذف الأسرة
            $sql_salle = "DELETE FROM salle WHERE Salle_ID = $salle_id";
            if (!mysqli_query($conn, $sql_salle)) {
                throw new Exception("Error deleting from salle: " . mysqli_error($conn));
            }

            // تنفيذ الحذف إذا لم يكن هناك أي خطأ
            mysqli_commit($conn);
            echo json_encode(["success" => true, "message" => "Salle and related beds deleted successfully"]);
        } catch (Exception $e) {
            mysqli_rollback($conn); // إلغاء العملية عند حدوث خطأ
            error_log($e->getMessage()); // تسجيل الخطأ
            echo json_encode(["success" => false, "message" => "Failed to delete Salle and related beds"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Salle ID"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

mysqli_close($conn);
?>
