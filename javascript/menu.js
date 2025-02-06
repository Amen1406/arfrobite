getDishes(res_id)

$('.add-btn').click(function(){
    window.location.href = "add-dishes.php"
})




async function getDishes(res_id) {
  
  const DishesRequest = new FormData();
  DishesRequest.append('action', 'resRequest',);
  DishesRequest.append('resRequest', 'dishes');
  DishesRequest.append('restaurant_id', res_id ,);


  const LoadDishes = await fetch('../../includes/SqlDataCrud.php', {
    method: 'POST',
    body: DishesRequest
  });

  const Dishes = await LoadDishes.json();

  if (Dishes === 'empty') {
    console.log('...................................');
  } else {

    let outputdish = '';
    let i = 0;

    for (const dishes of Dishes) {
        let dish_id = dishes.dish_id;
        let dish_name = dishes.dish_name;
        let dish_pic  = dishes.dish_pic;
        let dish_price = dishes.dish_price;
        let description = dishes.description;

        if (dish_id != 'undefined'){
          outputdish += '<div class="dish" data-dish_id='+ dish_id +'>'
          outputdish += '<div class="menu-icons"><div><svg class="delete" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#ffffff" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></div> <div><svg class="edit" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#fafcff" d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></div></div>'
          outputdish += '<img src="'+ dish_pic +'">'
          outputdish += '<div class="info">'
          outputdish +=     '<span class="dish-name">'+ dish_name +'</span>'
          outputdish +=     '<span class="dish-price">₵'+ dish_price +'</span>'
          outputdish += '</div>'
          outputdish += '<div class="desc">'+ description +'</div>'
          outputdish += '</div>'
        }
        i++;
    }

   $(".dish-container").html(outputdish);
   $(".total-items").html("Total Items - " + i);
  }



  $('.delete').click(function(){

    let parentDish = $(this).closest('.dish');
    let dishId = parentDish.data('dish_id');

    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: {
        'action': 'resRequest',
        resRequest: 'delete',
        'dish_id': dishId,
      },
      success: function (data) {
        let res = JSON.parse(data);


        if (res == 'Item deleted'){
            window.location.reload();
        }
        else if (res == 'Item not deleted'){
            console.log("Item not delted");
        }

    }
    })
  })




  $('.edit').click(function() {

    let parentDish = $(this).closest('.dish');
    let dishId = parentDish.data('dish_id');

    window.location.href = "edit_dish.php?dish_id=" + dishId;
  })






  $('#edit_dish_button').click(function(e){
    e.preventDefault();

    let parentDish = $(this).closest('.dish');
    let dishId = parentDish.data('dish_id');
    var dish_name = $('#dish-name').val();
    var dish_pic = document.getElementById('dish-pic').files[0];
    var price = $('#price').val();
    var description = $('#description').val();

    if (!dish_pic) {
      $('#error_message').show();
      $('#error_message').html('Please select a file.');
      return;
    }

    var formData = new FormData();
    formData.append('action', 'resRequest');
    formData.append('resRequest', 'edit');
    formData.append('dish_id', dishId );
    formData.append('dish_name', dish_name);
    formData.append('dish_pic', dish_pic); 
    formData.append('price', price);
    formData.append('description', description);

    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        let res = JSON.parse(data);

        if (res == "Item edited") {
          $('.registration-done').css("display", "flex")
          $("#loginbody").css("display", "none")

          $("#go").click(function () {

              window.location.href = 'menu.php'; 

          })
        }
        else if (res == "Item could not update") {
          $('#error_message').show();
          $('#error_message').html('Dish could\'nt be updated please try again');
        }
      }
    })
  })
}
