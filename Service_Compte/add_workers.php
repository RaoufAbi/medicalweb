<?php
include('../assets/php/config.php');
include ('../assets/php/session.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/service.css">
    <link rel="stylesheet" href="../assets/css/add_workers.css">
    <link rel="stylesheet" href="../assets/css/tables.css">
    <title>new user</title>
    <style>
        .bottom-data {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        td:nth-last-child(-n+2), th:nth-last-child(-n+2) {
    text-align: center;
   
         }
         td:nth-last-child(-n+2) p, td:nth-last-child(-n+2) img {
    cursor: pointer;
  
         }
         .status.cancelled:hover {
    background-color: #b30021;
    color: #e7d6da;
}

.status.delivered:hover {
    background-color: #006b21;
    color: #e7d6da;
}

    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <ul class="side-menu">
        <li><a href="Service.php"><i class='bx bxs-dashboard'></i>Tableau de bord</a></li>

            <li><a href="medecin.php"><i class='bx bx-store-alt'></i>Medecins</a></li>
            <li><a href="paramedical.php"><i class='bx bx-analyse'></i>Pramedical</a></li>
            <li><a href="tasks.php"><i class='bx bx-message-square-dots'></i>Tâches</a></li>
            <li><a href="patients.php"><i class='bx bx-group'></i>Patients</a></li>
            <li class="active"><a href="add_workers.php"><i class='bx bx-group'></i>Inscription</a></li>
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
                    <h1>inscription</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            inscription
                            </a></li>
                        /
                        <li><a href="#" class="active">Liste</a></li>
                    </ul>
                </div>

            </div>


            <div class="bottom-data">
                <main class="table" id="customers_table">
                    <section class="table__header">
                        <h1>Liste des medecins</h1>
                        <div class="input-group">
                            <input type="search" placeholder="  recherche...">
                            <img src="../images/medecins/search.png" alt="">
                        </div>

                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Personne <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Type <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Numero <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Accepter <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Refuser <span class="icon-arrow">&UpArrow;</span></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include ('../assets/php/CompteNonValide.php');
                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>

            </div>

        </main>

    </div>

    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/tables.js"></script>
    <script src="../assets/ajax/valideCompte.js"></script>
</body>

</html>