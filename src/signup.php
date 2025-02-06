<!DOCTYPE html>
<html lang="en">

<head>
   <title>Arfrobite - Sign Up</title> 
   <?php include "../includes/metatags.php"; ?>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../styles/signup_signin.css">
</head>

<body>
   <div id="loginbody">
      <div class="bg-image">
         <img src="../assets/food.png">
      </div>


      <form method="post">
         <h1>
            <center>Sign Up</center>
         </h1>
         <span id="error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>

         <div class="input">
            <input type="text" name="fname" id="fname" placeholder="First Name">
            <span id="fname_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
         </div>
         <div class="input">
            <input type="text" name="lname" id="lname" placeholder="Last Name">
            <span id="lname_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
         </div>
         <div class="input">
            <input type="tel" name="number" id="number" placeholder="Mobile Number">
            <span id="phone_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
         </div>
         <div class="input">
            <input type="email" name="email" id="email" placeholder="Email">
            <span id="email_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
         </div>
         <div class="input">
            <input type="password" name="pass" id="pass" placeholder="Create Password">
            <span id="password_error_message" style="color: #E50914; font-size:18px; font-weight: 900;"></span>
         </div>


         <div class="btn">
            <button type="submit" id="signupbutton">Sign Up</button>
            <div id="loader"><div></div><div></div><div></div></div>
         </div>


         <p><a href="signin.php">Already have an account</a></p>

      </form>
   </div>
</body>

<div id="verify_account_user" style="display: none">
   <?php include "verification.php"; ?>
</div>




<script src="../javascript/jquery.min.js"></script>
<script src="../javascript/signup_signin.js"></script>

</html>