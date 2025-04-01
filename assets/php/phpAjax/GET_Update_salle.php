<?php
include("../config.php");
header('Content-Type: application/json');



if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT Salle_Name, Nbr_Bed FROM salle WHERE Salle_ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo json_encode(["success" => true, "nom_salle" => $row['Salle_Name'], "nb_lits" => $row['Nbr_Bed']]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
