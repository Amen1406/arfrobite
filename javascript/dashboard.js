   if(user_id !== ''){
	//setInterval(checkUserNotifications, 10000);
	}
	else if (riders_id !== ''){
		getUserResOrderInfo(riders_id);
	}
	else if (res_id !== ''){
		getOrders(res_id);
        getUserAndOrderDetails(res_id );
		setInterval(checkRiderAcceptedOrder, 10000);
		setInterval(checkRiderPickUp, 10000);
	}


var properties = [
    'dish',
	'id',
	'date',
	'price',
	'quantity',
    'status'
];

$.each( properties, function( i, val ) {
	
	var orderClass = '';

	$("#" + val).click(function(e){
		e.preventDefault();
		$('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
  		$(this).toggleClass('filter__link--active');
   		$('.filter__link').removeClass('asc desc');

   		if(orderClass == 'desc' || orderClass == '') {
    			$(this).addClass('asc');
    			orderClass = 'asc';
       	} else {
       		$(this).addClass('desc');
       		orderClass = 'desc';
       	}

		var parent = $(this).closest('.header__item');
    		var index = $(".header__item").index(parent);
		var $table = $('.table-content');
		var rows = $table.find('.table-row').get();
		var isSelected = $(this).hasClass('filter__link--active');
		var isNumber = $(this).hasClass('filter__link--number');
			
		rows.sort(function(a, b){

			var x = $(a).find('.table-data').eq(index).text();
    			var y = $(b).find('.table-data').eq(index).text();
				
			if(isNumber == true) {
    					
				if(isSelected) {
					return x - y;
				} else {
					return y - x;
				}

			} else {
			
				if(isSelected) {		
					if(x < y) return -1;
					if(x > y) return 1;
					return 0;
				} else {
					if(x > y) return -1;
					if(x < y) return 1;
					return 0;
				}
			}
    		});

		$.each(rows, function(index,row) {
			$table.append(row);
		});

		return false;
	});

});



async function getOrders(res_id) {

	const OrderRequest = new FormData();
	OrderRequest.append('action', 'orderRequest',);
	OrderRequest.append('orderRequest', 'orders',);
	OrderRequest.append('restaurant_id', res_id,);

	const LoadOrders = await fetch('../../includes/SqlDataCrud.php', {
		method: 'POST',
		body: OrderRequest
	});

	const Orders = await LoadOrders.json();

	if (Orders === 'empty'){
		$('.dishes').append("No Orders yet");
		$('.table-content').html("No Orders yet");
	} else {


		let outputorder = '';
		let outputtableorder = '';
		let i = 0;
		let Total = 0;

		for (const orders of Orders) {
			let order_id  = orders.order_id;
			let item_name = orders.item_name;
			let number    = orders.order_number;
			let item_pic  = orders.item_pic;
			let quantity  = orders.order_quantity;
			let subtotal  = orders.order_subtotal;
			let total     = orders.order_amount;
			let status    = orders.delivery_status;
			let time      = orders.order_time;

			const dateOnly = getDateFromTimestamp(time);
			const timeOnly = getTimeFromTimestamp(time);


			if (order_id != 'undefined' && status == 1 || status == 2){
			outputorder += '<section class="dish">'
            outputorder += '<div class="test">'
            outputorder +=     '<div class="dish-image"><img src="'+ item_pic +'"></div>'
            outputorder +=     '<div class="dish-details">'
            outputorder +=       '<span class="dish-name">'+ item_name +'</span>'
            outputorder +=       '<span class="dish-items">'+ timeOnly +'</span>'
            outputorder +=     '</div>'
            outputorder +=   '</div>'
            outputorder +=  '<span class="dish-amount"><h1><b>₵'+ subtotal +'</b></h1></span>'
            outputorder += '</section>'


			outputtableorder +=    '<div class="table-row">'
            outputtableorder +=      '<div class="table-data">'+ item_name +'</div>'
            outputtableorder +=      '<div class="table-data">'+ number +'</div>'
            outputtableorder +=      '<div class="table-data">₵'+ total +'</div>'
            outputtableorder +=      '<div class="table-data">'+ quantity +'</div>'
            outputtableorder +=      '<div class="table-data">'+ dateOnly +'</div>'
            outputtableorder +=      '<div class="table-data">Pending</div>'
            outputtableorder +=    '</div>'

			}

			i++
		   Total += parseFloat(total); 
		}

		$('.dishes').append(outputorder);
		$('.table-content').html(outputtableorder);
		$('.revenue').html('₵' + Total);
		$('.orders').html(i);
		$('.sales').html('₵' +Total);
	}
}




async function getUserAndOrderDetails(res_id) {

	const DetailsRequest = new FormData();
	DetailsRequest.append('action', 'orderRequest',);
	DetailsRequest.append('orderRequest', 'users_order');
	DetailsRequest.append('restaurant_id', res_id ,);
  
  
	const LoadDetails = await fetch('../../includes/SqlDataCrud.php', {
	  method: 'POST',
	  body: DetailsRequest
	});
  
	const Details = await LoadDetails.json();
  
	if (Details === 'empty') {
	  console.log('...................................');
	} else {


		let outputdet = '';

		for(const details of Details) {
			let user_id        = details.user_id;
			let first_name     = details.first_name;
			let last_name      = details.last_name;
			let phone_number   = details.phone_number;
			let longitude      = details .longitude;
            let latitude       = details .latitude;
			let user_number    = details.order_id;
			let order_amount   = details.order_amount;
			let delivery_status= details.delivery_status;
			let order_time     = details.order_time;

			const dateOnly = getDateFromTimestamp(order_time);


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
				   success: function(data) {
					let res = JSON.parse(data);


					if (typeof user_id != 'undefined' && delivery_status == 1) {

					
						outputdet += 	'<div id="restaurantDetails">'
						outputdet += 	'<h2>Restaurant Details</h2>'
						outputdet += 	'<p>Restaurant Name: ABC Restaurant</p>'
						outputdet += 	'<p>Location: 123 Main Street</p>'
						outputdet += 	'<p>Contact: 123-456-7890</p>'
						outputdet +=   '</div>'
						outputdet +=   '<div id="customerInfo">'
						outputdet += 	'<h2>Current Order</h2>'
						outputdet += 	'<p>User ID: '+ user_number +'</p>'
						outputdet += 	'<p>Customer Name: '+ first_name +' '+ last_name +'</p>'
						outputdet += 	'<p>Delivery Address: '+ res[0].name +'</p>'
						outputdet += 	'<p>Contact: '+ phone_number +'</p>'
						outputdet += 	'<p>Amount: ₵'+ order_amount +'</p>'
						outputdet += 	'<p class="info-request"><i>click when order to notify rider for pick up</i></p>'
						outputdet += 	'<button id="pickupBtn">Food Ready</button>'
						outputdet += 	'<div class="order-request">'
						outputdet += 	'<h2><center>You will be notified when a Rider accepts the order</center></h2>'
						outputdet += 	'<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
						outputdet += 	'</div>'
						//outputdet += 	'<button id="customerInfoBtn" disabled>Customer Info</button>'
						outputdet += '</div>'
		
					}
					$(".deliver").append(outputdet);

								
					$('#pickupBtn').on('click', function() {
						$(this).css('display', 'none');
						$('#customerInfoBtn').prop('disabled', false);
						$('.order-request').css('display', 'block');
						$('.info-request').css('display', 'none');


						notifyRiders(user_id, res_id);
					});
					
				
					$('#customerInfoBtn').on('click', function() {
						$('#restaurantDetails').css('display', 'block');
						$('#customerInfo').css('display', 'none');
					});


				   }
				});
			}
		}


	
	}	
  
 }


 function notifyRiders(user_id, res_id) {
	let message = 'New order from restaurant has arrived'

	$.ajax({
		url: '../../includes/SqlDataCrud.php',
		type: 'post',
		data:   {
			'action': 'notifyRequest',
			notifyRequest: 'notify_riders',
			'restaurant_id': res_id,
			'user_id': user_id, 
			'message': message,
		},
		success: function (data) {
			let res = JSON.parse(data);

			if (res == 'Notification sent'){
				alert("Request has been sent to riders")
			}
			else if (res == 'Notification was not sent'){
				alert("Request has been not able to send to riders")
			}
		}
	});
 }


 
 async function getUserResOrderInfo(riders_id) {
  
    var UserOrderRequest = new FormData();
    UserOrderRequest.append('action', 'notifyRequest');
    UserOrderRequest.append('notifyRequest' , 'get_accepted_order');
    UserOrderRequest.append('rider_id', riders_id);

    var LoadUserOrderRequest = await fetch('../../includes/SqlDataCrud.php', {
        method: 'POST',
        body: UserOrderRequest,
    });

    const UserOrder = await LoadUserOrderRequest.json();

    if(UserOrder == 'empty'){
        console.log('..............')
    }
    else{
        console.log(UserOrder);
    }
}












