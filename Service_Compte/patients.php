<?php
include("../assets/php/config.php");
include("../assets/php/session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/service.css">
    <link rel="stylesheet" href="../assets/css/patients.css">
    <title>Service/patients</title>

    <style>

.modal .title {
  color:rgb(88, 199, 89);

}

.modal .history {

  background-color: rgb(88, 199, 89);

}

    </style>
</head>

<body>

    <div id="modalOverlay" class="overlay"></div>


    <div id="deleteModal" class="modal">
        <div class="header">
            <div class="image">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                    <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#000000"
                            d="M20 7L9.00004 18L3.99994 13"></path>
                    </g>
                </svg>
            </div>
            <div class="txtcard">
                <span class="title">validation</span>
                <p class="message" id="salleSelected"></p>
                <p class="message" id="bedSelected"></p>
            </div>
            <div class="actions">
                <button type="button" id="confirmDelete" class="history">Envoyer</button>

            </div>
        </div>
    </div>
    <div id="AllComp" class="AllComp">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Pro</span>Medical</div>
        </a> -->
            <ul class="side-menu">
            <li><a href="Service.php"><i class='bx bxs-dashboard'></i>Tableau de bord</a></li>
                <li><a href="medecin.php"><i class='bx bx-store-alt'></i>Medecins</a></li>
                <li><a href="paramedical.php"><i class='bx bx-analyse'></i>Pramedical</a></li>
                <li><a href="tasks.php"><i class='bx bx-message-square-dots'></i>Tâches</a></li>
                <li class="active"><a href="patients.php"><i class='bx bx-group'></i>Patients</a></li>
                <li><a href="add_workers.php"><i class='bx bx-group'></i>Inscription</a></li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="../index.php" class="logout">
                        <i class='bx bx-log-out-circle'></i>
                        Deconnexion
                    </a>
                </li>
            </ul>
        </div>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="content">
            <!-- Navbar -->
            <nav>
                <i class='bx bx-menu'></i>
                
            </nav>

            <!-- End of Navbar -->

            <main>
                <div class="header">
                    <div class="left">
                        <h1>obtenir des donnees</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">
                                    Form
                                </a></li>
                            /
                            <li><a href="#" class="active">Donnees</a></li>
                        </ul>
                    </div>

                </div>


                <!-- End of Insights -->

                <div class="bottom-data">

                    <div class="container">
                        <!-- Title section -->
                        <div class="title">Malade</div>
                        <div class="content_form">
                            <!-- Registration form -->
                            <form action="#" method="POST" id="formPatient">
                                <div class="user-details">
                                    <!-- Input for Full Name -->
                                    <div class="input-box">
                                        <span class="details">nom et prenome</span>
                                        <input type="text" name="fullName" placeholder="nom et prenome" required>
                                    </div>

                                    <!-- Input for Age -->
                                    <div class="input-box">
                                        <span class="details">Age</span>
                                        <input type="number" name="age" placeholder="Age" required>
                                    </div>

                                    <!-- Textarea for Status -->
                                    <div class="input-box statusPatient">
                                        <span class="details">Statut</span>
                                        <textarea name="status" rows="2" cols="30" required></textarea>
                                    </div>

                                    <!-- Select for Salle -->
                                    <div class="input-box ">
                                        <span class="details select-btn">Salle Libre</span>
                                        <select name="salleID" id="salleSelect" required>
                                            <option value="" disabled selected>Selectionnez voter option</option>
                                            <?php
                                            // Fetch available salles from the database
                                            $getAvailableSalles = mysqli_query($conn, "
            SELECT DISTINCT b.Salle_ID
            FROM bed b
            WHERE b.Vide = 1
        ");

                                            // Loop through salles and populate the select options
                                            while ($Salle = mysqli_fetch_array($getAvailableSalles)) {
                                                $getSalleName = mysqli_query(
                                                    $conn,
                                                    "
                SELECT s.Salle_ID, s.Salle_Name
                FROM salle s
                WHERE s.Salle_ID = " . $Salle['Salle_ID']
                                                );
                                                while ($SalleName = mysqli_fetch_array($getSalleName)) {
                                                    echo "
                    <option value='" . $SalleName['Salle_ID'] . "'>
                        " . htmlspecialchars($SalleName['Salle_Name']) . "
                    </option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <!-- Select for Medecin -->
                                    <div class="input-box">
                                        <span class="details">Medecin</span>
                                        <select name="medecinSpc" id="medecinSelect" required>
                                            <option value="" disabled selected>Selectionnez voter option</option>
                                            <?php
// Fetch distinct specialties from the database where 'disponibilite = 1'
$getMedecins = mysqli_query($conn, "SELECT DISTINCT Specialite FROM user WHERE JobType = 'Medecin' AND disponibilite = 1 AND Status_Compte = 1");
if ($getMedecins) {
    // Loop through the specialties and populate the select options
    while ($medecin = mysqli_fetch_array($getMedecins)) {
        echo "
            <option value='" . htmlspecialchars($medecin['Specialite']) . "'>
                " . htmlspecialchars($medecin['Specialite']) . "
            </option>";
    }
} else {
    echo "<option>No available medecins</option>";
}
?>

                                        </select>
                                    </div>


                                    <!-- Gender Selection -->
                                    <!-- <div class="gender-details">
                                        <input type="radio" name="gender" id="dot-1" value="1" required>
                                        <input type="radio" name="gender" id="dot-2" value="0" required>
                                        <span class="gender-title">Gender</span>
                                        <br><br>
                                        <div class="category">
                                            <label for="dot-1">
                                                <span class="dot one"></span>
                                                <span class="gender">Male</span>
                                            </label>
                                            <label for="dot-2">
                                                <span class="dot two"></span>
                                                <span class="gender">Female</span>
                                            </label>
                                        </div>
                                    </div> -->


                                </div>
                                <!-- Submit button -->
                                <button type="submit" class="Sendbutton">
                                    <span class="text">Envoyer</span>
                                    <span class="svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20"
                                            viewBox="0 0 38 15" fill="none">
                                            <path fill="white"
                                                d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>


                            </form>
                        </div>
                    </div>


                </div>

            </main>

        </div>
    </div>
    <script src="../assets/js/index.js"></script>
    <script>
        const selectMenus = document.querySelectorAll(".select-menu");

        selectMenus.forEach(optionMenu => {
            const selectBtn = optionMenu.querySelector(".select-btn"),
                options = optionMenu.querySelectorAll(".option"),
                sBtn_text = optionMenu.querySelector(".sBtn-text");

            selectBtn.addEventListener("click", () => {
                optionMenu.classList.toggle("active");
            });

            options.forEach(option => {
                option.addEventListener("click", () => {
                    let selectedOption = option.querySelector(".option-text").innerText;
                    sBtn_text.innerText = selectedOption;
                    optionMenu.classList.remove("active");
                });
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteModal = document.getElementById('deleteModal');
            const bluer = document.getElementById('AllComp');

            // استخدم متغير لتخزين حالة النموذج
            let isProcessing = false;

            // عند تقديم النموذج
            document.getElementById("formPatient").addEventListener("submit", function (e) {
                e.preventDefault();

                // منع إرسال البيانات إذا كانت العملية قيد المعالجة
                if (isProcessing) {
                    return;
                }

                isProcessing = true; // وضع العلامة بأن العملية قيد المعالجة
                // الحصول على بيانات النموذج
                let form = document.getElementById("formPatient");
                let formData = new FormData(form);

                // إضافة medecinID و bedID إلى بيانات النموذ

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../assets/php/phpAjax/get_Infos.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            document.getElementById("salleSelected").innerText = "salle : " + response.salle;
                            document.getElementById("bedSelected").innerText = "lit numero : " + response.bed;
                            bluer.classList.add('active');
                            deleteModal.classList.add('active');

                            // حفظ القيم لاستخدامها لاحقًا عند التأكيد
                            document.getElementById("confirmDelete").setAttribute("data-medecin", response.medecin);
                            document.getElementById("confirmDelete").setAttribute("data-salle", response.salle_id);
                            document.getElementById("confirmDelete").setAttribute("data-bed", response.bed);
                        }
                        isProcessing = false; // إعادة تعيين العملية عند الانتهاء
                    }
                };
                xhr.send(formData);
            });

            // عند الضغط على "تأكيد الحذف"
            document.getElementById("confirmDelete").addEventListener("click", function () {
                // تحقق من المتغيرات المحفوظة
                let medecinID = this.getAttribute("data-medecin");
                let bedID = this.getAttribute("data-bed");

                // الحصول على بيانات النموذج
                let form = document.getElementById("formPatient");
                let formData = new FormData(form);

                // إضافة medecinID و bedID إلى بيانات النموذج
                formData.append("medecinID", medecinID);
                formData.append("bedID", bedID);

                // إرسال البيانات إلى الخادم
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../assets/php/phpAjax/addPatient.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            window.location.href = "patients.php";
                        } else {
                            alert("حدث خطأ أثناء إدخال البيانات.");
                        }

                        isProcessing = false; // إعادة تعيين العملية عند الانتهاء
                    }
                };
                xhr.send(formData);
            });
        });


    </script>
</body>

</html>