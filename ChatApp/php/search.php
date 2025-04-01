<?php
include('../../assets/php/config.php');
include ('../../assets/php/session.php');

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM user WHERE NOT User_ID = {$outgoing_id} AND (Full_Name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'Aucun utilisateur trouve en rapport avec votre terme de recherche';
    }
    echo $output;
?>