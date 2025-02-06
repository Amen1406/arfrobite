<!DOCTYPE html>
<html lang="en">
<head>
      <title>Arfrobite - Register Rider</title>
      <?php include "../arfrobite_includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arfrobite_css/signup_signin.css">
</head>
<body>
   <div id="loginbody">
   <div class="bg-image">
    <img src="../assets/food.png" alt="">
   </div>


   <form enctype="multipart/form-data" method="post">
     <h1><center>Register Rider</center></h1>
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>


     <label class="circle-container">
      <img src="../assets/default-rider.avif" alt="Image" id="circleImage">
      <input type="file" name="rider-pic" id="rider-pic" class="file-input">
     </label>
          
     <div class="input">
        <input type="text" name="rider-name" id="rider-name" placeholder="Full Name">
     </div>
     <div class="input">
        <input type="tel" name="rider-number" id="rider-number" placeholder="Mobile Number">
     </div>
     <div class="input">
        <input type="email" name="rider-email" id="rider-email" placeholder="Email">
     </div>
     <div class="input">
        <input type="text" name="rider-location" id="rider-location" placeholder="Location [City, Town]">
     </div>
     <div class="input">
         <input type="password" name="pass" id="pass" placeholder="Create Password">
         <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
      </div>


     <div class="btn">
        <button type="submit" id="register_rider_button">Register</button>
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
</div>
</body>
<script src="../arfrobite_javascript/jquery.min.js"></script>
<script src="../arfrobite_javascript/signup_signin.js"></script>
</html>