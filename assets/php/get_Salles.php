<?php
// get Salles
$getSalles = mysqli_query($conn, "SELECT * FROM salle");

while ($salle = mysqli_fetch_array($getSalles)) {

    echo "
    <tr>
        <td> $salle[Salle_Name] </td>
        <td> $salle[Nbr_Bed] </td>
        <td>
                                            <img src='../images/modifier.png' class='updateSalleBtn'
                                                data-Selle_id-update='$salle[Salle_ID]'>
                                        </td>
                                        <td>
                                            <img src='../images/remove.png' class='delete-btn'
                                                data-Selle_id-delete='$salle[Salle_ID]'>
                                        </td>
                                        
    </tr>
    ";
}
?>
