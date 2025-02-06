<!DOCTYPE html>
<html lang="en">

<head>
  <title>Arfrobite</title>
  <?php include "../../arfrobite_includes/metatags.php"; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../arfrobite_css/dashboard.css">
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


    <!-- Ads -->
    <div class="ads">
      <span>ONE <br> LITE</span>
      <p>Enjoy <span>10 FREE DELIVERIES</span> <br> This section is for ads only</p>
    </div>


    <div class="carousel-container">
      <div class="carousel-wrapper" id="carousel-wrapper">
        <section class="carousel-item" style="background-color: #4CAF50;">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="accepted">25</h1>
              <p>Order&apos;s accepted</p>
            </div>

            <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#ffffff" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
          </div>
        </section>
        <section class="carousel-item" style="background-color: #f44336;">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="rejected">55</h1>
              <p>Order&apos;s rejected</p>
            </div>

            <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path fill="#fafcff" d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg>
            </div>
          </div>
        </section>
        <section class="carousel-item">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="number">22</h1>
              <p>Today&apos;s Orders</p>
            </div>

            <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#e0ecff" d="M160 80c0-26.5 21.5-48 48-48h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V80zM0 272c0-26.5 21.5-48 48-48H80c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272zM368 96h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H368c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48z" /></svg>
            </div>
          </div>
        </section>
      </div>
    </div>

    <div class="maindiv">
      <div class="tables">


        <div class="orderlist">

          <div class="order-header">
            <h1>Order List</h1>
            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="8" viewBox="0 0 128 512">
              <path fill="#fff"
                d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
            </svg>
          </div>

          <div class="table">
            <div class="table-header">
              <div class="header__item"><a id="dish" class="filter__link filter__link--number" href="#">Restaurant name</a></div>
              <div class="header__item"><a id="id" class="filter__link filter__link--number" href="#">Customer Name</a></div>
              <div class="header__item"><a id="price" class="filter__link filter__link--number" href="#">Order Details</a></div>
              <div class="header__item"><a id="date" class="filter__link filter__link--number" href="#">Action</a></div>
              </div>
            </div>

            <div class="rider-table-content"></div>

          </div>

          </div>

          <div class="information">
          <div>
            <h1>Information</h1>
          </div>
        </div>
        </div>


       
      </div>

      

    </div>
    <div id="rider_notificationPopup"></div>

  

    </div>

</body>
<script src="../../arfrobite_javascript/dashboard.js"></script>

</html>