<?php

if (isset($_COOKIE['rider_id'])) {

    header("Location: dashboard/dashboard.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arfrobite_css/signup_signin.css">
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
        <input type="tel" name="number" id="number" placeholder="Rider Number">
        <span id="phone_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
     </div>
     <div class="input">
        <input type="password" name="pass" id="pass" placeholder="Password">
        <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
     </div>

     <div class="btn">
        <button type="submit" id="rider_loginbutton">Login</button>
        <div id="loader"><div></div><div></div><div></div></div>
     </div>


     <p style="text-align: center;">Don't have an account? <br>Contact <b>0599012917</b> to register</p>

   </form>
  </div>

 
</body>




<script src="../arfrobite_javascript/jquery.min.js"></script>
<script src="../arfrobite_javascript/signup_signin.js"></script>
</html>