<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arfrobite - Restaurant Details</title>
    <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/restaurant-details.css">
</head>
<body>

    <div class="navbar">
      <?php include "panels/navbar.php"; ?>
    </div>

    <div class="sidebar">
    <?php include "panels/sidepanel.php"; ?>
    </div>


 <div id="homebody">
    <div class="restaurant-image"></div>

    <div class="details"></div>

    <div class="cart-popup"></div>

    <div class="tabs">
        <li class="active">Dishes</li>
        <li>Sides</li>
        <li>Drinks</li>
    </div>


    <div class="restaurant-dishes"></div>

  </div>

  <script src="../javascript/restaurant-details.js"></script>

  <div class="right-sidebar">
  <?php include "panels/promotions.php"; ?>
  </div> 

</body>
</html>