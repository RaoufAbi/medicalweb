<?php

// Query to fetch task details with patient, doctor, and paramedical information
$query = "
    SELECT 
        t.*, 
        p.Full_Name AS Patient_Name,
        p.StatusMedical AS StatusMedical, 
        m.Full_Name AS Pram_Name, 
        s.Salle_Name AS Salle_Name
    FROM tasks t
    JOIN patient p ON t.Patient_ID = p.Patient_ID
    JOIN user m ON t.Paramedical_ID = m.User_ID
    JOIN salle s ON t.Salle_ID = s.Salle_ID
    WHERE t.Paramedical_ID = $user_id AND t.Task_Med_Status = 1 AND t.Task_Stauts = 0
    ORDER BY t.Task_Date DESC
";

$getTasks = mysqli_query($conn, $query);

// تحقق مما إذا كان هناك مهام
if (mysqli_num_rows($getTasks) > 0) {
    while ($task = mysqli_fetch_array($getTasks)) {
        $formattedDate = date('Y-m-d H:i', strtotime($task['Task_Date']));

        echo "
            <div class='wrapper2'>
            <button class='toggle'>
                {$task['Patient_Name']}
                <i class='fas fa-plus icon'></i>
            </button>
            <div class='content'>

            <form method='post' enctype='multipart/form-data'>
            <input type='hidden' name='task_id' value='{$task['Task_ID']}'>
            <div class='input-box'>
            <span class='details'>Patient</span>
              <p>{$task['Patient_Name']}</p>
            </div>

                      <div class='input-box'>
            <span class='details'>Salle ET lit</span>
              <p>Salle : {$task['Salle_Name']}</p>
              <p>Lit : {$task['Bed_ID']}</p>
              <input type='hidden' name='bed_id' value='{$task['Bed_ID']}'>
              </div>

              
            <div class='input-box'>
            <span class='details'>stauts</span>
              <p>{$task['StatusMedical']}</p>
              </div>
              

                 <div class='input-box'>
                    <span class='details'>Traitment</span>
                    <p>{$task['Traitement']}</p>
              </div>

             <button class='send-btn' type='submit' name='update_task'>
                  <span>Terminer la tâche</span>
              </button>
            </form>
          </div>
        </div>      
        ";
    }
} else {
    // عرض رسالة في حالة عدم وجود مهام
    echo "<p style='text-align: center; font-size: 18px; color: blue;'>Il n'y a aucune tâche actuellement.</p>";
}

// Close the connection
mysqli_close($conn);
?>
