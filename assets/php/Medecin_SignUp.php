
<?php

  // get les donnees de la formilaire

   $name = mysqli_real_escape_string($conn, $_POST['nameM']);
   $bio = mysqli_real_escape_string($conn, $_POST['bioM']);
   $gmail = mysqli_real_escape_string($conn, $_POST['emailM']);
   $diplome = mysqli_real_escape_string($conn, $_POST['diplomeM']);
   $daten =  $_POST['date_naissance_M'];
   $exp =  $_POST['expM'];
   $phone_number = $_POST['phone_M'];
   $sexe = $_POST['sexeM'];
   $Specialite = $_POST['specialiteM'];
   $password = $_POST['passwordM']; 
   $currentDateTime = new DateTime();
   $Date_SignUp = $currentDateTime->format('Y-m-d H:i:s');

   
   //get les donnees from personne where email dans la table egale email de la form 
   $select = " SELECT * FROM user WHERE Gmail = '$gmail' ";
   $result = mysqli_query($conn, $select); 

   // si existe deja
   if(mysqli_num_rows($result) > 0){

      $error[] = 'cet utilisateur existe deja!';

   }else{
 // si mot pass n'est pas egal connfirem mot pass

                 // ajoute cet compet a table personne
        $insert1 = "INSERT INTO user (Full_Name , Naissance_Date ,JobType,Status_Compte ,Gmail ,Telephone ,sexe ,disponibilite , Bio , ImageProfile ,Password ,Exp , Diplome ,Specialite ,	Date_SignUp)
         VALUES ('$name','$daten','Medecin',0,'$gmail','$phone_number' ,'$sexe',0 ,'$bio','Default.png','$password' ,'$exp','$diplome','$Specialite','$Date_SignUp')";
        mysqli_query($conn, $insert1);
        

        header('location:/');
      
   }




?>

