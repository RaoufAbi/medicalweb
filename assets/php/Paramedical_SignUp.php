
<?php

  // get les donnees de la formilaire

   $name = mysqli_real_escape_string($conn, $_POST['nameP']);
   $bio = mysqli_real_escape_string($conn, $_POST['bioP']);
   $gmail = mysqli_real_escape_string($conn, $_POST['emailP']);
   $diplome = mysqli_real_escape_string($conn, $_POST['diplomeP']);
   $daten =  $_POST['date_naissanceP'];
   $exp =  $_POST['expP'];
   $phone_number = $_POST['phone_numberP'];
   $sexe = $_POST['sexeP'];
   $Specialite = $_POST['spcP'];
   $password = $_POST['passwordP']; 
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
        $insert1 = "INSERT INTO user (Full_Name , Naissance_Date ,JobType ,Status_Compte ,Gmail ,Telephone ,sexe ,disponibilite , Bio , ImageProfile ,Password ,Exp , Diplome ,Specialite,Date_SignUp)
         VALUES ('$name','$daten','Paramedical',0,'$gmail','$phone_number' ,'$sexe',0 ,'$bio','Default.png','$password' ,'$exp','$diplome','$Specialite','$Date_SignUp')";
        mysqli_query($conn, $insert1);
        

        header('location:/');
      
   }




?>

