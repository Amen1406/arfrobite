<!DOCTYPE html>
<html lang="en">
<head>
     <title>Arfrobite - Edit Profile</title>
      <?php include "../includes/metatags.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup_signin.css">
</head>
<body>
   <form method="post">
     <!-- <h1><center>Edit profile</center></h1> -->
     <label class="circle-container">
      <img src="../assets/default.png" alt="Image" id="circleImage">
      <input type="file" class="file-input" id="user-image">
     </label>

     <div class="input">
        <input type="text" name="fname" id="fname" placeholder="First Name">
     </div>
     <div class="input">
        <input type="text" name="lname" id="lname" placeholder="Last Name">
     </div>
     <div class="input">
        <input type="tel" name="number" id="number" placeholder="Mobile Number">
     </div>
     <div class="input">
        <input type="email" name="email" id="email" placeholder="Email">
     </div>


     <div class="btn">
        <button type="submit" id="save-profile-button">Save</button>
     </div>
   </form>


   <div class="registration-done">
      <div class="registration-completed"><img src="../assets/completed.png" alt=""></div>

      <div class="text-content">
      <span class="text1">Your profile has been updated succesfully</span><br><br><br>

      <span class="text2">Go to the home page and see the change</span>
      </div>

      <div class="go-btn"><button id="go">Go to Home page</button></div>
   </div>
</body>


<script src="../javascript/account_and_orders.js"></script>
</html>