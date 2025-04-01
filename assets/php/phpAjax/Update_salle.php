<?php
include("../config.php");
header('Content-Type: application/json');

if (isset($_POST['id'], $_POST['nom_salle'], $_POST['nb_lits'])) {
    $id = $_POST['id'];
    $nom_salle = $_POST['nom_salle'];
    $nb_lits = (int) $_POST['nb_lits'];

    // جلب عدد الأسرة السابق من قاعدة البيانات
    $query_last = "SELECT Nbr_Bed FROM salle WHERE Salle_ID = ?";
    $stmt_last = $conn->prepare($query_last);
    $stmt_last->bind_param("i", $id);
    $stmt_last->execute();
    $result_last = $stmt_last->get_result();
    $row_last = $result_last->fetch_assoc();
    $last_nb_lits = (int) $row_last["Nbr_Bed"];

    // تحديث القاعة
    $stmt_update = $conn->prepare("UPDATE salle SET Salle_Name = ?, Nbr_Bed = ? WHERE Salle_ID = ?");
    $stmt_update->bind_param("sii", $nom_salle, $nb_lits, $id);
    $success = $stmt_update->execute();

    if ($success) {
        if ($nb_lits > $last_nb_lits) {
            // إذا كان العدد الجديد أكبر، أضف الأسرة الجديدة
            for ($i = $last_nb_lits + 1; $i <= $nb_lits; $i++) {
                $stmt_add = $conn->prepare("INSERT INTO bed (Salle_ID, bed_ID, Temp_vide, Vide) VALUES (?, ?, 0, 1)");
                $stmt_add->bind_param("ii", $id, $i);
                $stmt_add->execute();
            }
        } elseif ($nb_lits < $last_nb_lits) {
            // إذا كان العدد الجديد أقل، احذف الأسرة الزائدة
            for ($i = $last_nb_lits; $i > $nb_lits; $i--) {
                $stmt_delete = $conn->prepare("DELETE FROM bed WHERE Salle_ID = ? AND bed_ID = ?");
                $stmt_delete->bind_param("ii", $id, $i);
                $stmt_delete->execute();
            }
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
