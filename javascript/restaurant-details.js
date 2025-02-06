  var restaurant_id = getParameterByName('restaurant_id');



getSpecificRestaurants(restaurant_id);
getRestaurantDish(restaurant_id, user_id);





async function getSpecificRestaurants(restaurant_id) {

    const RestaurantRequest = new FormData();
    RestaurantRequest.append('action', 'homeRequest',);
    RestaurantRequest.append('homeRequest', 'specificrestaurant');
    RestaurantRequest.append('restaurant_id', restaurant_id,);



    const LoadRestaurants = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: RestaurantRequest
    });

    const Restaurants = await LoadRestaurants.json();

    if (Restaurants === 'empty') {
        console.log('...................................');
    } else {

        let outputres = '';

            let res_name = Restaurants[0].restaurant_name;
            let res_pic = Restaurants[0].restaurant_picture;
            let location = Restaurants[0].location;

                    var img = $("<img />");
            img.attr("src", res_pic)
            $('.restaurant-image').html(img)


            outputres +=    '<div class="name-rating">'
            outputres +=    '<span>'+ res_name +'</span><br>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffffff" d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffffff" d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffffff" d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffffff" d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffffff" d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'
            outputres +=       ' <!-- <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9" /> </svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9" /> </svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9" /> </svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9" /> </svg>'
            outputres +=    '<svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><path fill="#ffc800" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9" /> </svg> -->'
            outputres +=    '</div>' 
            outputres +=  '<div class="distance-time">'
            outputres +=    '<span class="time">20 - 30 mins delivery</span><br>'
            outputres +=    '<span class="distance"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path fill="#252525" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>'+ location +'</span>'
            outputres +=  '</div>'


        $('.details').html(outputres);


    }

}


async function getRestaurantDish(restaurant_id, user_id) {

    let dishPrice;

    const RestaurantDishRequest = new FormData();
    RestaurantDishRequest.append('action', 'homeRequest',);
    RestaurantDishRequest.append('homeRequest', 'restaurantdish');
    RestaurantDishRequest.append('restaurant_id', restaurant_id,);



    const LoadRestaurantDishes = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: RestaurantDishRequest
    });

    const RestaurantDish = await LoadRestaurantDishes.json();

    if (RestaurantDish === 'empty') {
        console.log('...................................');
    } else {

        let outputresd = '';

        for (const restaurantdish of RestaurantDish) {
            let dish_id = restaurantdish.dish_id;
            let dish_name = restaurantdish.dish_name;
            let dish_pic = restaurantdish.dish_pic;
            let dish_price = restaurantdish.dish_price;
            let description = restaurantdish.description;

            if (typeof dish_id != 'undefined') {
               outputresd += '<section class="dish" data-dish_id='+ dish_id +'>'
               outputresd += '<div class="test">'
               outputresd += '<div class="dish-image">'
               outputresd +=    '<img src="'+ dish_pic +'">'
               outputresd += '</div>'
               outputresd += '<div class="dish-details">'
               outputresd += '<span class="dish-name">'+ dish_name +'</span>'
               outputresd += '<span class="dish-amount" data-dish_price='+ dish_price +'>₵'+ dish_price +'</span>'
               outputresd += '<span class="dish-items">'+ description +'</span>'
               outputresd +=     '</div>'
               outputresd += '</div>'
               outputresd += '<div class="btn">'
               outputresd +=     '<button class="add-btn" data-dish_pic='+ dish_pic +'>Add</button>'
               outputresd +=    '<button class="buy-btn"><svg class="minus" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/></svg><span>Buy</span><svg class="plus" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg></button>'
               outputresd += '</div>'
               outputresd += '</section>'
            }
        }
        $('.restaurant-dishes').html(outputresd)
    }

  

    $(document).on("click", ".add-btn", function(){

        $(this).siblings(".buy-btn").css("display", "block");
        $(".cart-popup").css("display", "flex");
        $('body').css("padding-bottom", "130px");
        $('#homebody').css("height", "75%");
        $(this).css("display", "none");

        const dishSection = $(this).closest('.dish');
        let itemCount = 1;
        const dishId = dishSection.data('dish_id');
        let dishPrice = dishSection.find(".dish-amount").data('dish_price');
        let dishPriceStatic = dishSection.find(".dish-amount").data('dish_price');
        const dishName = dishSection.find('.dish-name').text();
        const dishPic   = $(this).data('dish_pic');

        let outputcart = '';


        function updateItemCount() {
            $(".item-count").text(itemCount + (itemCount === 1 ? ' item' : ' items'));
            $(".price_update").text('₵' + dishPrice);
        }

        function updateCartRequest() {
            $.ajax({
                url: '../includes/SqlDataCrud.php',
                type: 'post',
                data: {
                    'action': 'cartRequest',
                    cartRequest: 'update',
                    'user_id': user_id,
                    'dish_id': dishId,
                    'item': itemCount,
                    'dish_price': dishPrice
                },
                success: function (data) {
                    let res = JSON.parse(data);
                    if (res == "Item updated") {
                        console.log("Item updated");
                    } else if (res == "Item not updated") {
                        console.log("Item not updated");
                    }
                }
            });
        }

        dishSection.on("click", ".plus", function () {
            itemCount++;
            dishPrice = dishPriceStatic * itemCount;
            updateItemCount();
            updateCartRequest();
        });

        dishSection.on("click", ".minus", function () {
            if (itemCount > 1) {
                itemCount--;
                dishPrice = dishPriceStatic * itemCount;
                updateItemCount();
                updateCartRequest();
            }
        });
        
     
        outputcart += '<div class="cart-img"><img src="'+ dishPic +'" alt=""></div>'
        outputcart += '<span class="cart-name">'+ dishName +'<br> <small><i>Item has been saved to cart</i><small></span>'
        outputcart += '<button id="checkout"><span class="item-count"> '+ itemCount +' item</span>|<span class="price_update"> ₵'+ dishPrice +'</span><br> Checkout</button>'


        $('.cart-popup').html(outputcart);

        $.ajax({
            url: '../includes/SqlDataCrud.php',
            type: 'post',
            data: { 
                'action': 'cartRequest',
                cartRequest: 'save_cart',
                'restaurant_id': restaurant_id,
                'user_id': user_id,
                'dish_id'  : dishId,
                'dish_pic':  dishPic,
                'dish_name': dishName,
                'item_count': itemCount,
                'dish_price': dishPrice,
            },
            success: function (data) {
                let res = JSON.parse(data);
    
                console.log(res)
    
            }
        })
        
        $("#checkout").click(function(){
            window.location.href = "cart-items.php";
         })
    })

    

    

}