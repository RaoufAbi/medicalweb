<?php
include('../assets/php/config.php');
include ('../assets/php/session.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit profile</title>
  <link rel="stylesheet" href="../assets/css/notification.css">
  <link rel="stylesheet" href="../assets/css/medecinPage.css">

  <style>
    .viewed {
        background-color: white;
    }
    
    .viewed .dot {
        display: none;
    }
  </style>
</head>
<body>
<?php
include('../assets/php/UserCompte/SideBar.php');
?>
  <main>
    <header>
      <p>Notifications <span class="alert"> 0</span></p>
      <p class="toogle">Marquer tout comme lu</p>
    </header>
      <?php 
      include("../assets/php/UserCompte/notification.php");
      ?>
    <!-- <div class="mark info" id="test">
      <img src="../assets/images/avatar-mark-webber.webp" 
      alt="avatar-mark-webber">
      
      <div>
        <p>
          <span>Mark Webber</span> reacted to your recent post 
           <span class="event">My first tournament today!
            <span class="dot"></span>
           </span>
        </p>
        <small>1m ago</small>
      </div>
    </div>

    <div class="angela info" id="ang">
      <img src="../assets/images/avatar-angela-gray.webp" 
      alt="avatar-angela-gray">
      
      <div>
        <p>
          <span>Angela Gray</span>   followed you
          
            <span class="dot"></span>
          
        </p>
        <small>  5m ago</small>
      </div>
    </div>


    <div class="jacob info" id="jac">
      <img src="../assets/images/avatar-jacob-thompson.webp" 
      alt="avatar-jacob-thompson">
      
      <div>
        <p>
          <span>Jacob Thompson</span>has joined your group 
           <span class="club">Chess Club
            <span class="dot"></span>
           </span>
        </p>
        <small>1 day ago</small>
      </div>
    </div>
  
    <div class="info" id="Nat">
      <img src="../assets/images/avatar-nathan-peterson.webp" 
      alt="avatar-nathan-peterson">
      
      <div>
        <p>
          <span>Nathan Peterson</span>reacted to your recent post 
           <span class="event"> 5 end-game strategies to 
            increase your win rate
            
           </span>
        </p>
        <small> 2 weeks ago</small>
      </div>
    </div>
  
    
    <div class="info" id="anna">
      <img src="../assets/images/avatar-anna-kim.webp" 
      alt="  avatar-anna-kim">
      
      <div>
        <p>
          <span>Anna Kim</span>left the group
           <span class="club"> Chess Club
            
           </span>
        </p>
        <small>2 weeks ago</small>
      </div>
    </div>
    
     
    -->
  </main>
  <script type="text/javascript" src="../assets/js/medecinPage.js" ></script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
    let notifications = document.querySelectorAll(".notifi");
    let alertCount = document.querySelector(".alert");
    let toggleButton = document.querySelector(".toogle");

    function updateAlertCount() {
        let unreadCount = document.querySelectorAll(".notifi:not(.viewed)").length;
        alertCount.innerHTML = unreadCount > 0 ? unreadCount : "0";
    }

    notifications.forEach((notif) => {
        notif.addEventListener("click", function () {
            let notifId = this.getAttribute("data-notifid");

            if (!notifId) {
                console.error("معرف الإشعار غير موجود");
                return;
            }

            let xhr = new XMLHttpRequest();
xhr.open("POST", "../notification.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                try {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            notif.style.backgroundColor = "white";
                            let dot = notif.querySelector("span.dot");
                            if (dot) {
                                dot.style.display = "none";
                            }
                            notif.classList.add("viewed");
                            updateAlertCount();
                        } else {
                            console.error("خطأ في البيانات المسترجعة:", response.message);
                        }
                    } else {
                        console.error("فشل الطلب، كود الحالة:", xhr.status);
                    }
                } catch (error) {
                    console.error("خطأ في تحليل JSON:", error, xhr.responseText);
                }
            };

            xhr.send(`notif_id=${notifId}`);
        }, { once: true });
    });

    if (toggleButton) {
        toggleButton.addEventListener("click", () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../notification.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                try {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alertCount.innerHTML = "0";
                            notifications.forEach((notif) => {
                                notif.style.backgroundColor = "white";
                                let dot = notif.querySelector("span.dot");
                                if (dot) {
                                    dot.style.display = "none";
                                }
                                notif.classList.add("viewed");
                            });
                        } else {
                            console.error("خطأ في الاستجابة:", response.message);
                        }
                    } else {
                        console.error("فشل الطلب، كود الحالة:", xhr.status);
                    }
                } catch (error) {
                    console.error("خطأ في تحليل JSON:", error, xhr.responseText);
                }
            };

            xhr.send("mark_all=true");
        });
    }

    updateAlertCount();
});

  </script>
  
  <script>
    // let all = document.querySelectorAll("main div");
    // let dots = document.querySelectorAll("span.dot");
    // document.querySelector(".toogle").addEventListener("click", () => {
    //     document.querySelector(".alert").innerHTML = "0";
    //     for (a of all) {
    //         a.style.backgroundColor = "white";
    //         a.querySelector("div p span.dot").style.display = "none";
        
    //     }
    // })
    // function changeNum() {
    
    //     if (document.querySelector(".alert").innerHTML > 0) {
    //         document.querySelector(".alert").innerHTML = 
    //         document.querySelector(".alert").innerHTML - 1;    } 
    //     else {
    //         document.querySelector(".alert").innerHTML = 0;
    //     }
    // }
    // function bgChange(b) {
    //     document.getElementById(b).style.backgroundColor = "white";
    // }
    // function displayChange(c) {
    //     document.querySelector(c).style.display = "none";
    // }
    // for (a of all) {
    //     let didi = a.id;
    //     a.addEventListener("click", () => {
    //         bgChange(didi);
    //         displayChange("#" + didi + " div p span.dot");
    //         changeNum();
    //     }, { once: true })
    // }
  </script>
  <script>
    document.querySelectorAll('div[id^="ag-"]').forEach(function(element) {
    element.remove();
});
  </script>
  </body>

</html>