Notifications(res_id);
ReadNotifications(res_id);
RiderNotifications(riders_id);



async function Notifications(res_id) {

  const NotificationsRequest = new FormData();
  NotificationsRequest.append('action', 'notifyRequest',);
  NotificationsRequest.append('notifyRequest', 'notification',);
  NotificationsRequest.append('restaurant_id', res_id,);

  const LoadNotifications = await fetch('../../includes/SqlDataCrud.php', {
    method: 'POST',
    body: NotificationsRequest,
  });

  const Notifications = await LoadNotifications.json();

  if (Notifications === 'empty') {
    console.log('...................................');
  } else {

    let outputnot = '';

    for (const notification of Notifications) {
      let notification_id = notification.notifications_id;
      let message = notification.message;
      let time = notification.time;

      const timeOnly = getTimeFromTimestamp(time)

      if (notification_id != 'undefined') {

        outputnot += '<div class="notification" data-notification_id = '+ notification_id +'>'
        outputnot += '<div class="notification-content">'
        outputnot += '<div class="notification-message">' + message + ' <span class="order-details"><a>View Order Details</a></span></div>'
        outputnot += '<div class="notification-timestamp">' + timeOnly + '</div>'
        outputnot += '</div>'
        outputnot += '<div class="notification-icon">&#x1F35D;</div>'
        outputnot += '</div>'

      }
    }

    $(".notification-container").html(outputnot);
  }



  $(".order-details a").click(function () {
    let notification_id = $(this).closest(".notification").data("notification_id");

    $(".notification-container").css("display", "none");
    $(".read-notification-container").css("display", "none");
    $("#order-details").css("display", "block");

    getUserAndOrderDetails(res_id, notification_id)

  })
}






async function ReadNotifications(res_id) {

  const NotificationsRequest = new FormData();
  NotificationsRequest.append('action', 'notifyRequest',);
  NotificationsRequest.append('notifyRequest', 'read_notification',);
  NotificationsRequest.append('restaurant_id', res_id,);

  const LoadNotifications = await fetch('../../includes/SqlDataCrud.php', {
    method: 'POST',
    body: NotificationsRequest,
  });

  const Notifications = await LoadNotifications.json();

  if (Notifications === 'empty') {
    console.log('...................................');
  } else {

    let outputnot = '';

    for (const notification of Notifications) {
      let notification_id = notification.notification_id;
      let message = notification.message;
      let time = notification.time;

      const timeOnly = getTimeFromTimestamp(time)

      if (notification_id != 'undefined') {

        outputnot += '<div class="notification">'
        outputnot += '<div class="notification-content">'
        outputnot += '<div class="notification-message">' + message + '</div>'
        outputnot += '<div class="notification-timestamp">' + timeOnly + '</div>'
        outputnot += '</div>'
        outputnot += '<div class="notification-icon">&#x1F35D;</div>'
        outputnot += '</div>'

      }
    }

    $(".read-notification-container").html(outputnot);
  }

}






