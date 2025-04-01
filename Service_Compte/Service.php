<?php
include('../assets/php/config.php');
include('../assets/php/session.php');
include('../assets/php/add_Salles.php');

$querySALLE = "SELECT COUNT(*) AS total FROM salle";
$resultSALLE = $conn->query($querySALLE);
$SalleNumber = $resultSALLE->fetch_assoc();

$queryBED = "SELECT COUNT(*) AS total FROM bed";
$resultBED = $conn->query($queryBED);
$BEDNumber = $resultBED->fetch_assoc();


$query_tasks = "SELECT COUNT(*) AS total FROM tasks";
$result_tasks = $conn->query($query_tasks);
$Tasks_Number = $result_tasks->fetch_assoc();

$query_patient = "SELECT COUNT(*) AS total FROM patient";
$result_patient = $conn->query($query_patient);
$patient_Number = $result_patient->fetch_assoc();

$SPCM='Medecin';
$SPCP='Paramedical';
$query_medecin = "SELECT COUNT(*) AS total FROM user WHERE JobType ='$SPCM'";
$result_medecin = $conn->query($query_medecin);
$medecin_Number = $result_medecin->fetch_assoc();

$query_paramedical = "SELECT COUNT(*) AS total FROM user WHERE JobType ='$SPCP'";
$result_paramedical = $conn->query($query_paramedical);
$paramedical_Number = $result_paramedical->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/service.css">
    <link rel="stylesheet" href="../assets/css/tables.css">
    <style>
        td:nth-last-child(-n+2),
        th:nth-last-child(-n+2) {
            text-align: center;

        }

        td:nth-last-child(-n+2) p,
        td:nth-last-child(-n+2) img {
            cursor: pointer;

        }

        td {
            font-size: large;
            font-weight: bolder;
        }

        .AllComp {
            transition: 0.5s;
        }

        .AllComp.active {
            filter: blur(20px);
            pointer-events: none;
            user-select: none;
        }
        #UPDATEModal,
        #ADDModal {
            width: 600px;
        }


        #deleteModal .title{
            font-size: 22px;
            font-weight: bold;
        }
        
        #ADDModal .title {
            font-size: 22px;
            font-weight: bold;
            color: rgb(0, 0, 0);
        }
        #UPDATEModal .title {
            font-size: 22px;
            font-weight: bold;
            color: rgb(92, 204, 103);
        }
        #UPDATEModal .history {
            background-color: rgb(92, 204, 103);
        }
        #UPDATEModal .track{
            background-color:rgb(231, 231, 231) ;
        }
        #ADDModal .history {
            background-color: rgb(142, 160, 250);
        }
        #ADDModal .track{
            background-color:rgb(231, 231, 231) ;
        }

        .input {
            border: 2px solid transparent;
            width: 100%;
            font-size: 16px;
            color: black;
            margin-top: 15px;
            height: 3.5em;
            padding-left: 0.8em;
            display: block;
            outline: none;
            overflow: hidden;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            transition: all 0.5s;
            border: 2px solid #4A9DEC;
        }

        .input:hover,
        .input:focus {
            border: 2px solidrgb(0, 132, 255);
            box-shadow: 0px 0px 0px 7px rgb(74, 157, 236, 20%);
            background-color: white;
        }
    </style>
    <title>tableau de bord</title>
</head>

<body>




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
            <span class="title">Supprimer salle</span>
            <p class="message">"Êtes-vous sûr de vouloir supprimer cette salle ? Toutes les donnees associees, y compris les lits, seront definitivement supprimees. Cette action est irreversible !"</p>
        </div>
        <div class="actions">
            <button type="button" id="confirmDelete" class="history">Confirmer</button>
            <button type="button" class="track" id="cancelDelete">annuler</button>
        </div>
    </div>
</div>



