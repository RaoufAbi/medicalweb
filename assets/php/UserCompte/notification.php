<?php
$getNotif = mysqli_query($conn, "SELECT * FROM notif WHERE Notif_User_ID = '$user_id'");

while ($Notif = mysqli_fetch_array($getNotif)) {
   $Notif_ID = $Notif['Notif_ID'];
   $Notif_Type = $Notif['Notif_Type'];
   $Notif_Date = date('Y-m-d H:i:s', strtotime($Notif['Notif_Date']));

   $Notif_Salle = $Notif['Salle'];
   $Notif_Bed = $Notif['bed'];
   $Notif_Status = $Notif['Notif_Status'];
   
   if ($Notif_Status == 0) {
    echo"
    <div class='mark info notifi' id='notif' data-userid='$user_id' data-notifid='$Notif_ID'>
      <img src='../images/crowd.png' >
      <div>
        <p>
          <span>Vouvelle tâche</span>
           <span class='event'>Salle :$Notif_Salle et Lit : $Notif_Bed
            <span class='dot'></span>
           </span>
        </p>
        <small>$Notif_Date</small>
      </div>
    </div>
   ";
   }else {
    echo"
    <div class='mark info notifi viewed' id='notif' data-userid='$user_id' data-notifid='$Notif_ID' >
      <img src='../images/crowd.png' >
      <div>
        <p>
          <span>Vouvelle tâche</span>
           <span class='event'>Salle :$Notif_Salle et Lit : $Notif_Bed
            <span class='dot' style='display: none;'></span>
           </span>
        </p>
        <small>$Notif_Date</small>
      </div>
    </div>
   ";
   }

}
;

?>