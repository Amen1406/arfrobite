<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Sign In</title>
   <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup_signin.css">
</head>
<body>
  <div id="loginbody">
  <div class="bg-image">
    <img src= "../assets/food.png" alt="">
   </div>


   <form method="post">
     <h1><center>Login</center></h1>
     <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>

     <div class="input">
        <input type="tel" name="number" id="number" placeholder="Phone Number">
        <span id="phone_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
     </div>
     <div class="input">
        <input type="password" name="pass" id="pass" placeholder="Password">
        <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
     </div>

     <div class="btn">
        <button type="submit" id="loginbutton">Login</button>
        <div id="loader"><div></div><div></div><div></div></div>
     </div>


     <p>Dont't have an account? <a href="signup.php">Sign up</a></p>

   </form>
  </div>

 
</body>


   <div  id="verify_account_user" style="display: none">
      <?php include "verification.php"; ?>
   </div>


<script src="../javascript/jquery.min.js"></script>
<script src="../javascript/signup_signin.js"></script>
</html>