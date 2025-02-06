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
        <section class="carousel-item">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="revenue"></h1>
              <p>Today&apos;s Revenue</p>
            </div>

            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                <path fill="#e0ecff"
                  d="M160 80c0-26.5 21.5-48 48-48h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V80zM0 272c0-26.5 21.5-48 48-48H80c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272zM368 96h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H368c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48z" />
              </svg></div>
          </div>
        </section>
        <section class="carousel-item">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="orders"></h1>
              <p>Today&apos;s Orders</p>
            </div>

            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512">
                <path fill="#ffffff"
                  d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM305 273L177 401c-9.4 9.4-24.6 9.4-33.9 0L79 337c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L271 239c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
              </svg></div>
          </div>
        </section>
        <section class="carousel-item">
          <div class="options-box-div">

            <div class="options-box-text">
              <h1 class="sales"></h1>
              <p>Total Sales</p>
            </div>

            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                <path fill="#f0f5ff"
                  d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z" />
              </svg></div>
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
              <div class="header__item"><a id="dish" class="filter__link filter__link--number" href="#">Dish</a></div>
              <div class="header__item"><a id="id" class="filter__link filter__link--number" href="#">Id</a></div>
              <div class="header__item"><a id="price" class="filter__link filter__link--number" href="#">Price(fix this one)</a></div>
              <div class="header__item"><a id="quantity" class="filter__link filter__link--number" href="#">Quantity</a>
              </div>
              <div class="header__item"><a id="date" class="filter__link filter__link--number" href="#">Date</a></div>
              <div class="header__item"><a id="status" class="filter__link filter__link--number" href="#">Status</a>
              </div>
            </div>

            <div class="table-content"></div>

          </div>
        </div>



        <div class="trending">
          <div class="deliver">
            <h1>Information</h1>
          </div>
        </div>

      </div>

      <div class="dishes">
        <div>
          <h1>Today&apos;s Orders</h1>
        </div>
      </div>

    </div>
    <div id="notificationPopup"></div>


    </div>

</body>
<script src="../../arfrobite_javascript/dashboard.js"></script>

</html>