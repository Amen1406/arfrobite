<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arfrobite - Menu</title>
    <?php include "../../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../arfrobite_css/menu.css">
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

      <div class="head">
        <span class="total-items"></span>

        <div class="btn">
            <button class="add-btn"><svg class="plus" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>Add</button>
        </div>
      </div>

      <section class="categories">
        <div class="category">
            <img src="../../assets/snacks.png">
            <div class="category-info">
                <h2>Starters</h2>
                <span>10 items</span>
            </div>
        </div>

        <div class="category">
            <img src="../../assets/dish.png">
            <div class="category-info">
                <h2>Entrees</h2>
                <span>10 items</span>
            </div>
        </div>

        <div class="category">
            <img src="../../assets/side.png">
            <div class="category-info">
                <h2>Sides</h2>
                <span>10 items</span>
            </div>
        </div>
        
        <div class="category">
            <img src="../../assets/drink.png">
            <div class="category-info">
                <h2>Drinks</h2>
                <span>10 items</span>
            </div>
        </div>

        <div class="category">
            <img src="../../assets/dessert.png">
            <div class="category-info">
                <h2>Desserts</h2>
                <span>10 items</span>
            </div>
        </div>

      </section>




      <div class="main-container">
        <div><h1>Starters</h1></div>

        <div class="dish-container"></div>

      </div>

      <div id="notificationPopup"></div>

    </div>
    
</body>
<script src="../../arfrobite_javascript/menu.js"></script>
</html>