async function getUserAndOrderDetails(res_id, notification_id) {

  const DetailsRequest = new FormData();
  DetailsRequest.append('action', 'orderRequest',);
  DetailsRequest.append('orderRequest', 'user_order_details');
  DetailsRequest.append('restaurant_id', res_id,);


  const LoadDetails = await fetch('../../includes/SqlDataCrud.php', {
    method: 'POST',
    body: DetailsRequest
  });

  const Details = await LoadDetails.json();

  if (Details === 'empty') {
    console.log('...................................');
  } else {



    let outputdet = '';
    const details = Details;


    let user_id = details[0].user_data.user_id;
    let first_name = details[0].user_data.first_name;
    let last_name = details[0].user_data.last_name;
    let phone_number = details[0].user_data.phone_number;
    let longitude = details[0].user_data.longitude;
    let latitude = details[0].user_data.latitude;
    let user_number = details[0].user_data.order_id;
    let order_amount = details[0].order_amount;
    let delivery_status = details.delivery_status;
    let order_time = details.order_time;


    if (latitude !== undefined && longitude !== undefined) {
      $.ajax({
        url: '../../includes/SqlDataCrud.php',
        type: 'post',
        data: {
          'action': 'orderRequest',
          orderRequest: 'get_location_name',
          'latitude': '42.50779000',
          'longitude': '1.52109000',
        },
        success: function (data) {
          let res = JSON.parse(data);

          if (user_id != 'undefined') {
            outputdet += '<div id="orderDetails">';
            outputdet += '<h2>Order Details</h2>';
            outputdet += '<p><strong>User ID:</strong> ' + user_number + '</p>';
            outputdet += '<p><strong>Customer Name:</strong> ' + first_name + ' ' + last_name + '</p>';
            outputdet += '<p><strong>Delivery Address:</strong> ' + res[0].name + '</p>';
            outputdet += '<p><strong>Items:</strong></p>';
            outputdet += '<ul>';

            for (const item of Details) {
              outputdet += '<li>' + item.order_number + ' - ' + item.item_name + '</li>';
            }

            outputdet += '</ul>';
            outputdet += '<p><strong>Total Amount:</strong> ₵' + order_amount + '</p>';
            outputdet += '</div>';
            outputdet += '<div id="buttons"><button class="acceptBtn">Accept</button><button class="declineBtn">Decline</button></div>';
          }

          $("#order-details").html(outputdet);


          $('.acceptBtn').on('click', function () {
            showPopup('Order Accepted. Go to dashboard and notify riders if food is ready');
            for (const stat of Details) {
              let cart_id = stat.cart_id;
              let dish_id = stat.dish_id;
      
              changeOrderStatus(user_id, res_id, cart_id, dish_id);
              changeNotificationReadStatus(notification_id);
            }
          });
      
          $('.declineBtn').on('click', function () {
            showPopup('Order Rejected');
          });

             

        }
      });
    }




  

  }




}




   // Function to display a popup with animation
   function showPopup(message) {
    let popup = $('<div class="popup">' + message + '</div>');

    $('body').append(popup);

    popup.animate({
      opacity: 1
    }, 300);

    setTimeout(function () {
      popup.animate({
        opacity: 0
      }, 300, function () {
        popup.remove();
      });
    }, 2000);
  }





  //change delivery status so it can display it on order details on the screen
  function changeOrderStatus(user_id, res_id, cart_id, dish_id) {
    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: {
        'action': 'orderRequest',
        orderRequest: 'order_status',
        'restaurant_id': res_id,
        'dish_id': dish_id,
        'user_id': user_id,
        'cart_id': cart_id,
      },
    })
  }



  function changeNotificationReadStatus(notification_id) {


    const formData = new FormData();
    formData.append('action', 'notifyRequest',);
    formData.append('notifyRequest', 'read_status',);
    formData.append('notification_id', notification_id,);
  
  
    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
    })
  
  
  }
  

  async function RiderNotifications(riders_id) {

    const NotificationsRequest = new FormData();
    NotificationsRequest.append('action', 'notifyRequest',);
    NotificationsRequest.append('notifyRequest', 'rider_notification',);
    NotificationsRequest.append('rider_id', riders_id,);
  
    const LoadNotifications = await fetch('../../includes/SqlDataCrud.php', {
      method: 'POST',
      body: NotificationsRequest,
    });
  
    const Notifications = await LoadNotifications.json();
  
    if (Notifications === 'empty') {
      console.log('...................................');
    } else {
      
      
      let outputnot = '';

      for (const notification of Notifications) {
        let notification_id = notification.notifications_id;
        let message = notification.message;
        let time = notification.time;

        const timeOnly = getTimeFromTimestamp(time)

        if (notification_id != 'undefined') {

          outputnot +=   '<div class="notification" data-notification_id = '+ notification_id +'>'
          outputnot +=   '<div class="notification-content">'
          outputnot +=     '<div class="notification-message">'+ message +'</div>'
          outputnot +=     '<div class="notification-timestamp">'+ timeOnly +'</div>'
          outputnot +=   '</div>'
          outputnot +=   '<div class="notification-buttons">'
          outputnot +=     '<button class="accept-btn">Accept</button>'
          outputnot +=     '<button class="decline-btn">Decline</button>'
          outputnot +=   '</div>'
          outputnot +=   '<div style="color: #4CAF50; display: none;" class="accepted"><i>order accepted </i><a href="delivery.php">delivery management</a></div>'
          outputnot +=   '<div class="notification-icon">&#x1F35D;</div>'
          outputnot += '</div>'

        }
      }
      $(".rider-notification-container").html(outputnot);

        
    
    }





    $('.accept-btn').on('click', function () {
      let notification_id = $(this).closest(".notification").data("notification_id");

      getRiderLocation();
    
      $('#popupText').text('Order Accepted! Go to Delivery Management to process the order.');
      $('#popupMessage').css('display', 'block');
    
      const clickedRow = $(this).closest('.notification-buttons');
      clickedRow.animate({ opacity: 0 }, 1000, function () {
        clickedRow.css('display', 'none');
        $('.accepted').css('display', 'block');
        orderAccepted(riders_id, notification_id);
        changeDeliveryStatus();
      });
    
      setTimeout(function () {
        $('#popupMessage').css('display', 'none');
      }, 4000);
    });
    
    
    $('.decline-btn').on('click', function () {
    
      $('#popupText').text('Order Declined. The order has been removed.');
      $('#popupMessage').css('display', 'block');
    
      const clickedRow = $(this).closest('.notification');
      clickedRow.animate({ opacity: 0 }, 1000, function () {
        clickedRow.css('display', 'none');
      });
    
      setTimeout(function () {
        $('#popupMessage').css('display', 'none');
      }, 4000);
    });
  }



  function orderAccepted(rider_id, notification_id) {
    let message = "Rider Uncle Mus is on his way to pick the order";
    
    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: {
        'action': 'notifyRequest',
        notifyRequest: 'rider_order',
        'rider_id': rider_id,
        'notification_id': notification_id,
        'message': message,
      },
    });
  }




  function changeDeliveryStatus() {
    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: {
        'action': 'orderRequest',
        orderRequest: 'user_order_details',
        'restaurant_id': res_id,
      },
      success: function(data) {
        let res = JSON.parse(data);

        for (const stat of res) {
          let user_id = stat.user_data.user_id;
          let cart_id = stat.cart_id;
          let dish_id = stat.dish_id;
  
          changeOrderDeliveryStatus(user_id, res_id, cart_id, dish_id);
        }
      }
    });
  }


  function changeOrderDeliveryStatus(user_id, res_id, cart_id, dish_id) {
    $.ajax({
      url: '../../includes/SqlDataCrud.php',
      type: 'post',
      data: {
        'action': 'orderRequest',
        orderRequest: 'dev_status',
        'restaurant_id': res_id,
        'dish_id': dish_id,
        'user_id': user_id,
        'cart_id': cart_id,
      },
    })
  }