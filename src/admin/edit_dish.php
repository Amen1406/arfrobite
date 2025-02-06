<!DOCTYPE html>
<html lang="en">
<head>
   <title>Arfrobite - Edit Dish</title>
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
     <h1><center>Edit Dish</center></h1>
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
        <button type="submit" id="edit_dish_button">Save</button>
     </div>



   </form>
   </div>

   <div class="registration-done">
      <div class="registration-completed"><img src="../../assets/completed.png"></div>

      <div class="text-content">
      <span class="text1">Your restaurant and dish have been succesfully saved</span><br><br><br>

      <span class="text2">Go to the menu page and check if your dish has been Edited</span>
      </div>

      <div class="go-btn"><button id="go">Go to Menu page</button></div>
   </div>
</body>
<script src="../../arfrobite_javascript/menu.js"></script>
<script>
    let dish_id = getParameterByName('dish_id');
    
    if (dish_id != '') {

        $.ajax({
            url: '../../arfrobite_includes/SqlDataCrud.php',
            type: 'post',
            data: {
                'action': 'resRequest',
                resRequest: 'edit-page',
                'dish_id': dish_id,
                'restaurant_id': res_id,
            },
            success: function (data) {
                let res = JSON.parse(data);

                $("#dish_pic").val(res[0].dish_pic);
                $('#dish-name').val(res[0].dish_name);
                $('#price').val(res[0].dish_price);
                $('#description').val(res[0].description);

            }
        })
    }
</script>
</html>