<?php
include('../assets/php/config.php');
include('../assets/php/session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/calendar/evo-calendar.min.css">
  <link rel="stylesheet" href="../assets/css/calendar/evo-calendar.midnight-blue.min.css">
  <link rel="stylesheet" href="../assets/css/calendar/evo-calendar.orange-coral.min.css">
  <link rel="stylesheet" href="../assets/css/calendar/evo-calendar.royal-navy.min.css">

  <link rel="stylesheet" href="../assets/css/medecinPage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!--Google Font-->
  <!--Stylesheet-->
  <style>
    li:nth-last-child() a{
    color: red;
  
         }

  </style>
</head>
<body>
<?php
include('../assets/php/UserCompte/SideBar.php');
?>
  <main>
    <div id="calendar" ></div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../assets/js/medecinPage.js" ></script>
  <script src="../assets/js/evo-calendar.min.js"></script>
  <script>
    
    $(document).ready(function() {
    $('#calendar').evoCalendar({
        theme:"Royal Navy",
        language: 'fr',
        todayHighlight : true,
        today: true, 
    calendarEvents: [
      {
        id: 'event1', // Event's ID (required)
        name: "New Year", // Event name (required)
        date: "January/1/2025", // Event date (required)
        description:"ragha afuiezjkez uika afzgubjakfz afzuigbjkazf",
        type: "holiday", // Event type (required)
        everyYear: true // Same event every year (optional)
      },
      {
        name: "Vacation Leave",
        badge: "02/13 - 02/15", // Event badge (optional)
        date: ["February/13/2020", "February/15/2020"], // Date range
        description: "Vacation leave for 3 days.", // Event description (optional)
        type: "event",
        color: "#63d867" // Event custom color (optional)
      }
    ]
 
    })
})
  </script>
</body>

</html>