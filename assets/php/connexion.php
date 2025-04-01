<?php
// Start the session at the beginning of the script


// get email and password from the form
$emailFilter = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$passFilter = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$email = mysqli_real_escape_string($conn, $emailFilter);
$pass = mysqli_real_escape_string($conn, $passFilter);

// select from table where email and password match form data
$select = "SELECT * FROM user WHERE Gmail = '$email' AND Password = '$pass'";
$result = mysqli_query($conn, $select);

// if account exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    // Check JobType and redirect accordingly
    if ($row['JobType'] == 'Service') {
        $_SESSION['user_id'] = $row['User_ID'];
        header('Location: Service_Compte/Service.php');
        exit(); // Don't forget the exit after header to stop further script execution

    } elseif ($row['JobType'] == 'Medecin') {
        if ($row['Status_Compte'] == 0) {
            $error[] = 'Votre compte n\'est pas active!';
        } else {
            $_SESSION['user_id'] = $row['User_ID'];
            header('Location: UserCompte/MedecinPage.php');
            exit(); // Prevent further execution after redirect
        }

    } elseif ($row['JobType'] == 'Paramedical') {
        if ($row['Status_Compte'] == 0) {
            $error[] = 'Votre compte n\'est pas active!';
        } else {
            $_SESSION['user_id'] = $row['User_ID'];
            header('Location: UserCompte/PramPage.php');
            exit(); // Prevent further execution after redirect
        }
    }
} else {
    $error[] = 'Email ou mot de passe incorrect!';
}
?>
