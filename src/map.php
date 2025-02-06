<!DOCTYPE html>
<html>

<head>
    <title>Arfrobite - Map</title>
    <?php include "../includes/metatags.php"; ?>
    <meta charset='utf-8' />
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link rel="stylesheet" href="../styles/map.css">
    <script src="../javascript/map.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0px;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        .marker {
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <script src='../javascript/geocoder.js'></script>
    <div id='map'></div>

    <script>
        if(user_id != 'empty'){
            getCoordinates(user_id);
        }
        else if (riders_id != 'empty'){
            getRiderCoordinates(riders_id);
        }
        else if (res_id != 'empty'){
            //getRiderCoordinates(res_id);
        }


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
                                    // -0.253153, 5.668749
                                    longitude, latitude
                                ]
                            }
                        }
                    ]
                };

                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [-0.1969, 5.55602],
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



        async function getRiderCoordinates(riders_id) {
            const UserCoordinatesRequest = new FormData();
            UserCoordinatesRequest.append("action", "callRequest");
            UserCoordinatesRequest.append("callRequest", "get-rider-coordinates");
            UserCoordinatesRequest.append("rider_id", riders_id);

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
                    el.style.backgroundImage = 'url(\'../assets/delivery.png\')';
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

    </script>

</body>

</html>