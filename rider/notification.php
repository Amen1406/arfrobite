<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Notifications</title>
    <?php include "../../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../arfrobite_css/notification.css">
</head>
<body>

   <div class="navbar">
      <?php include "panels/navbar.php"; ?>
    </div>

    <div class="sidebar">
      <?php include "panels/sidepanel.php"; ?>
    </div>

    <div id="homebody">

    <header class="top-container">
      <?php include "panels/header.php"; ?>
    </header>


      <h1><center>Notifications</center></h1>
      <div class="rider-notification-container"></div>
      <h1><center>Read Notifications</center></h1>
      <div class="rider-read-notification-container"></div>


      <div id="order-details"></div>

      
      <div class="popup" id="popupMessage">
        <p id="popupText"></p>
      </div>

    </div>


  

    <div class="right-sidebar">
     <?php //include "panels/right-sidepanel.php"; ?>
   </div>
</body>
<script src="../../arfrobite_javascript/notification.js"></script>
</html>