<!DOCTYPE html>
<html lang="en">

<head>
  <title>Arfrobite</title>
  <?php include "../includes/metatags.php"; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/homescreen.css">
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

      <!-- Show user location and profile image -->
      <div style="display: flex; justify-content:space-between; align-items: center;">
        <div class="location">
          <div class="location-name">
            <svg xmlns="http://www.w3.org/2000/svg" height="28" width="26" viewBox="0 0 448 512">
              <path
                d="M429.6 92.1c4.9-11.9 2.1-25.6-7-34.7s-22.8-11.9-34.7-7l-352 144c-14.2 5.8-22.2 20.8-19.3 35.8s16.1 25.8 31.4 25.8H224V432c0 15.3 10.8 28.4 25.8 31.4s30-5.1 35.8-19.3l144-352z"
                fill="#fff" />
            </svg>
            <span>Your Location</span>
          </div>
          <span class="location-index"></span>
        </div>

        <div class="mobile-hprofile"></div>
      </div>


      <!-- Search -->
      <div class="search">
        <input type="search" name="search" id="search" placeholder="Search for restaurants and more">
        <ul id="results"></ul>
        <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512">
          <path
            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
        </svg>
      </div>

    </header>


      <!-- Ads -->
      <div class="ads">
        <span>ONE <br> LITE</span>
        <p>Enjoy <span>10 FREE DELIVERIES</span> <br> This section is for ads only</p>
        
      </div>


      <div class="carousel-container">
        <div class="carousel-wrapper" id="carousel-wrapper">
          <section class="carousel-item">
            <div class="options-box-div">

              <div class="options-box-text">
                <h1>Get up to 50% Off <br>on your first order</h1>
                <p>Get the absolute best out of the main dishes that are prepared by the top<br> restaurants  and top chefs around the country.
                  Don&apos;t hesitate to get started now!
                </p>

                <button>Use code</button>
              </div>

              <img src="../assets/avocado.png" alt="">
            </div>
          </section>
          <section class="carousel-item">
            <div class="options-box-div">

              <div class="options-box-text">
                <h1>Get up to 50% Off <br>on your first order</h1>
                <p>Get the absolute best out of the main dishes that are prepared by the top<br> restaurants  and top chefs around the country.
                  Don&apos;t hesitate to get started now!
                </p>

                <button>Use code</button>
              </div>

              <img src="../assets/avocado.png" alt="">
            </div>
          </section>
          <section class="carousel-item">
            <div class="options-box-div">

              <div class="options-box-text">
                <h1>Get up to 50% Off <br>on your first order</h1>
                <p>Get the absolute best out of the main dishes that are prepared by the top<br> restaurants  and top chefs around the country.
                  Don&apos;t hesitate to get started now!
                </p>

                <button>Use code</button>
              </div>

              <img src="../assets/avocado.png" alt="">
            </div>
          </section>
          <section class="carousel-item">
            <div class="options-box-div">

              <div class="options-box-text">
                <h1>Get up to 50% Off <br>on your first order</h1>
                <p>Get the absolute best out of the main dishes that are prepared by the top<br> restaurants  and top chefs around the country.
                  Don&apos;t hesitate to get started now!
                </p>

                <button>Use code</button>
              </div>

              <img src="../assets/avocado.png" alt="">
            </div>
          </section>
          <section class="carousel-item">
            <div class="options-box-div">

              <div class="options-box-text">
                <h1>Get up to 50% Off <br>on your first order</h1>
                <p>Get the absolute best out of the main dishes that are prepared by the top<br> restaurants  and top chefs around the country.
                  Don&apos;t hesitate to get started now!
                </p>

                <button>Use code</button>
              </div>

              <img src="../assets/avocado.png" alt="">
            </div>
          </section>
        </div>
    </div>


    <div class="tabs">
    <li class="tab all-tab active-tab">All</li>
  <li class="tab restaurants-tab">Restaurants</li>
  <li class="tab dishes-tab">Dishes</li>
    </div>


    <p class="section-header resh">Popular Restaurants</p>
    <div class="restaurant-options"></div>



    <p class="section-header dishh">Popular Dishes</p>
    <div class="dishes-options"></div>




  </div>

  <div class="right-sidebar">
  <?php include "panels/right-sidepanel.php"; ?>
 </div>

  <div id="addressbody">
    <?php include "address-screen.php"; ?>
  </div>
  
</body>
<script src="../javascript/homepage.js"></script>


</html>