<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arfrobite - Delivery Management</title>
    <?php include "../../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../arfrobite_css/delivery.css">
    <link rel="stylesheet" href="../../arfrobite_css/map.css">
    <script src="../../arfrobite_javascript/map.js"></script>
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

        <div id="rider_notificationPopup"></div>

        <div class="container"></div>

        <div class="map-container">
            <header>
                <h1>Track Order</h1>
            </header>

            <div class="mapview">
             <script src='../../arfrobite_javascript/geocoder.js'></script>
             <div id='map'></div>
            </div>
        </div>
 

        <div class="customerInfo">
        <header>
                <h1>Customer Details</h1>
            </header>

            <section id="restaurant-info">
                <div class="restaurant-image">
                    <img src="../../assets/mcdonalds.png" alt="Restaurant Image">
                </div>
                <div class="restaurant-details">
                    <h2>Mama Efua Cuisine</h2>
                    <p>Owner: Efua Kendrick</p>
                    <p>Working hours: 8:00am - 9:00pm</p>
                    <p>Location: 123 Main Street</p>
                    <p>Contact: 123-456-7890</p>
                    <p>Ratings: 4.5 / 5</p>
                </div>
            
            </section>

            <section class="menu">
                <h2>Order</h2>
                <div class="menu-item">
                    <p>Item 1</p>
                    <p>$10.99</p>
                </div>
                <div class="menu-item">
                    <p>Item 2</p>
                    <p>$12.99</p>
                </div>
  
            </section>
        </div>

        <div class="map-customerInfo">
            <header>
                <h1>Track Order</h1>
            </header>

            <div class="mapview">
             <script src='../../arfrobite_javascript/geocoder.js'></script>
             <div id='map'></div>
            </div>
        </div>
    </div>

    <script src="../../arfrobite_javascript/delivery.js"></script>
</body>
</html>

 