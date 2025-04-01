<?php

if (isset($_POST['submit'])) {
           
                $nom_salle = $_POST["nom_salle"];
                $nb_lits = (int) $_POST["nb_lits"];
        
                // استعلام الإدراج
                $query = "INSERT INTO salle (Salle_Name, Nbr_Bed) VALUES ('$nom_salle', '$nb_lits')";
                
                if (mysqli_query($conn, $query)) {
                    // الحصول على ID القاعة التي تم إدراجها
                    $salle_id = mysqli_insert_id($conn);
        
                    // إدراج البيانات في جدول vide لكل سرير
                    for ($i = 1; $i <= $nb_lits; $i++) {
                        $query_vide = "INSERT INTO bed (Salle_ID, bed_ID, Temp_vide, Vide) VALUES ('$salle_id', '$i', 0, 1)";
                        mysqli_query($conn, $query_vide);
                    }
        
                    // إعادة التوجيه بعد الإدراج الناجح
                    header("Location: Service.php");
                    exit();
                }
            }
        
        ?>