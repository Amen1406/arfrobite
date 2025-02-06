<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Settings</title>
    <?php include "../../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../arfrobite_css/settings.css">
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

    <div class="tabs">
      <li class="active">Edit Profile</li>
      <li>Preferences</li>
      <li>Security</li>
    </div>



    <form enctype="multipart/form-data" method="post">
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>


     <label class="circle-container">
      <img src="../assets/default-rider.avif" alt="Image" id="circleImage">
      <input type="file" name="rider-pic" id="rider-pic" class="file-input">
     </label>
          
     <div class="input">
        <input type="text" name="rider-name" id="rider-name" placeholder="Full Name">
     </div>
     <div class="input">
        <input type="tel" name="rider-number" id="rider-number" placeholder="Mobile Number">
     </div>
     <div class="input">
        <input type="email" name="rider-email" id="rider-email" placeholder="Email">
     </div>
     <div class="input">
        <input type="text" name="rider-location" id="rider-location" placeholder="Location [City, Town]">
     </div>
     <div class="input">
         <input type="password" name="pass" id="pass" placeholder="Create Password">
         <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
      </div>


     <div class="btn">
        <button type="submit" id="register_rider_button">Register</button>
     </div>

   </form>


   <div id="preferences">
     <p>idubhwdhuaefiojaefijo</p>
   </div>
   
    <div id="rider_notificationPopup"></div>

    </div>
</body>
<script src="../../arfrobite_javascript/settings.js"></script>
</html>