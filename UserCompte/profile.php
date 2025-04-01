
<?php
include('../assets/php/config.php');
include ('../assets/php/session.php');
include('../assets/php/UserCompte/Profile.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  <link rel="stylesheet" href="../assets/css/profile.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/medecinPage.css">
  <!--Google Font-->
  <style>

  </style>
  <!--Stylesheet-->
</head>
<body>
<?php
include('../assets/php/UserCompte/SideBar.php');
?>
 

  <section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">Sur moi</h3>
                    <h6 class="theme-color lead">Membre de l'equipe medicale : <?php echo"$Specialite"?></h6>
                    <p><?php echo"$Bio"?></p>
                    <div class="row about-list">
                        <div class="col-md-6">

                            <div class="media">
                                <label>Naissance</label>
                                <p><p><?php echo"$Naissance_Date"?></p></p>
                            </div>
                            <div class="media">
                                <label>Sexe</label>
                                <p>

                                <?php echo "$SX"?>
                                
                                </p>
                            </div>
                            <div class="media">
                                <label>L'experience</label>
                                <p><?php echo"$Exp"?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>E-mail</label>
                                <p><?php echo"$Gmail"?></p>
                            </div>
                            <div class="media">
                                <label>Phone</label>
                                <p><?php echo"$Telephone"?></p>
                            </div>
                            <div class="media">
                                <label>Statut</label>
                                <p>                                
                                  <?php echo"$disp"
                                ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="../images/photoProfile/<?php echo"$ImageProfile"?>" title="" alt="">
                </div>
            </div>
        </div>

    </div>
</section>


  <script type="text/javascript" src="../assets/js/medecinPage.js" ></script>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  

</body>

</html>