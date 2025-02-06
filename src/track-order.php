<!DOCTYPE html>
<html lang="en">
<head>
    <title>Arfrobite - Track Order</title>
    <?php include "../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arfrobite_css/track-order.css">
    <link rel="stylesheet" href="../arfrobite_css/map.css">
    <script src="../arfrobite_javascript/map.js"></script>
</head>
<body>
 <header><h1><center class="res_name"></center></h1></header> 

 <section class="track-header">
   <span>Out for delivery ...</span>
   <div><svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#FCA892" d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg> 10 mins</div>
   <small>Your order is out on delivery. Monitor delivery on map</small>
 </section>



    <ol class="progtrckr" data-progtrckr-steps="5">
        <li class="progtrckr-todo" id="conf">Confirmation</li><!--
        --><li class="progtrckr-todo" id="prep">Preparing</li><!--
        --><li class="progtrckr-todo" id="disp">Dispatched</li><!--
        --><li class="progtrckr-todo" id="del">Delivered</li>
    </ol>


    <div class="mapview">
    <script src='../arfrobite_javascript/geocoder.js'></script>
    <div id='map'></div>
    </div>

    <div class="delivery_address">
        <h3>Delivery Address</h3>
        <p class="user_address"></p>
    </div>

 
    <div class="dish"></div>


    <div class="results"></div>
    

    <div class="order-btn">
        <button id="order">Order again</button>
    </div>
    <script src="../arfrobite_javascript/track-order.js"></script>
</body>
</html>