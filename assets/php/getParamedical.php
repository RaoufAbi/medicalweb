<?php
// get Compte Medecin
$getComptes = mysqli_query($conn, "SELECT * FROM user WHERE Status_Compte = 1 AND JobType = 'Paramedical' ORDER BY Date_SignUp DESC");

while ($Compte = mysqli_fetch_array($getComptes)) {
    $date = date('Y-m-d H:i:s', strtotime($Compte['Date_SignUp']));

    echo "
    <tr>
        <td> $Compte[User_ID] </td>
        <td><img src='../images/photoProfile/$Compte[ImageProfile]'> $Compte[Full_Name] </td>
        <td> $Compte[Specialite]  </td>
        <td>";

    if ($Compte['disponibilite'] == 1) {
        echo "<p class='status delivered' data-userid='$Compte[User_ID]'>En cours</p>";
    } else {
        echo "<p class='status cancelled' data-userid='$Compte[User_ID]'>indisponible</p>";
    }

    echo "  
        <td>
            <img src='../images/remove.png' class='delete-btn' data-userid='$Compte[User_ID]'>
        </td>
    </tr>
    ";
}
?>
