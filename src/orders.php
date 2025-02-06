<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arfrobite - Orders</title>
    <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/account_and_orders.css">
</head>
<body>

        <div class="navbar">
          <?php include "panels/navbar.php"; ?>
        </div>
        <div class="sidebar">
        <?php include "panels/sidepanel.php"; ?>
        </div>

<div id="homebody">
<header><h1><center>My Orders</center></h1></header>

<div class="header-buttons">
      <button id="upcoming">Upcoming</button>
      <button id="history" class="active-tab">History</button>
    </div>


<p class="section-header">Current Order</p>
  <section class="track-order"></section>

  <p class="section-header">Previous Order</p>
  <div class="order-list"></div>
 

</div>

<div class="right-sidebar">
  <?php include "panels/right-sidepanel.php"; ?>
  </div> 


</body>
<script src="../javascript/account_and_orders.js"></script>
</html>