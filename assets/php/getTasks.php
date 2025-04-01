<?php

// Query to fetch task details with patient, doctor, and paramedical information
$query = "
    SELECT 
        t.*, 
        p.Full_Name AS Patient_Name, 
        m.Full_Name AS Medecin_Name, 
        s.Salle_Name AS Salle_Name
    FROM tasks t
    JOIN patient p ON t.Patient_ID = p.Patient_ID
    JOIN user m ON t.Medecin_ID = m.User_ID
    JOIN salle s ON t.Salle_ID = s.Salle_ID
    ORDER BY t.Task_Date DESC
";

$getTasks = mysqli_query($conn, $query);


while ($task = mysqli_fetch_array($getTasks)) {
    $formattedDate = date('Y-m-d H:i', strtotime($task['Task_Date']));
    // Check if Paramedical_ID is 0
    if ($task['Paramedical_ID'] == 0) {
        $paramedicalName = "rein"; // If ID is 0, echo "rein"
    } else {
        // Otherwise, fetch the name of the paramedical staff from the user table
        $paramedicalQuery = "SELECT Full_Name FROM user WHERE User_ID = ?";
        $stmt = $conn->prepare($paramedicalQuery);
        $stmt->bind_param("i", $task['Paramedical_ID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $paramedical = $result->fetch_assoc();
        $paramedicalName = $paramedical ? $paramedical['Full_Name'] : "rein"; // Default to "rein" if not found
    }

    echo "
    <tr>
        <td> {$task['Patient_Name']} </td>
        <td> {$task['Medecin_Name']} </td>
        <td>
        ";
        if ($task['Paramedical_ID'] == 0) {
            echo "{$paramedicalName}";
        } else {
            echo "{$paramedicalName}";
        }
        echo"
        </td>
        <td> {$task['Salle_Name']} </td>
        <td> {$task['Bed_ID']} </td>
        <td> $formattedDate</td>
        <td>";

    if ($task['Task_Stauts'] == 1) {
        echo "<p class='status delivered'>Complete</p>";
    } else {
        echo "<p class='status pending'>Incomplete</p>";
    }

    echo "</td>
    </tr>";
}

// Close the connection
mysqli_close($conn);
?>