<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Address</title>
   <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup_signin.css">
</head>
<body>

   <form method="post">
     <h1><center>Add New Address</center></h1>
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>

     <div class="input">
        <input type="text" name="city" id="city" placeholder="City">
     </div>
     <div class="input">
        <input type="text" name="town" id="town" placeholder="Town">
     </div>
     <div class="input">
        <input type="text" name="street" id="street" placeholder="Street [include house number]">
     </div>


     <div class="btn">
        <button type="submit" id="save-address-button">Save</button>
     </div>
   </form>
</body>



<script src="../javascript/account_and_orders.js"></script>
</html>