<div id="ADDModal" class="modal">
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
            <form action="" id="salleForm"  method="post">
                <div class="txtcard">
                    <span class="title">Ajouter un salle</span>
                    <div>
                        <!-- From Uiverse.io by shadowmurphy -->
                        <input class="input" name="nom_salle" type="text" required placeholder="le nom de la salle">
                        <input class="input" name="nb_lits" type="number" required placeholder="Nombre de lits">
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" name="submit" id="confirmSalle" class="history">Confirmer</button>
                    <button type="button" class="track" id="cancelADD">annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div id="UPDATEModal" class="modal">
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
            <form action="" id="updateSalleForm"  method="post">
                <div class="txtcard">
                    <span class="title">mettre à jour la salle</span>
                    <div>
                        <!-- From Uiverse.io by shadowmurphy -->
                        <input class="input" name="nom_salle" type="text" required placeholder="le nom de la salle">
                        <input class="input" name="nb_lits" type="number" required placeholder="Nombre de lits">
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" name="submit" id="confirmUpdate" class="history">Confirmer</button>
                    <button type="button" class="track" id="cancelUpdate">annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div id="AllComp" class="AllComp">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Pro</span>Medical</div>
        </a>  -->
            <ul class="side-menu">
                <li class="active"><a href="Service.php"><i class='bx bxs-dashboard'></i>Tableau de bord</a></li>
                <li><a href="medecin.php"><i class='bx bx-store-alt'></i>Medecins</a></li>
                <li><a href="paramedical.php"><i class='bx bx-analyse'></i>Pramedical</a></li>
                <li><a href="tasks.php"><i class='bx bx-message-square-dots'></i>Tâches</a></li>
                <li><a href="patients.php"><i class='bx bx-group'></i>Patients</a></li>
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
                        <h1>tableau de bord</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">
                            Statistiques
                                </a></li>
                            /
                            <li><a href="#" class="active">Salles</a></li>
                        </ul>
                    </div>

                </div>

                <!-- Insights -->
                <ul class="insights">
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?php 
                                echo"" . $Tasks_Number['total'];
                                ?>
                            </h3>
                            <p>Tâches</p>
                        </span>
                    </li>
                    <li><i class='bx bx-show-alt'></i>
                        <span class="info">
                            <h3>
                            <?php 
                                echo"" . $medecin_Number['total'];
                                ?>
                            </h3>
                            <p>medecin</p>
                        </span>
                    </li>
                    <li><i class='bx bx-line-chart'></i>
                        <span class="info">
                            <h3>
                            <?php 
                                echo"" . $patient_Number['total'];
                                ?>
                            </h3>
                            <p>Patients</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-capsule'></i>
                        <span class="info">
                            <h3>
                            <?php 
                                echo"" . $paramedical_Number['total'];
                                ?>
                            </h3>
                            <p>l'infirmiers</p>
                        </span>
                    </li>
                    <li>
                    <i class='bx bxs-home-heart'></i>                        <span class="info">
                            <h3>
                            <?php 
                                echo"" . $SalleNumber['total'];
                                ?>
                            </h3>
                            <p>Salles</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-bed'></i>
                        <span class="info">
                            <h3>
                            <?php 
                                echo"" . $BEDNumber['total'];
                                ?>
                            </h3>
                            <p>Lits</p>
                        </span>
                    </li>
                </ul>
                <!-- End of Insights -->

                <div class="bottom-data">

                    <main class="table" id="customers_table">
                        <section class="table__header">
                            <h1>Liste des Salles</h1>
                            <div class="input-group">
                                <input type="search" placeholder="  recherche...">
                                <img src="../images/medecins/search.png" alt="">
                            </div>

                            <button type="button" class="AddSalle" id="AddSalle">
                                <span class="button__text">Ajouter</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round"
                                        stroke-linecap="round" stroke="currentColor" height="24" fill="none"
                                        class="svg">
                                        <line y2="19" y1="5" x2="12" x1="12"></line>
                                        <line y2="12" y1="12" x2="19" x1="5"></line>
                                    </svg></span>
                            </button>
                        </section>
                        <section class="table__body">
                            <table>
                                <thead>
                                    <tr>
                                        <th> Salle <span class="icon-arrow">&UpArrow;</span></th>
                                        <th> Lit <span class="icon-arrow">&UpArrow;</span></th>
                                        <th> Modifier <span class="icon-arrow">&UpArrow;</span></th>
                                        <th> Suprimer <span class="icon-arrow">&UpArrow;</span></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                   <?php
                                   include("../assets/php/get_Salles.php");
                                   ?>


                                </tbody>
                            </table>
                        </section>
                    </main>

                </div>

            </main>

        </div>
    </div>
    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/tables.js"></script>
    <script src="../assets/ajax/delete_salle.js"></script>
    <script src="../assets/ajax/Update_salle.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("ADDModal");
            const bluer = document.getElementById('AllComp');

            const addSalleBtn = document.getElementById("AddSalle");
            const closeBtn = document.getElementById("cancelADD");

            // إظهار النافذة المنبثقة
            addSalleBtn.addEventListener("click", function () {
                modal.classList.add('active');
                bluer.classList.add('active');
            });

            // إخفاء النافذة عند النقر على زر "Annuler"
            closeBtn.addEventListener("click", function () {
                modal.classList.remove('active');
                bluer.classList.remove('active');
            });


        });
    </script>

    
</body>

</html>