//////////// Checking if rider has accepted order////////////////

function checkRiderAcceptedOrder() {


  const formData = new FormData();
  formData.append('action', 'notifyRequest',);
  formData.append('notifyRequest', 'check_rider',);
  formData.append('restaurant_id', res_id,);


  $.ajax({
    url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
    type: 'post',
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      let res = JSON.parse(data);

      if (res.length > 0 && res[0].status == 4) {
        getRiderDetails(res_id);
	}

  
    }

  })


}


async function getRiderDetails(res_id) {

	const DetailsRequest = new FormData();
	DetailsRequest.append('action', 'notifyRequest',);
	DetailsRequest.append('notifyRequest', 'rider_request');
	DetailsRequest.append('restaurant_id', res_id ,);
  
  
	const LoadDetails = await fetch('../../includes/SqlDataCrud.php', {
	  method: 'POST',
	  body: DetailsRequest
	});
  
	const Details = await LoadDetails.json();
  
	if (Details === 'empty') {
	  console.log('...................................');
	} else {


		let outputrid = '';

		let rider_id         = Details[0].rider_id;
		let rider_name       = Details[0].rider_name;
		let rider_email      = Details[0].rider_email;
		let rider_contact    = Details[0].rider_contact;
		let rider_longitude  = Details[0].longitude;
		let rider_latitude   = Details[0].latitude;
		let rider_number     = Details[0].rider_number
		let rider_pic        = Details[0].rider_pic;
		let status           = Details[0].status;



		if (rider_latitude !== undefined && rider_longitude !== undefined) {
			$.ajax({
				url: '../../includes/SqlDataCrud.php',
				type: 'post',
				data: {
				'action': 'orderRequest',
				orderRequest: 'get_location_name',
				'latitude': '42.50779000',
				'longitude': '1.52109000',
				},
				success: function(data) {
				let res = JSON.parse(data);


				if (typeof rider_id != 'undefined' && status == 4) {

				
					outputrid += 	'<div id="riderDetails">'
					outputrid += 	'<h2>Rider Details</h2>'
					outputrid += 	'<p>Rider ID: '+ rider_number +'</p>'
					outputrid += 	'<p>Rider Name: '+ rider_name +'</p>'
					outputrid += 	'<p>Location: '+ res[0].name +'</p>'
					outputrid += 	'<p>Contact: '+ rider_contact +'</p>'
					outputrid += 	'<p>Email: '+ rider_email +'</p>'
					outputrid +=   '</div>'
					outputrid +=   '<div id="riderDetails">'
					outputrid += 	'<h2><center>'+ rider_name +' is on his way to pick up the food</center></h2>'
					outputrid += '</div>'
	
				}
				$(".deliver").html(outputrid);


				}
			});
		}
		


	
	}	
  
 }






 function checkRiderPickUp() {


	const formData = new FormData();
	formData.append('action', 'notifyRequest',);
	formData.append('notifyRequest', 'pickup',);
	formData.append('restaurant_id', res_id,);
  
  
	$.ajax({
	  url: 'http://localhost/arfrobite/includes/SqlDataCrud.php',
	  type: 'post',
	  data: formData,
	  contentType: false,
	  processData: false,
	  success: function (data) {
		let res = JSON.parse(data);
  
  
		if (res.length > 0 && res[0].status == 5) {
			delivered(res_id);
	  }
  
	
	  }
  
	})
  
  
  }



	async function delivered(res_id) {

		const DetailsRequest = new FormData();
		DetailsRequest.append('action', 'deliveryRequest',);
		DetailsRequest.append('deliveryRequest', 'delivered');
		DetailsRequest.append('restaurant_id', res_id ,);
	
	
		const LoadDetails = await fetch('../../includes/SqlDataCrud.php', {
		method: 'POST',
		body: DetailsRequest
		});
	
		const Details = await LoadDetails.json();
	
		if (Details === 'empty') {
		console.log('...................................');
		} else {

			let outputrid = '';


			let status = Details[0].status;

			if (status == 5) {

			
				outputrid +=   '<div id="riderDetails">'
				outputrid += 	'<h2><center>Food has been sent by the rider, you will be notified if delivery is successful</center></h2>'
				outputrid += '</div>'

			}
			$(".deliver").html(outputrid);


		}


		
	
}





$('#notification').click(function(){
	window.location.href = "notification.php"
})