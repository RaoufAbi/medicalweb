<?php
include("../assets/php/config.php");
include("../assets/php/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>msg</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <!--Google Font-->
  <!--Stylesheet-->
  <style>
body{

  display: flex;
  

}
  </style>
</head>
<body>

    
  <div class="wrapperMessage">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location:ChatApp/users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="bx bx-arrow-back"></i></a>
        <img src="../images/photoProfile/<?php echo $row['ImageProfile']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['Full_Name']?></span>
          <p><?php 
            if($row['disponibilite'] == 0){
              echo 'Inactif';
            }else {
              echo 'Active';
            }
           ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="bx bxl-telegram"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
</body>

</html>



