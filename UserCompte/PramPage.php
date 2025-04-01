
<?php
include('../assets/php/config.php');
include('../assets/php/session.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_task'])) {
  $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
  $texteura = isset($_POST['texteura']) ? $_POST['texteura'] : null;
  $PramSpc = isset($_POST['PramSpc']) ? $_POST['PramSpc'] : null;
  $bed = isset($_POST['bed_id']) ? $_POST['bed_id'] : null;


      $incomplet = 0;
      $complet = 1;

          $query = "UPDATE tasks SET Task_Stauts = ? WHERE Task_ID = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("ii", $complet, $task_id);
          if ($stmt->execute()) {     
                                  // تحقق من أن $bed ليس فارغًا قبل التحديث
          $queryBed = "UPDATE bed SET Vide = ? WHERE Bed_ID = ?";
          $stmtBed = $conn->prepare($queryBed);
          $stmtBed->bind_param("ii", $complet, $bed);
          $stmtBed->execute();

          echo "<script>alert('Tâche realisee avec succes!');</script>";     
              echo "<script>alert('Tâche realisee avec succes!');</script>";
          } else {
              echo "<script>alert('Error Tâche.');</script>";
          }
          $stmt->close();
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
      include('../assets/php/UserCompte/Tasks_pram.php');
      ?>
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