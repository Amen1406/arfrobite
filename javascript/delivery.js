getOrderInfo(riders_id);
getRiderCoordinates(riders_id);


async function getOrderInfo(riders_id) {
  
    var UserOrderRequest = new FormData();
    UserOrderRequest.append('action', 'orderRequest');
    UserOrderRequest.append('orderRequest' , 'get_accepted_order');
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

        let outputorder = '';
        let outputdet   = '';

        //Restaurant details
        let rest_id         = UserOrder[0].restaurant_data.restaurant_id;
        let res_pic        = UserOrder[0].restaurant_data.restaurant_picture;
        let res_name       = UserOrder[0].restaurant_data.restaurant_name;
        let owner          = UserOrder[0].restaurant_data.owner;
        let hours          = UserOrder[0].restaurant_data.working_hours;
        let contact        = UserOrder[0].restaurant_data.contact;
        let email          = UserOrder[0].restaurant_data.email;
        let res_latitude   = UserOrder[0].restaurant_data.latitude;
        let res_longitude  = UserOrder[0].restaurant_data.longitude;
        let workers        = UserOrder[0].restaurant_data.number_of_workers;
        let type           = UserOrder[0].restaurant_data.restaurant_type;
        let ratings        = UserOrder[0].restaurant_data.ratings;

        //Order details
        let order_id       = UserOrder[0].order_id;
        let total          = UserOrder[0].order_amount;

        //User details
        let user_id        = UserOrder[0].user_data.user_id;
        let user_latitude  = UserOrder[0].user_data.latitude;
        let user_longitude = UserOrder[0].user_data.longitude;
        let user_pic       = UserOrder[0].user_data.profile_pic;
        let name           = UserOrder[0].user_data.first_name + ' ' + UserOrder[0].user_data.last_name;
        let user_email     = UserOrder[0].user_data.email;
        let user_number    = UserOrder[0].user_data.order_id;
        let phone_number   = UserOrder[0].user_data.phone_number;
        



        //Display Restaurant details
        if (res_latitude !== undefined && res_longitude !== undefined) {
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

                if(rest_id != undefined && order_id != undefined){

                    outputorder += '<header><h1>Restaurant Details</h1></header>'
                    outputorder +=     '<section id="restaurant-info">'
                    outputorder +=         '<div class="restaurant-image"><img src="'+ res_pic +'" alt="Restaurant Image"></div>'
                    outputorder +=         '<div class="restaurant-details">'
                    outputorder +=             '<h2>'+ res_name +' ('+ type +')</h2>'
                    outputorder +=             '<p>Owner: '+ owner +'</p>'
                    outputorder +=             '<p>Working hours: '+ hours +'</p>'
                    outputorder +=             '<p>Location: '+ res[0].name+'</p>'
                    outputorder +=             '<p>Contact: '+ contact +'</p>'
                    outputorder +=             '<p>Email: '+ email +'</p>'
                    outputorder +=             '<p>Ratings: '+ ratings +' / 5</p>'
                    outputorder +=         '</div>'
                    outputorder +=     '</section>'
                    outputorder +=     '<section class="menu">'
                    outputorder +=        ' <h2>Order</h2>'

                    for (const order of UserOrder){
                        let order_id   = order.order_id;
                        let item_name  = order.item_name;
                        let number     = order.order_number; 

                        if(order_id != undefined){
                            outputorder +=         '<div class="menu-item">'
                            outputorder +=             '<p>'+ number +'</p>'
                            outputorder +=             '<p>'+ item_name +'</p>'
                            outputorder +=         '</div>'
                        }

                    }

                    outputorder +=         '<div class="menu-item">'
                    outputorder +=             '<p>Total</p>'
                    outputorder +=             '<p>₵'+ total +'</p>'
                    outputorder +=         '</div>'
            
                    outputorder +=         '<p><i>click the button after you pick the food from the restaurant</i></p>'
                    outputorder +=         '<div>'
                    outputorder +=           '<button id="pickupBtn">Food Picked Up</button>'
                    outputorder +=           '<button id="customerInfoBtn" disabled>Customer Info</button> '
                    outputorder +=         '</div>'         
                    outputorder +=     '</section>'
                }
         
         
         
                $('.container').html(outputorder);

                $(document).ready(function() {
                    $('#pickupBtn').on('click', function() {
                        $(this).css('display', 'none');
                        $('#customerInfoBtn').prop('disabled', false);
                        foodPickedUp(rest_id);
                    });
                
                    $('#customerInfoBtn').on('click', function() {
                        $('.container').css('display', 'none');
                        $('.map-container').css('display', 'none');
                        $('.customerInfo').css('display', 'block');
                    });
                });
                
               }
            })
        }




        //Display Customer details
        if (user_latitude !== undefined && user_longitude !== undefined) {
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

                if(user_id != undefined && order_id != undefined){

                    outputdet += '<header><h1>Customer Details</h1></header>'
                    outputdet +=     '<section id="restaurant-info">'
                    outputdet +=         '<div class="user-image"><img src="'+ user_pic +'" alt="Restaurant Image"></div>'
                    outputdet +=         '<div class="restaurant-details">'
                    outputdet +=             '<h2>'+ name +'</h2>'
                    outputdet +=             '<p>User ID: '+ user_number +'</p>'
                    outputdet +=             '<p>Location: '+ res[0].name+'</p>'
                    outputdet +=             '<p>Contact: '+ phone_number +'  <i>Call</i></p>'
                    outputdet +=             '<p>Email: '+ user_email +'</p>'
                    outputdet +=         '</div>'
                    outputdet +=     '</section>'
                    outputdet +=     '<section class="menu">'
                    outputdet +=        ' <h2>Order</h2>'

                    for (const order of UserOrder){
                    let order_id   = order.order_id;
                    let item_name  = order.item_name;
                    let number     = order.order_number; 

                    if(order_id != undefined){
                        outputdet +=         '<div class="menu-item">'
                        outputdet +=             '<p>'+ number +'</p>'
                        outputdet +=             '<p>'+ item_name +'</p>'
                        outputdet +=         '</div>'
                    }

                    }

                    outputdet +=         '<div class="menu-item">'
                    outputdet +=             '<p>Total</p>'
                    outputdet +=             '<p>₵'+ total +'</p>'
                    outputdet +=         '</div>'        
                    outputdet +=         '<div><i>send the food to the customer location; call when you arrive</i></div>'  
                    outputdet +=           '<button id="arrived">Tap to Inform User</button>'      
                    outputdet +=     '</section>'
                }
                $('.customerInfo').html(outputdet);

                $(document).ready(function() {
                    $('#arrived').on('click', function() {
                        $(this).css('display', 'none');
                        RiderArrived(rest_id, user_id);
                    });
                });
                
               }
            })
        }


    }
}





