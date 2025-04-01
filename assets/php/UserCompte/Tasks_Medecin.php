<?php

// Query to fetch task details with patient, doctor, and paramedical information
$query = "
    SELECT 
        t.*, 
        p.Full_Name AS Patient_Name,
        p.StatusMedical AS StatusMedical, 
        m.Full_Name AS Medecin_Name, 
        s.Salle_Name AS Salle_Name
    FROM tasks t
    JOIN patient p ON t.Patient_ID = p.Patient_ID
    JOIN user m ON t.Medecin_ID = m.User_ID
    JOIN salle s ON t.Salle_ID = s.Salle_ID
    WHERE t.Medecin_ID = $user_id AND t.Task_Med_Status = 0
    ORDER BY t.Task_Date DESC
";

$getTasks = mysqli_query($conn, $query);

// التحقق مما إذا كان هناك مهام
if (mysqli_num_rows($getTasks) > 0) {
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
            <div class='wrapper2'>
                <button class='toggle'>
                    {$task['Patient_Name']}
                    <i class='fas fa-plus icon'></i>
                </button>
                <div class='content'>

                <form method='post' enctype='multipart/form-data'>
                <input type='hidden' name='task_id' value='$task[Task_ID]'>
                <div class='input-box'>
                <span class='details'>Patient</span>
                  <p>{$task['Patient_Name']}</p>
                </div>

                <div class='input-box'>
                <span class='details'>Salle ET lit</span>
                  <p>Salle : {$task['Salle_Name']}</p>
                  <p>Lit : {$task['Bed_ID']}</p>
                  <input type='hidden' name='bed_id' value='$task[Bed_ID]'>
                  </div>

                <div class='input-box'>
                <span class='details'>stauts</span>
                  <p>{$task['StatusMedical']}</p>
                  </div>

                <div class='input-box'>
                    <span class='details'>Traitment</span>
                    <div class='input-box statusPatient'>
                        <textarea rows='2' cols='30' name='texteura'></textarea>
                    </div>
                </div>

                <div class='input-box'>
                    <span class='details'>Equipe_paramedical</span>
                    <select name='PramSpc' id='medecinSelect' required>
                        <option value='' disabled selected>Select your option</option>
                        <option value='Rien'>Rien</option>
        ";

        // Fetch distinct specialties from the database where 'disponibilite = 1'
        $getMedecins = mysqli_query($conn, "SELECT DISTINCT Specialite FROM user WHERE JobType = 'Paramedical' AND disponibilite = 1 AND Status_Compte = 1");
        if ($getMedecins) {
            while ($medecin = mysqli_fetch_array($getMedecins)) {
                echo "
                <option value='" . htmlspecialchars($medecin['Specialite']) . "'>
                    " . htmlspecialchars($medecin['Specialite']) . "
                </option>";
            }
        } else {
            echo "<option>No available medecins</option>";
        }

        echo "
                    </select>
                </div>

                <button class='send-btn' type='submit' name='update_task'>
                    <span>Terminer</span>
                </button>
                </form>
            </div>
        </div>";
    }
} else {
    echo "<p style='text-align: center; font-size: 18px; color: blue;'> Il n'y a aucune tâche actuellement.</p>";
}

// Close the connection
mysqli_close($conn);
?>
