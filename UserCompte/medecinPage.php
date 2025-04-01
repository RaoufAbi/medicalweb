
<?php
include('../assets/php/config.php');
include('../assets/php/session.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_task'])) {
  $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
  $texteura = isset($_POST['texteura']) ? $_POST['texteura'] : null;
  $PramSpc = isset($_POST['PramSpc']) ? $_POST['PramSpc'] : null;
  $bed = isset($_POST['bed_id']) ? $_POST['bed_id'] : null;

  if (!empty($task_id) && !empty($texteura) && !empty($PramSpc)) {
      $incomplet = 0;
      $complet = 1;

      if ($PramSpc == 'Rien') {
          $query = "UPDATE tasks SET Paramedical_ID = ?, Traitement = ?,Task_Med_Status = ?, Task_Stauts = ? WHERE Task_ID = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("issii", $incomplet, $texteura,$complet, $complet, $task_id);
          if ($stmt->execute()) {  
                                  // تحقق من أن $bed ليس فارغًا قبل التحديث
          $queryBed = "UPDATE bed SET Vide = ? WHERE Bed_ID = ?";
          $stmtBed = $conn->prepare($queryBed);
          $stmtBed->bind_param("ii", $complet, $bed);
          $stmtBed->execute();        
          } else {
              echo "<script>alert('Error task.');</script>";
          }
          $stmt->close();
      }else {
        $findParamQuery = "SELECT User_ID FROM user 
        WHERE Specialite = '$PramSpc' 
        AND JobType = 'Paramedical' 
        AND Status_Compte = 1
        AND disponibilite = 1
        AND User_ID NOT IN (SELECT Medecin_ID FROM tasks) 
        LIMIT 1";

        $result = $conn->query($findParamQuery);
        if ($result->num_rows > 0) {
          $parm = $result->fetch_assoc();
          $parm_ID = $parm['User_ID'];
      } else {
          // البحث عن الطبيب الأقل انشغالًا
          $findLeastBusyPramQuery = "SELECT Paramedical_ID FROM tasks 
                                        WHERE Paramedical_ID IN 
                                            (SELECT User_ID FROM user WHERE Specialite = '$PramSpc' AND JobType = 'Paramedical' AND Status_Compte = 1 AND disponibilite = 1) 
                                        GROUP BY Paramedical_ID 
                                        ORDER BY COUNT(*) ASC 
                                        LIMIT 1";
  
          $result = $conn->query($findLeastBusyPramQuery);
          if ($result->num_rows > 0) {
              $parm = $result->fetch_assoc();
              $parm_ID = $parm['Paramedical_ID'];
          } 

      }
          $queryPram = "UPDATE tasks SET Paramedical_ID = ?, Traitement = ?,Task_Med_Status = ?, Task_Stauts = ? WHERE Task_ID = ?";
          $stmtPram = $conn->prepare($queryPram);
          $stmtPram->bind_param("issii", $parm_ID, $texteura,$complet ,$incomplet, $task_id);
          $stmtPram->execute();
      }

          echo "<script>alert('Task successfully!');</script>";
    } else {
      echo "<script>alert('Please fill all fields.');</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/medecinPage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!--Google Font-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <!--Stylesheet-->

  <style>
    .input-box{
      margin: 15px 0;
      width: 100%;
    }
    .input-box span{
      font-weight: 400;
      font-size: 24px;
      text-decoration: underline;
      color: #4066da;
    }
    .input-box p{
    margin: 0;
    margin-top: 10px;
    height: 45px;
    width: 90%;
    outline: none;
    font-size: 22px;
    border-radius: 5px;
    padding-left: 15px;
    
    border-bottom-width: 2px;
    }
    .input-box select{
      margin-top: 10px;
    height: 45px;
    width: 100%;
    outline: none;
    font-size: 18px;
    border-radius: 5px;
    padding-left: 15px;
    border: 2px solid #ccc;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
    }
  </style>
</head>
<body>
<?php
include('../assets/php/UserCompte/SideBar.php');
?>
  <main>
    <div class="container">
      
      <?php
      include("../assets/php/UserCompte/Tasks_Medecin.php")
      ?>
      <!-- <div class="wrapper2">
        <button class="toggle">
            What is the return policy?
            <i class="fas fa-plus icon"></i>
        </button>
        <div class="content">
            <h5>Malade</h5>
            <p>mohamed bennacet</p>
            <h5>stauts</h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores error doloremque, quibusdam qui necessitatibus autem aperiam reprehenderit? Ipsum maiores dolore inventore ea. Accusantium fuga eius laboriosam iusto blanditiis doloremque ullam?</p>
            <h5>Traitment</h5>
            <div class="input-box statusPatient">
                <textarea rows="2" cols="30"></textarea>
            </div>
            <button class="send-btn">
                <span>Button</span>
            </button>
        </div>
    </div> -->

    </div>
  </main>
  <script type="text/javascript" src="../assets/js/medecinPage.js" defer></script>
</body>

<script>
    let toggles = document.getElementsByClassName('toggle');
let contentDiv = document.getElementsByClassName('content');
let icons = document.getElementsByClassName('icon');

for(let i=0; i<toggles.length; i++){
    toggles[i].addEventListener('click', ()=>{
        if( parseInt(contentDiv[i].style.height) != contentDiv[i].scrollHeight){
            contentDiv[i].style.height = contentDiv[i].scrollHeight + "px";
            toggles[i].style.color = "#0084e9";
            icons[i].classList.remove('fa-plus');
            icons[i].classList.add('fa-minus');
        }
        else{
            contentDiv[i].style.height = "0px";
            toggles[i].style.color = "#111130";
            icons[i].classList.remove('fa-minus');
            icons[i].classList.add('fa-plus');
        }

        for(let j=0; j<contentDiv.length; j++){
            if(j!==i){
                contentDiv[j].style.height = "0px";
                toggles[j].style.color = "#111130";
                icons[j].classList.remove('fa-minus');
                icons[j].classList.add('fa-plus');
            }
        }
    });
}
</script>
</html>