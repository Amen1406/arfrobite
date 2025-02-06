
if(user_id != ''){
//setInterval(checkUserNotifications, 10000);
}
//else if (riders_id != ''){
	getUserResOrderInfo(riders_id);
//}
//else if (res_id != ''){
	getUserAndOrderDetails(res_id);
//}

var properties = [
    'id',
	'name',
	'date',
	'price',
	'quantity',
	'total',
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
					'latitude': '11.016670',
				    'longitude': '-0.500000',
				   },
				   success: function(data) {
					let res = JSON.parse(data);


					if (typeof user_id != 'undefined' && delivery_status == 1 || delivery_status == 2) {

						outputdet += '<div class="table-row">'		
						outputdet += 	'<div class="table-data"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></div>'
						outputdet += 	'<div class="table-data">'+ user_number +'</div>'
						outputdet += 	'<div class="table-data">'+ first_name +'  '+ last_name +'</div>'
						outputdet += 	'<div class="table-data">'+ phone_number +'</div>'
						outputdet += 	'<div class="table-data">'+ res[0].name +'</div>'
						outputdet += 	'<div class="table-data">₵'+ order_amount +'</div>'
						outputdet += 	'<div class="table-data">'+ dateOnly +'</div>'
						outputdet += 	'<div class="table-data">Pending</div>'
						outputdet += '</div>'
					}
					$(".table-content").html(outputdet);

				   }
				});
			}
		}

	}
  
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