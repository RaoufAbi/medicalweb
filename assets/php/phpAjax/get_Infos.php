<?php
include("../config.php");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medecinSPC = $_POST['medecinSpc'];
    $salle_id = $_POST['salleID']; // تأكد من أنك تحصل على السعة الصحيحة

    // البحث عن طبيب متاح
    $findMedecinQuery = "SELECT User_ID FROM user 
                         WHERE Specialite = '$medecinSPC' 
                         AND JobType = 'Medecin' 
                         AND Status_Compte = 1
                         AND disponibilite = 1
                         AND User_ID NOT IN (SELECT Medecin_ID FROM tasks) 
                         LIMIT 1";

    $result = $conn->query($findMedecinQuery);

    if ($result->num_rows > 0) {
        $medecin = $result->fetch_assoc();
        $medecinID = $medecin['User_ID'];
    } else {
        // البحث عن الطبيب الأقل انشغالًا
        $findLeastBusyMedecinQuery = "SELECT Medecin_ID FROM tasks 
                                      WHERE Medecin_ID IN 
                                          (SELECT User_ID FROM user WHERE Specialite = '$medecinSPC' AND JobType = 'Medecin' AND Status_Compte = 1 AND disponibilite = 1) 
                                      GROUP BY Medecin_ID 
                                      ORDER BY COUNT(*) ASC 
                                      LIMIT 1";

        $result = $conn->query($findLeastBusyMedecinQuery);
        if ($result->num_rows > 0) {
            $medecin = $result->fetch_assoc();
            $medecinID = $medecin['Medecin_ID'];
        } else {
            echo json_encode(["success" => false]);
            exit();
        }
    }

    // جلب القسم والسرير المتاح باستخدام salle_id
    $getBedQuery = "SELECT Bed_ID 
                         FROM bed
                         WHERE Salle_ID = '$salle_id' AND Vide = 1 
                         LIMIT 1";
    $getSalleQuery ="SELECT Salle_Name 
                         FROM salle
                         WHERE Salle_ID = '$salle_id' ";
    $result = $conn->query($getBedQuery);
    $result2 = $conn->query($getSalleQuery);
    $salleName = "غير متوفر";
    $bedID = "غير متوفر";

    if ($result->num_rows > 0) {
        $salleData = $result->fetch_assoc();
        $bedID = $salleData['Bed_ID'];
    }
    if ($result2->num_rows > 0) {
        $salleData = $result2->fetch_assoc();
        $salleName = $salleData['Salle_Name'];
    }

    // إرسال البيانات إلى JavaScript
    echo json_encode([
        "success" => true,
        "medecin" => $medecinID,
        "salle" => $salleName,
        "bed" => $bedID
    ]);
}
?>
