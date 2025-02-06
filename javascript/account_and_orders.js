getOrderDetails(user_id); 
getCurrentOrder(user_id);





    $(".edit-profile").click(function () {
        window.location.href = "edit-profile.php";
    })

    $("#my-address").click(function () {
        window.location.href = "address-screen.php";
    })
    
    $("#favorite").click(function () {
        window.location.href = "favorite.php";
    })
    
    $("#payment-info").click(function () {
        window.location.href = "payment-process.php";
    })
    
    $("#order").click(function () {
        window.location.href = "orders.php";
    })
    
 
    
    



$("#save-profile-button").on("click", (function(e){
    e.preventDefault();
    var profileImg = document.getElementById("user-image").files[0];
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var number = $("#number").val();
    var email = $("#email").val();

    
    var formData = new FormData();
    formData.append('action', 'callRequest');
    formData.append('callRequest', 'editprofile');
    formData.append('user_id', user_id);
    formData.append('profile_img', profileImg);
    formData.append('fname', fname); 
    formData.append('lname', lname);
    formData.append('number', number);
    formData.append('email', email);
    
    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            let res = JSON.parse(data);

            
            if (res == 'User profile update successful'){
                $('.registration-done').css("display", "flex")
                $("#loginbody").css("display", "none")

                $("#go").click(function () {

                    window.location.href = '../arfrobite/homepage.php'; 

                })
            }

            else if (res == 'User profile update failed'){
                console.log("User profile update failed");
            }

       
        }
    })
}))







$("#save-address-button").on("click", (function(e){
    e.preventDefault();
    var city = $("#city").val();
    var town = $("#town").val();
    var street = $("#street").val();

    
    $.ajax({
        url: '../includes/SqlDataCrud.php',
        type: 'post',
        data: { 'action': 'callRequest', callRequest: 'editaddress', 'user_id': user_id, 'city': city, 'town': town, 'street': street},
        success: function (data) {
            let res = JSON.parse(data);


            if (res == 'User address added successfully' || res == 'User address update successful'){
                window.location.href = "homepage.php";
            }

            else if (res == 'User address failed to add' || res == 'User address update failed'){
                console.log("User address failed to add");
            }

       
        }
    })
}))







async function getCurrentOrder(user_id) {


    const CartOrderRequest = new FormData();
    CartOrderRequest.append('action', 'orderRequest',);
    CartOrderRequest.append('orderRequest', 'myorder');
    CartOrderRequest.append("user_id", user_id);

    const LoadCartOrders = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: CartOrderRequest
    });

    const CartOrder = await LoadCartOrders.json();

    if (CartOrder === 'empty') {
        console.log('...................................');
    } else {

        let outputorder = '';

        for (const items of CartOrder){

            let order_id     = items.order_id;
            let item_name    = items.item_name;
            let item_pic     = items.item_pic;
            let item_quant   = items.item_quantity;
            let order_amount = items.order_amount;
            let order_status = items.order_status;
            let order_time   = items.order_time;
            let order_number = items.order_number;


            const timeOnly = getTimeFromTimestamp(order_time);

            if(order_id !== undefined && order_status == 0){

             outputorder +=   '<div class="order-profile" data-order_id = '+ order_id +'>'
             outputorder +=   '<div class="profile-row">'
             outputorder +=     '<div class="dish-img"><img src="'+ item_pic +'" alt="dish"></div>'
             outputorder +=     '<div class="dish-details">'
             outputorder +=       '<span>'+ item_quant +' items</span>'
             outputorder +=       '<b>'+ item_name +' <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10" viewBox="0 0 512 512"><path fill="#029094" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg></b>'
             outputorder +=     '</div>'
             outputorder +=   '</div>'
             outputorder +=   '<div class="track-id">'+ order_number +'</div>'
             outputorder += '</div>'
             outputorder += '<div class="track-time">'
             outputorder +=   '<div class="track-delivery-time">'
             outputorder +=     '<span>Estimated Arrival</span>'
             outputorder +=     '<span>Now</span>'
             outputorder +=   '</div>'
             outputorder +=   '<div class="track-current-time">'
             outputorder +=     '<span class="track-current-time-i"><b>'+ timeOnly +'</b></span>'
             outputorder +=     '<span>Food on the way</span>'
             outputorder +=   '</div>'
             outputorder += '</div>'
             outputorder += '<div class="track-buttons">'
             outputorder +=   '<button id="cancel-order">Cancel</button>'
             outputorder +=   '<button id="track-order">Track Order</button>'
             outputorder += '</div>'

            }

        }

        $(".track-order").html(outputorder);

        let order_id = $(".order-profile").data("order_id");

        $("#track-order").click(function () {
            window.location.href = "track-order.php?order_id=" + order_id;
        });

        $("#rate-order").click(function () {
            window.location.href = "restaurant-details.php";
        })
    
    }

}







