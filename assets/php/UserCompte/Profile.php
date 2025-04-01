<?php
// get Compte Medecin
$getComptes = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = '$user_id'");

while ($Compte = mysqli_fetch_array($getComptes)) {
   $Naissance_Date = date('Y-m-d', strtotime($Compte['Naissance_Date']));
   $fullName = $Compte['Full_Name'];
   $JobType = $Compte['JobType'];
   $Gmail = $Compte['Gmail'];
   $Telephone = $Compte['Telephone'];
   $sexe = $Compte['sexe'];
   $OldPassword = $Compte['Password'];
   if ($sexe == 1) {
    $SX ="Male";
  }else {
    $SX ="Femelle";
  };
   $disponibilite = $Compte['disponibilite'];
   if ($disponibilite == 1) {
    $disp ="Au travail";
  }else {
    $disp ="En pause";
  }
   $Bio = $Compte['Bio'];
   $Exp = $Compte['Exp'];
   $Specialite = $Compte['Specialite'];
   $ImageProfile = $Compte['ImageProfile'];
   
}
;

?>