var restaurant_id = getParameterByName('restaurant_id');

getUserCartList(user_id);


async function getUserCartList(user_id) {
    let subtotal   = 0;
    let totalAmount = 0;
    let outputcart = '';

    const cartRequest = new FormData();
    cartRequest.append('action', 'cartRequest',);
    cartRequest.append('cartRequest', 'cartList');
    cartRequest.append('user_id', user_id,);



    const LoadUserCart = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: cartRequest
    });

    const Carts = await LoadUserCart.json();

    if (Carts === 'empty') {
        console.log('...................................');
    } else {


        for ( const cartList of Carts){
            let cart_id = cartList.cart_id;
            let dish_id = cartList.dish_id
            let item_name = cartList.item_name;
            let item_pic  = cartList.item_pic;
            let item_price = cartList.item_price;
            let item_quant = cartList.item_quantity;

            if(typeof cart_id != 'undefined'){
              outputcart +=  '<section class="dish" data-dish_id='+ dish_id +' data-cart_id='+ cart_id + '>'
              outputcart += '<div class="test">'
              outputcart +=  '<div class="dish-image">'
              outputcart +=      '<img src='+ item_pic +' alt="">'
              outputcart +=  '</div>'
              outputcart +=  '<div class="dish-details">'
              outputcart +=      '<span class="dish-name">'+ item_name +'</span>'
              outputcart +=      '<span class="dish-amount" data-dish_price=' + item_price + '>₵'+ item_price +'</span>'
              outputcart +=  '</div>'
              outputcart += '</div>'
              outputcart +=  '<div class="btn">'
              outputcart +=      '<button id="buy-btn">'
              outputcart +=          '<svg class="minus" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#E5091480" d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" /></svg>'
              outputcart +=          '<span class="item-count">'+ item_quant +'</span>'
              outputcart +=          '<svg class="plus" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#fff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" /></svg>'
              outputcart +=         '</button>'
              outputcart +=      '<svg class="delete" xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path fill="#ffffff" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>'
              outputcart +=  '</div>'
              outputcart += '</section>'
            }


            subtotal += item_price * item_quant;
        }

    
    }
    totalAmount += 4 + subtotal;
    $('.restaurant-dishes').html(outputcart);
    $('.subtotal-amount').html('₵' + subtotal);
    $('.amount-total').html('₵' + totalAmount);




    let cartId = $('.dish').data('cart_id');
    let dishId = $('.dish').data('dish_id');

    $(".delete").click(function(){

        $.ajax({
            url: '../includes/SqlDataCrud.php',
            type: 'post',
            data: { 
                'action': 'cartRequest',
                cartRequest: 'deletecart',
                'cart_id': cartId,
            },
            success: function (data) {
                let res = JSON.parse(data);
    

                if (res == 'Item deleted'){
                    window.location.reload();
                }
    
            }
        })

    })

    

    $(document).on("click", ".plus", function () {
        let dishContainer = $(this).closest('.dish'); 
         itemCount = parseInt(dishContainer.find(".item-count").text()); 
        let dishPriceStatic = parseFloat(dishContainer.find(".dish-amount").data('dish_price'));
    
        itemCount++;
        let dishPrice = itemCount * dishPriceStatic;
        subtotal += dishPriceStatic;
        totalAmount = 4 + subtotal;
    
        updateItemCount(dishContainer, itemCount, dishPrice);
        updateCartRequest(dishContainer, itemCount, dishPrice);
    });
    
    $(document).on("click", ".minus", function () {
        let dishContainer = $(this).closest('.dish');
        let itemCount = parseInt(dishContainer.find(".item-count").text());
        let dishPriceStatic = parseFloat(dishContainer.find(".dish-amount").data('dish_price'));
    
        if (itemCount > 1) {
            itemCount--;
            let dishPrice = dishPriceStatic * itemCount;
            subtotal -= dishPriceStatic;
            totalAmount = 4 + subtotal;
    
            updateItemCount(dishContainer, itemCount, dishPrice);
            updateCartRequest(dishContainer, itemCount, dishPrice);
        }
    });
    
    function updateItemCount(dishContainer, itemCount, dishPrice) {
        dishContainer.find(".item-count").text(itemCount);
        dishContainer.find(".dish-amount").text('₵' + dishPrice);
        $('.subtotal-amount').html('₵' + subtotal);
        $('.amount-total').html('₵' + totalAmount);

    }

    
    function updateCartRequest(dishContainer, itemCount, dishPrice) {
        let cartId = dishContainer.data('cart_id');
    
        $.ajax({
            url: '../includes/SqlDataCrud.php',
            type: 'post',
            data: {
                'action': 'cartRequest',
                cartRequest: 'updatecart',
                'user_id': user_id,
                'cart_id': cartId,
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





        $("#payment").click(function(){

            $.ajax({
                url: '../includes/SqlDataCrud.php',
                type: 'post',
                data: {
                    'action': 'cartRequest',
                    cartRequest: 'get_cart_details',
                },
                success: function (data) {
                    let res = JSON.parse(data);
        
                    for (const orders of res) {
        
                       let cart_id   = orders.cart_id;
        
                        $.ajax({
                            url: '../includes/SqlDataCrud.php',
                            type: 'post',
                            data:   {
                                'action': 'cartRequest',
                                cartRequest: 'save_order',
                                'cart_id': cart_id,
                                'subtotal': subtotal,
                                'total_amount': totalAmount
                            },
                            success: function (data) {
                                let res = JSON.parse(data);
                            }
                        });
                    }
                }
            });
            window.location.href="payment.php";

        });
    
    


 



}

