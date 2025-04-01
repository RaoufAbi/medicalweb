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
    <link rel="stylesheet" href="../assets/css/tables.css">
    <style>
        td:nth-last-child(-n+2),
        th:nth-last-child(-n+2) {
            text-align: center;

        }
        td,
        th{
            text-align: center;

        }
        td:nth-child(-n+2) p,
        td:nth-child(-n+2) img {
            cursor: pointer;

        }
    </style>
    <title>Service/medecin</title>
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
            <span class="title">Order validated</span>
            <p class="message">Thank you for your purchase. you package will be delivered within 2 days of your
                purchase</p>
        </div>
        <div class="actions">
            <button type="button" id="confirmDelete" class="history">Confirmer</button>
            <button type="button" class="track" id="cancelDelete">annuler</button>
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
            <li class="active"><a href="tasks.php"><i class='bx bx-message-square-dots'></i>Tâches</a></li>
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
                    <h1>Medecins</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Analytics
                            </a></li>
                        /
                        <li><a href="#" class="active">List</a></li>
                    </ul>
                </div>

            </div>

            <!-- Insights -->


            <!-- End of Insights -->

            <div class="bottom-data">


                <!-- Medcins List -->
                <main class="table" id="customers_table">
                    <section class="table__header">
                        <h1>Liste des medecins</h1>
                        <div class="input-group">
                            <input type="search" placeholder="  recherche...">
                            <img src="../images/medecins/search.png" alt="">
                        </div>
                        <!-- <div class="export__file">
                            <label for="export-file" class="export__file-btn" title="Export File"></label>
                            <input type="checkbox" id="export-file">
                            <div class="export__file-options">
                                <label>Export As &nbsp; &#10140;</label>
                                <label for="export-file" id="toPDF">PDF <img src="../images/medecins/pdf.png" alt=""></label>
                                <label for="export-file" id="toJSON">JSON <img src="../images/medecins/json.png" alt=""></label>
                                <label for="export-file" id="toCSV">CSV <img src="../images/medecins/csv.png" alt=""></label>
                                <label for="export-file" id="toEXCEL">EXCEL <img src="../images/medecins/excel.png" alt=""></label>
                            </div>
                        </div> -->
                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Patient <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> medecins <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> paramedical <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Salle <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> lit <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> statut <span class="icon-arrow">&UpArrow;</span></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../assets/php/getTasks.php");
                                ?>
                                <!-- <tr>
                                    <td> 3</td>
                                    <td><img src="../images/medecins/Sonal Gharti.jpg" alt=""> Sonal Gharti </td>
                                    <td> Tokyo </td>
                                    <td> 14 Mar, 2023 </td>
                                    <td>
                                        <p class="status shipped">Shipped</p>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <td> 5</td>
                                    <td><img src="../images/medecins/Sarita Limbu.jpg" alt=""> Sarita Limbu </td>
                                    <td> Paris </td>
                                    <td> 23 Apr, 2023 </td>
                                    <td>
                                        <p class="status pending">Plus tard</p>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                    </section>
                </main>

                <!-- End of Medecins List-->

            </div>

        </main>

    </div>
    </div>
    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/tables.js"></script>


</body>

</html>