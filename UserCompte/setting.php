<?php
include("../assets/php/config.php");
include("../assets/php/session.php");
include('../assets/php/UserCompte/Profile.php');

if (isset($_POST['update_profile'])) {
    // جلب البيانات وتصفية المدخلات
    $UPname = mysqli_real_escape_string($conn, $_POST['update_name']); 
    $UPemail = mysqli_real_escape_string($conn, $_POST['update_email']);
    $UPbio = mysqli_real_escape_string($conn, $_POST['update_bio']); 
    $UPtel = mysqli_real_escape_string($conn, $_POST['update_telephone']); 
    $date_naissance = mysqli_real_escape_string($conn, $_POST['update_date_naissance']); 

    $newpass = $_POST['new-password'];
    $confirmpass = $_POST['confirm-password'];
    
    // جلب كلمة المرور القديمة من قاعدة البيانات
    $query = "SELECT Password FROM user WHERE User_ID = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $OldPassword = $row['Password'];
    
    if (!empty($newpass) && !empty($confirmpass)) {
            if ($newpass === $confirmpass) {
                $updateQuery = "UPDATE user SET Password = '$newpass' WHERE User_ID = '$user_id'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "<script>alert('✅ تم تحديث كلمة المرور بنجاح!'); window.location.href='profile.php';</script>";
                } else {
                    echo "<script>alert('❌ خطأ في تحديث كلمة المرور: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('❌ كلمة المرور الجديدة غير متطابقة!');</script>";
            }
        } 
    
    

    // تحديث المعلومات الأخرى
    $updateFields = [];
    if (!empty($UPname)) $updateFields[] = "Full_Name = '$UPname'";
    if (!empty($UPemail)) $updateFields[] = "Gmail = '$UPemail'";
    if (!empty($UPbio)) $updateFields[] = "Bio = '$UPbio'";
    if (!empty($UPtel)) $updateFields[] = "Telephone = '$UPtel'";
    if (!empty($date_naissance)) $updateFields[] = "Naissance_Date = '$date_naissance'";

    if (!empty($updateFields)) {
        $updateQuery = "UPDATE user SET " . implode(", ", $updateFields) . " WHERE User_ID = '$user_id'";
        if (!mysqli_query($conn, $updateQuery)) {
            die("خطأ في تحديث البيانات: " . mysqli_error($conn));
        }
    }

    // تحديث الصورة الشخصية
    if (!empty($_FILES["update_image"]["name"])) {
        $file_name = $_FILES["update_image"]["name"];
        $file_size = $_FILES["update_image"]["size"];
        $tmp_name = $_FILES["update_image"]["tmp_name"];
        $error = $_FILES["update_image"]["error"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($error !== 0) {
            die("حدث خطأ أثناء تحميل الصورة!");
        } elseif (!in_array($imageExtension, $validImageExtensions)) {
            die("امتداد الصورة غير صالح! المسموح به: jpg, jpeg, png.");
        } elseif ($file_size > 10000000) {
            die("حجم الصورة كبير جدًا! الحد الأقصى 10 ميجابايت.");
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            if (move_uploaded_file($tmp_name, "../images/photoProfile/$newImageName")) {
                $updateImageQuery = "UPDATE user SET ImageProfile = '$newImageName' WHERE User_ID = '$user_id'";
                if (!mysqli_query($conn, $updateImageQuery)) {
                    die("خطأ في تحديث الصورة: " . mysqli_error($conn));
                }
            } else {
                die("فشل في حفظ الصورة!");
            }
        }
    }

    // إعادة التوجيه بعد التحديث
    echo "<script>alert('✅ تم تحديث بنجاح!'); window.location.href='profile.php';</script>";

    exit();
}


 
 
 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit profile</title>
  <link rel="stylesheet" href="../assets/css/medecinPage.css">
  <link rel="stylesheet" href="../assets/css/edit_profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!--Google Font-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--Stylesheet-->
  <style>
    #btn-down{
      margin-bottom: 50px;
    }
    #inpImage{
      border: none;
    }
    img{
      width: 50px;
      height: 50px;
    border-radius: 50%;
}
  </style>
</head>
<body>
<?php
include('../assets/php/UserCompte/SideBar.php');
?>
  <div class="container light-style flex-grow-1 container-p-y">

  <h4 class="font-weight-bold py-3 mb-4">
  Parametres du compte
  </h4>
  <form action="" method="post" enctype="multipart/form-data">
  <div class="card overflow-hidden">
    <div class="row no-gutters row-bordered row-border-light">
      <div class="col-md-3 pt-0">
        <div class="list-group list-group-flush account-settings-links">
          <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Changer le mot de passe</a>
        </div>
      </div>
      
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane fade active show" id="account-general">

            <div class="card-body media align-items-center">
            <img src="../images/photoProfile/<?php echo $ImageProfile;?>" class="d-block ui-w-80">
            <input type="file" name="update_image" id="inpImage">

              <div class="media-body ml-4">
   
                <div class="text-light small mt-1">Permis JPG, GIF or PNG.</div>
              </div>
            </div>
            <hr class="border-light m-0">

            <div class="card-body">
              <div class="form-group">
                <label class="form-label">nom et prenom</label>
                <input type="text" name="update_name" class="form-control mb-1" value="<?php echo"$fullName"?>">
              </div>

              <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="text" name="update_email" class="form-control mb-1" value="<?php echo"$Gmail"?>">

              </div>
              <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea class="form-control" name="update_bio" rows="5"><?php echo"$Bio"?></textarea>
              </div>
              <div class="form-group">
                <label class="form-label">date de naissance</label>
                <input type="date" name="update_date_naissance" class="form-control" value="<?php echo"$Naissance_Date"?>">
              </div>
              <div class="form-group">
                <label class="form-label">telephone</label>
                <input type="text" name="update_telephone" class="form-control" value="<?php echo"$Telephone"?>">
              </div>
            </div>

          </div>
          <div class="tab-pane fade" id="account-change-password">
            <div class="card-body pb-2">



              <div class="form-group">
                <label class="form-label">Nouveau password</label>
                <input type="password" name="new-password" class="form-control">
              </div>

              <div class="form-group">
                <label class="form-label">Repeter Nouveau password</label>
                <input type="password" name="confirm-password" class="form-control">
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div id="btn-down" class="text-right mt-3">
  <input type="submit" value="update profile" name="update_profile" class="btn btn-primary">&nbsp;
    <a href="profile.php" class="btn btn-default">Cancel</a>
  </div>
</form>
</div>
  <script type="text/javascript" src="../assets/js/medecinPage.js" ></script>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>