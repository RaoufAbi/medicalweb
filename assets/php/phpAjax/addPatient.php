<?php
include("../config.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    // $gender = $_POST['gender'];
    $status = $_POST['status'];
    $medecinID = $_POST['medecinID'];
    $salleID = $_POST['salleID'];
    $bedID = $_POST['bedID'];



    // بدء المعاملة
    $conn->begin_transaction();

    try {
        $querySalleName = "SELECT Salle_Name FROM salle WHERE Salle_ID = ?";
$stmtSalleName = $conn->prepare($querySalleName);
$stmtSalleName->bind_param("i", $salleID);
$stmtSalleName->execute();
$resultSalleName = $stmtSalleName->get_result();
$rowSalleName = $resultSalleName->fetch_assoc();

$salleName = $rowSalleName['Salle_Name'];
        // إدراج المريض
        $insertPatientQuery = "INSERT INTO patient (Full_Name, Age, StatusMedical) 
                               VALUES ('$fullName', '$age', '$status')";
        if ($conn->query($insertPatientQuery) === TRUE) {
            $patientID = $conn->insert_id;  // جلب ID المريض الذي تم إدخاله حديثًا

            // إدراج المهمة
            $taskDate = date("Y-m-d H:i:s");
            $insertTaskQuery = "INSERT INTO tasks (Patient_ID, Medecin_ID, Task_Date, Salle_ID, Bed_ID, Task_Stauts) 
                                VALUES ('$patientID', '$medecinID', '$taskDate', '$salleID', '$bedID', 0)";

            $insertNotifQuery = "INSERT INTO notif (Notif_User_ID, Notif_Type, Notif_Date, Notif_Status,Salle ,bed) 
                     VALUES ('$medecinID', 'Task', '$taskDate', 0, '$salleName', '$bedID')";

            if ($conn->query($insertNotifQuery) === TRUE) {
                $conn->commit();
            } else {
                throw new Exception("لم يتم إدخال الإشعار.");
            }
            if ($conn->query($insertTaskQuery) === TRUE) {
                // تحديث السرير ليصبح غير متاح
                $updateBedQuery = "UPDATE bed SET Vide = 0 WHERE Bed_ID = '$bedID' AND Salle_ID ='$salleID'";
                $conn->query($updateBedQuery);

                // تأكيد التغيير
                $conn->commit();
                echo json_encode(["success" => true]);
            } else {
                throw new Exception("لم يتم إدخال المهمة.");
            }
        } else {
            throw new Exception("لم يتم إدخال المريض.");
        }
    } catch (Exception $e) {
        // إذا حدث خطأ، التراجع عن المعاملة
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>