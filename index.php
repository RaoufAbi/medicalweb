<?php
session_start();
include('assets\php\config.php');
if (isset($_POST['submit'])) {
include('assets/php/connexion.php');
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login form</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: var(--color-4);
      overflow: hidden;
    }
  </style>
</head>

<body>
  <div class="header finisher-header" style="width: 100%; height: 100%;">
    <div class="form-container">

      <form action="" method="post">
        <h3>connexion</h3>

        <?php
        // si existe error alors affiche 
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
          }
          ;
        }
        ;
        ?>



        <input type="text" name="email" required placeholder="enter your email" autocomplete="off">
        <input type="password" name="password" required placeholder="enter your password">
        <input type="submit" name="submit" value="connexion" class="form-btn">
        <p>vous n'avez pas de compte ? <a href="signup.php">S'inscrire</a></p>
      </form>

    </div>
  </div>

  <script src="script/index.js"></script>
  <script src="assets/js/finisher-header.es5.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    new FinisherHeader({
      "count": 100,
      "size": {
        "min": 2,
        "max": 19,
        "pulse": 0
      },
      "speed": {
        "x": {
          "min": 0,
          "max": 0.4
        },
        "y": {
          "min": 0,
          "max": 0.6
        }
      },
      "colors": {
        "background": "#759cff",
        "particles": [
          "#0048ff",
          "#ffffff",
          "#000000"
        ]
      },
      "blending": "overlay",
      "opacity": {
        "center": 1,
        "edge": 0
      },
      "skew": 0,
      "shapes": [
        "c"
      ]
    });
  </script>
  </script>
</body>

</html>