
getUserProfile(user_id);
getUseraddress(user_id);
getOrderInfo();




async function getUserProfile(user_id) {


    const UserProfileRequest = new FormData();
    UserProfileRequest.append('action', 'profileRequest',);
    UserProfileRequest.append('profileRequest', 'userprofile');
    UserProfileRequest.append('user_id', user_id,);


    const LoadUserProfiles = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: UserProfileRequest
    });

    const UserProfile = await LoadUserProfiles.json();

    if (UserProfile === 'empty') {
        console.log('...................................');
    } else {

        $(".phone_number").html(UserProfile[0].phone_number + '<span><a href="edit-profile.php">Change</a></span>');
    }
}







async function getUseraddress(user_id) {


    const UserAddressRequest = new FormData();
    UserAddressRequest.append('action', 'profileRequest',);
    UserAddressRequest.append('profileRequest', 'useraddress');
    UserAddressRequest.append('user_id', user_id,);


    const LoadUserAddress = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: UserAddressRequest
    });

    const UserAddress = await LoadUserAddress.json();

    if (UserAddress === 'empty') {
        console.log('...................................');
    } else {

        $(".location-index").html(UserAddress[0].city + ', ' + UserAddress[0].town + ' - ' + UserAddress[0].street + '<span><a href="address-screen.php">Change</a></span>');
    }
}










async function getOrderInfo() {


    const OrderInfoRequest = new FormData();
    OrderInfoRequest.append('action', 'paymentRequest',);
    OrderInfoRequest.append('paymentRequest', 'orderinfo');


    const LoadOrderInfo = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: OrderInfoRequest
    });

    const OrderInfo = await LoadOrderInfo.json();

    if (OrderInfo === 'empty') {
        console.log('...................................');
    } else {



        $('.subtotal-amount').html('₵' + OrderInfo[0].order_subtotal);
        $('.amount-total').html('₵' + OrderInfo[0].order_amount);

    }
}










async function placeOrder(user_id) {


    const OrderInfoRequest = new FormData();
    OrderInfoRequest.append('action', 'paymentRequest',);
    OrderInfoRequest.append('paymentRequest', 'orderinfo');


    const LoadOrderInfo = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: OrderInfoRequest
    });

    const OrderInfo = await LoadOrderInfo.json();

    if (OrderInfo === 'empty') {
        console.log('...................................');
    } else {

        let notificationSent = false;

        for (const id of OrderInfo){
            let order_id = id.order_id;

                    
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

                    let restaurant_id = orders.restaurant_id;
                    let dish_id       = orders.dish_id
                    let item_name     = orders.item_name;
                    let item_pic      = orders.item_pic;
                    let quantity      = orders.item_quantity;

                        $.ajax({
                            url: '../includes/SqlDataCrud.php',
                            type: 'post',
                            data:   {
                                'action': 'cartRequest',
                                cartRequest: 'update_order',
                                'order_id': order_id,
                                'user_id': user_id, 
                                'dish_id': dish_id,
                                'restaurant_id': restaurant_id,
                                'item_name': item_name,
                                'item_pic': item_pic,
                                'quantity': quantity,
                            },
                            success: function (data) {
                                let res = JSON.parse(data);

                                if (res === 'Order has been updated' && !notificationSent) {
                                    
                                    getUserProfile(user_id).then(( name ) => {
                                        sendNotification(user_id, restaurant_id, name);                  
                                    });

                                    notificationSent = true;
                                }
                                else if (res === 'Order was not updated') {
                                    alert("Order was not able to place");
                                }
                            }
                        });
                    }
                }
            });


            
        }
    }
}






$("#proceed").click(function(){
    $(".payment-done").css("display", "flex")
    $(".payment-screen").css("display", "none")
    $(".navbar").css("display", "none")
    $(".sidebar").css("display", "none")
    $(".right-sidebar").css("display", "none");


    //Placing order and send details to restaurant
    placeOrder(user_id);
 
            
    //Get user location using Geolocation api
    getUserLocation();
});

$("#go").click(function(){
    window.location.href="homepage.php"
});




function sendNotification(user_id, restaurant_id, name) {

     let message = 'New order from '+ name +' has arrived'


     $.ajax({
         url: '../includes/SqlDataCrud.php',
         type: 'post',
         data:   {
             'action': 'notifyRequest',
             notifyRequest: 'notify',
             'restaurant_id': restaurant_id,
             'user_id': user_id, 
             'message': message,
         },
         success: function (data) {
             let res = JSON.parse(data);

             if (res == 'Notification sent'){
                 alert("Request has been sent to the restaurant")
             }
             else if (res == 'Notification was not sent'){
                 alert("Request has been not able to send to the restaurant")
             }
         }
     });
}