function RiderArrived(rest_id, user_id) {
    $.ajax({
        url: '../../includes/SqlDataCrud.php',
        type: 'post',
        data: {
            'action': 'deliveryRequest',
            deliveryRequest: 'arrived',
            'restaurant_id': rest_id,
            'user_id':     user_id,
        }
    })
}





async function getRiderCoordinates(riders_id) {
    const UserCoordinatesRequest = new FormData();
    UserCoordinatesRequest.append("action", "callRequest");
    UserCoordinatesRequest.append("callRequest", "get-rider-coordinates");
    UserCoordinatesRequest.append("rider_id", riders_id);

    const LoadUserCoordinates = await fetch("../../includes/SqlDataCrud.php", {
        method: "POST",
        body: UserCoordinatesRequest,
    });

    const UserCoordinates = await LoadUserCoordinates.json();

    if (UserCoordinates === "empty") {
        console.log("...................................");
    } else {

        let longitude = UserCoordinates[0].longitude;
        let latitude = UserCoordinates[0].latitude;



        mapboxgl.accessToken = 'pk.eyJ1Ijoiam9ubnk2MTc3IiwiYSI6ImNscWUwaTduZDBlaGcya3BqMzcyYW5ocHgifQ.bTb89c93mRwCl_QAce_crw';


        var geojson = {
            "type": "FeatureCollection",
            "features": [
                {
                    "type": "Feature",
                    "properties": {
                        "message": "aa",
                        "iconSize": [30, 30]
                    },
                    "geometry": {
                        "type": "Point",
                        "coordinates": [
                            longitude, latitude
                        ]
                    }
                }
            ]
        };

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [longitude, latitude],
            zoom: 8
        });

        // Add geolocate control to the map.
        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true
        }));

        map.addControl(new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        }));

        // add markers to map
        geojson.features.forEach(function (marker) {
            // create a DOM element for the marker
            var el = document.createElement('div');
            el.className = 'marker';
            el.style.backgroundImage = 'url(\'../../assets/delivery.png\')';
            el.style.width = marker.properties.iconSize[0] + 'px';
            el.style.height = marker.properties.iconSize[1] + 'px';

            el.addEventListener('click', function () {
                window.alert(marker.geometry.coordinates);
            });

            // add marker to map
            new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);
        });


    }
}

$(".mapview").on("click", function () {
    window.location.href = "../../arfrobite/map.php";
});


function foodPickedUp (res_id) {
    $.ajax({
        url: '../../includes/SqlDataCrud.php',
        type: 'post',
        data: {
            'action': 'deliveryRequest',
            deliveryRequest: 'food_pickup',
            'restaurant_id': res_id,
        }
    })
}