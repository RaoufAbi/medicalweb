<?php
// start siosion
//si not existe alors anvoyer a page index
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /');
} else {


    // get user id
    $user_id = $_SESSION['user_id'];

    $getdataPersonne = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = '$user_id' ");
    $row = mysqli_fetch_assoc($getdataPersonne);


}

?>