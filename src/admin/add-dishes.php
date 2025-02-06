<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Add Dish</title>
   <?php include "../../arfrobite_includes/metatags.php"; ?>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../arfrobite_css/signup_signin.css">
   </head>
<body>
   <div id="loginbody">
   <div class="bg-image">
    <img src="../../assets/food.png" alt="">
   </div>


   <form enctype="multipart/form-data" method="post">
     <h1><center>Add Dish</center></h1>
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>

     <label class="circle-container">
      <img src="../../assets/default-dish.png" alt="Image" id="circleImage">
      <input type="file" name="dish-pic" id="dish-pic" class="file-input">
     </label>
     
     <div class="input">
        <input type="text" name="dish-name" id="dish-name" placeholder="Dish Name">
     </div>
     <div class="input">
        <input type="number" name="price" id="price" placeholder="Price">
     </div>
     <div class="input">
        <input type="text" name="description" id="description" placeholder="Description">
     </div>


     <div class="btn">
        <button type="submit" id="register_dish_button">Register</button>
     </div>



   </form>
   </div>

   <div class="registration-done">
      <div class="registration-completed"><img src="../../assets/completed.png"></div>

      <div class="text-content">
      <span class="text1">Your restaurant and dish have been succesfully registered</span><br><br><br>

      <span class="text2">Go to the menu page and check if your dish has been added</span>
      </div>

      <div class="go-btn"><button id="go">Go to Menu page</button></div>
   </div>
</body>
<script src="../../arfrobite_javascript/signup_signin.js"></script>
</html>