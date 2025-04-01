<?php

include('../../assets/php/config.php');
include ('../../assets/php/session.php');

    $outgoing_id = $user_id;
    $sql = "SELECT * FROM user WHERE NOT User_ID = {$outgoing_id} AND Status_Compte	= 1 ORDER BY User_ID DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Aucun utilisateur n'est disponible pour discuter";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>