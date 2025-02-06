<!DOCTYPE html>
<html lang="en">

<head>
  <title>Arfrobite - Account</title>
  <?php include "../includes/metatags.php"; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/account_and_orders.css">
</head>

<body>

  <div class= "profile-container">
  <header><h1><center></center></h1></header>
  <div class="account-info"><div class="name"><span></span><a href="edit-profile.php">EDIT</a></div>
  <div class="contact"><span</span><span></span></div></div>
  </div>
  <hr>

  <section class="info">
    <div class="container" id="favorite">
      <div>
        <span>My Account</span>
        Favorite
      </div>

      <svg xmlns="http://www.w3.org/2000/svg" height="22" width="20" viewBox="0 0 448 512">
        <path fill="#fff"
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
      </svg>
    </div>

    <div class="container" id="my-address">
      <div>
        <span>Address</span>
        Share & Edit New Address
      </div>

      <svg xmlns="http://www.w3.org/2000/svg" height="22" width="20" viewBox="0 0 448 512">
        <path fill="#fff"
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
      </svg>
    </div>

    <div class="container" id="payment-info">
      <div>
        <span>Payment status</span>
        Payment and Refund Details
      </div>

      <svg xmlns="http://www.w3.org/2000/svg" height="22" width="20" viewBox="0 0 448 512">
        <path fill="#fff"
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
      </svg>
    </div>

    <div class="container" id="order">
      <div>
        <span>Order</span>
        Current and Past Orders
      </div>

      <svg xmlns="http://www.w3.org/2000/svg" height="22" width="20" viewBox="0 0 448 512">
        <path fill="#fff"
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
      </svg>
    </div>

    <div class="container">
      <div>
        <span>Refund & Earn</span>
        Refer Friend and earn $10
      </div>

      <svg xmlns="http://www.w3.org/2000/svg" height="22" width="20" viewBox="0 0 448 512">
        <path fill="#fff"
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
      </svg>
    </div>
  </section>


  <p class="section-header">Current Order</p>

  <section class="track-order">
    <div class="order-profile">

      <div class="profile-row">
        <div class="dish-img"><img src="../assets/starbucks.png" alt="dish"></div>

        <div class="dish-details">
          <span>3 items</span>
          <b>Starbuck <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10" viewBox="0 0 512 512"><path fill="#029094" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg></b>
        </div>

      </div>

      <div class="track-id">#2321212</div>

    </div>

    <div class="track-time">
      <div class="track-delivery-time">
        <span>Estimated Arrival</span>
        <span>Now</span>
      </div>

      <div class="track-current-time">
        <span class="track-current-time-i"><b>25</b> minutes</span>
        <span>Food on the way</span>
      </div>
    </div>

    <div class="track-buttons">
      <button id="cancel-order">Cancel</button>
      <button id="track-order">Track Order</button>
    </div>
  </section>

  <hr>

  <div class="logout-btn"><button id="logout">Logout</button></div>

</body>
<script src="../javascript/account_and_orders.js"></script>

</html>