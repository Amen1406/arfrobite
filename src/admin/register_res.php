<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Register Restaurant</title>
   <?php include "../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arfrobite_css/signup_signin.css">
</head>

<style>

   body{
      position: relative;
      overflow-y: scroll;
      padding: -1px;
   }

   @media (min-width: 1100px) {
   form {
      height: 1000px;
   }
   }
</style>
<body>
   <div id="loginbody">
   <div class="bg-image">
    <img src="../assets/food.png" alt="">
   </div>


   <form enctype="multipart/form-data" method="post">
     <h1><center>Register Restaurant</center></h1>
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>

     <label class="circle-container">
      <img src="../assets/res.png" alt="Image" id="circleImage">
      <input type="file" name="res-pic" id="res-pic" class="file-input">
     </label>
     
     <div class="input">
        <input type="text" name="res-name" id="res-name" placeholder="Restaurant Name">
     </div>
     <div class="input">
        <input type="text" name="owner" id="owner" placeholder="Owner Name">
     </div>
     <div class="input">
        <input type="tel" name="res-number" id="res-number" placeholder="Mobile Number">
     </div>
     <div class="input">
        <input type="email" name="res-email" id="res-email" placeholder="Email">
     </div>
     <div class="input">
        <input type="text" name="workers" id="workers" placeholder="Number of workers">
     </div>
     <div class="input">
        <input type="text" name="res-type" id="res-type" placeholder="Restaurant Type">
     </div>
     <div class="input">
        <input type="text" name="work-hours" id="work-hours" placeholder="Working Hours [eg:1:00pm-2:00pm]">
     </div>
     <div class="input">
        <input type="text" name="res-location" id="res-location" placeholder="Location [City, Town]">
     </div>
     <div class="input">
         <input type="password" name="pass" id="pass" placeholder="Create Password">
         <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
      </div>


     <div class="btn">
        <button type="submit" id="register_restaurant_button">Register</button>
     </div>



   </form>
   </div>


   <div class="registration-done">
   <div class="registration-completed"><img src="../assets/completed.png" alt=""></div>

   <div class="text-content">
    <span class="text1">Your have been successfully registered as a rider</span><br><br><br>

    <span class="text2">Sit and relax while your orders is being worked on . It&apos;ll take 5min before you get it</span>
   </div>

   <div class="go-btn"><button id="go">Go back to Home page</button></div>
</body>
<script src="../arfrobite_javascript/jquery.min.js"></script>
<script src="../arfrobite_javascript/signup_signin.js"></script>
</html>