<?php
// get Compte non valide
$getComptes = mysqli_query($conn,"SELECT * FROM user WHERE Status_Compte = 0 ORDER BY Date_SignUp DESC");

while ( $Compte = mysqli_fetch_array($getComptes)) {
    $date = date('Y-m-d H:i:s', strtotime($Compte['Date_SignUp']));
   
        echo "
                                <tr>
                                    <td> $Compte[User_ID] </td>
                                    <td> <img src='../images/photoProfile/Default.png'>$Compte[Full_Name]</td>
                                    
                                    <td> $Compte[JobType] </td>
                                    <td> $date</td>
                                    <td>
                                        <p class='status delivered'>Accepter</p>
                                    </td>
                                    <td>
                                        <p class='status cancelled'>Refuser</p>
                                    </td>
                                    
                                </tr>

        ";
      }
;
            
?>