async function getOrderDetails(user_id) {


    const CartOrderRequest = new FormData();
    CartOrderRequest.append('action', 'orderRequest',);
    CartOrderRequest.append('orderRequest', 'myorder');
    CartOrderRequest.append("user_id", user_id);

    const LoadCartOrders = await fetch('../includes/SqlDataCrud.php', {
        method: 'POST',
        body: CartOrderRequest
    });

    const CartOrder = await LoadCartOrders.json();

    if (CartOrder === 'empty') {
        console.log('...................................');
    } else {

        let outputorder = '';

        
        for (const items of CartOrder){

            let order_id     = items.order_id;
            let item_name    = items.item_name;
            let item_pic     = items.item_pic;
            let item_quant   = items.item_quantity;
            let order_status = items.order_status;
            let order_amount = items.order_amount;
            let order_time   = items.order_time;

            const timeOnly = getTimeFromTimestamp(order_time);

            if(order_id !== undefined && order_status == 1){

                outputorder += '<section class="track-order">'
                outputorder +=     '<div class="order-profile">'
                outputorder +=     '<div class="profile-row">'
                outputorder +=         '<div class="dish-img"><img src="'+ item_pic +'" alt="dish"></div>'
                outputorder +=         '<div class="dish-details">'
                outputorder +=         '<span>'+ timeOnly +' · '+ item_quant +' items</span>'
                outputorder +=         '<b>'+ item_name +' <svg xmlns="http://www.w3.org/2000/svg" height="10" width="10" viewBox="0 0 512 512"><path fill="#029094" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg></b>'
                outputorder +=         '<span style="color:#4EE476"><svg xmlns="http://www.w3.org/2000/svg" height="10" width="10" viewBox="0 0 512 512"><path fill="#4EE476" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg> Order delivered</span>'
                outputorder +=         '</div>'
                outputorder +=     '</div>'
                outputorder +=     '<div class="track-id">₵'+ order_amount +'</div>'
                outputorder +=     '</div>'
                outputorder +=     '<div class="track-buttons">'
                outputorder +=     '<button id="rate-order">Rate</button>'
                outputorder +=     '<button id="re-order">Re-Order</button>'
                outputorder +=     '</div>'
                outputorder += '</section>'
            }
        }

        $(".order-list").html(outputorder);
  
        $("#re-order").click(function () {
            window.location.href = "cart-items.php";
        })
        
    }
}


$("#logout").click(function(){
    $.ajax({
            url: '../includes/SqlDataCrud.php',
            type: 'post',
            data: { 'action': 'callRequest', callRequest: 'logout' },
            success: function (data) {
                let res = JSON.parse(data);
                
                if(res == "Logout successful") {
                    window.location.href = "../index.php";
                }

            }
        })
})

const header = document.querySelectorAll('.header-buttons button');
const trackOrder = document.querySelector('.track-order');
const orderList = document.querySelector('.order-list');

header.forEach(tab => {
    tab.addEventListener('click', function () {
        
    header.forEach(t => {
        t.classList.remove('active-tab');
    });

    this.classList.add('active-tab');

    if (this.id === 'upcoming') {
        trackOrder.style.display = 'block';
        orderList.style.display = 'none';
    } else if (this.id === 'history') {
        trackOrder.style.display = 'none';
        orderList.style.display = 'block';
    }
    });
});

