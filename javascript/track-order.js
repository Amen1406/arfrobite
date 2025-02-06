let order_id = getParameterByName('order_id');

getCoordinates(user_id);
getPageDetails(order_id);
trackOrder(user_id);

async function getCoordinates(user_id) {
    const UserCoordinatesRequest = new FormData();
    UserCoordinatesRequest.append("action", "callRequest");
    UserCoordinatesRequest.append("callRequest", "get-coordinates");
    UserCoordinatesRequest.append("user_id", user_id);

    const LoadUserCoordinates = await fetch("../includes/SqlDataCrud.php", {
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
            el.style.backgroundImage = 'url(\'../assets/location.svg\')';
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
    window.location.href = "map.php";
});


$("#order").on("click", function () {
    window.location.href = "cart-items.php";
});







async function getPageDetails(order_id){

    const InfoRequest = new FormData();
    InfoRequest.append("action", "orderRequest");
    InfoRequest.append("orderRequest", "get-order-info");
    InfoRequest.append("order_id", order_id);

    const LoadInfo = await fetch("../includes/SqlDataCrud.php", {
        method: "POST",
        body: InfoRequest,
    });

    const res = await LoadInfo.json();

    if (res === "empty") {
        console.log("...................................");
    } else {

        let outputdish  = '';
        let outputprice = '';

        let longitude  = res[0].user_data.longitude;
        let latitude   = res[0].user_data.latitude;
        let dish_name  = res[0].dish_data.dish_name;
        let desc       = res[0].dish_data.description;
        let dish_price = res[0].dish_data.dish_price;
        let quant      = res[0].order_quantity;
        let number     = res[0].user_data.phone_number;
        let subtotal   = res[0].order_subtotal;
        let total      = res[0].order_amount;

        $('.res_name').html(res[0].restaurant_data.restaurant_name);


        if (latitude !== undefined && longitude !== undefined) {
            $.ajax({
               url: '../includes/SqlDataCrud.php',
               type: 'post',
               data: {
                'action': 'orderRequest',
                orderRequest: 'get_location_name',
				'latitude': '42.50779000',
				'longitude': '1.52109000',
               },
               success: function(data) {
                let res = JSON.parse(data);

                $('.user_address').html(res[0].name);

               }
            });
        }



        outputdish +=    '<header><h3>Order Summary</h3></header>'
        outputdish +=    '<li><h3>'+ dish_name +'   -  '+ quant +' items</h3></li>'
        outputdish +=    '<li>'
        outputdish +=    '<span>'+ desc +'</span>'
        outputdish +=    '<span class="amount">₵'+ dish_price +'</span>'
        outputdish +=    '</li>'

        $('.dish').html(outputdish);


        outputprice +=    '<header><h3>Payment Method</h3></header>'
        outputprice +=    '<li>'  
        outputprice +=        '<span>MTN momo</span>'
        outputprice +=        '<span class="amount">'+ number +'</span>'
        outputprice +=    '</li>'
        outputprice +=    '<li>'
        outputprice +=        '<span>Subtotal</span>'
        outputprice +=        '<span class="amount">₵'+ subtotal +'</span>'
        outputprice +=    '</li>'
        outputprice +=    '<li>'
        outputprice +=        '<span>Delivery Fee</span>'
        outputprice +=        '<span class="amount">₵4</span>'
        outputprice +=    '</li><br>'
        outputprice +=    '<li>'
        outputprice +=        '<span>Total</span>'
        outputprice +=        '<b class="amount-total">₵'+ total +'</b>'
        outputprice +=    '</li>'

        $('.results').html(outputprice);
    }
}



async function trackOrder(user_id){

    const TrackOrderRequest = new FormData();
    TrackOrderRequest.append("action", "notifyRequest");
    TrackOrderRequest.append("notifyRequest", "track-order");
    TrackOrderRequest.append("user_id", user_id);

    const LoadTrackOrder = await fetch("../includes/SqlDataCrud.php", {
        method: "POST",
        body: TrackOrderRequest,
    });

    const TrackOrder = await LoadTrackOrder.json();

    if (TrackOrder === "empty") {
        console.log("...................................");
    } else {
        console.log(TrackOrder);
    }

}



// $('#btn').click(function(){
//     $('#conf').removeClass('progtrckr-todo')
//     $('#conf').addClass('progtrckr-done')
// })