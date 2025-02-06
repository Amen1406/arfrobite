<!DOCTYPE html>
<html lang="en">

<head>
    <title>Arfrobite - Cart Details</title>
    <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cart.css">
</head>

<body>

    <div class="navbar">
      <?php include "panels/navbar.php"; ?>
    </div>
        <div class="sidebar">
        <?php include "panels/sidepanel.php"; ?>
        </div>

    <div id="homebody">

        <header>
            <div class="header">
                <p>Cart items</p>
                <svg xmlns="http://www.w3.org/2000/svg" height="22" width="24" viewBox="0 0 576 512">
                    <path
                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                        fill="#fff" />
                </svg>
            </div>
            <div class="ads">
                <p>17 mins to deliver: Block 8-, Narayan nagar Ghana</p>
                <span>Delivering super fast</span>
            </div>
        </header>

        <div class="cart-popup">
            <div class="cart-amount">
                <span class="amount-total"></span>
                <a href="#">view all details</a>
            </div>

            <button id="payment">Payment</button>
        </div>


        <div class="restaurant-dishes"></div>



        <div class="promo">
            <div>Promo Code</div>

            <div class="promo-btn">
                <button>Apply</button>
            </div>
        </div>

        <div class="instruction">
            <span>Add Cooking Instruction</span>
        </div>

        <div class="instruction">
            <span>Add More Items</span>
        </div>

    
        <div class="results">
            <li>
                <span>Subtotal</span>
                <span class="subtotal-amount"></span>
            </li>
            <li>
                <span>Delivery Fee</span>
                <span class="amount">$4</span>
            </li><br><br>
            <li>
                <span>Total</span>
                <b class="amount-total"></b>
            </li>
        </div>
        

        <div class="instruction">
            <span>Add Delivery Instruction</span>
        </div>


        <div class="note">
            <p>Note: Review your Address and Payment details</p>
        </div>

    </div>



    <div class="right-sidebar">
  <?php include "panels/promotions.php"; ?>
  </div> 

</body>
    <script src="../javascript/cart.js"></script>

</html>