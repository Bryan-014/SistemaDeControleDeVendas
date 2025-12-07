<!DOCTYPE html>
<head>    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <script>
        L_NO_TOUCH = false;
        L_DISABLE_3D = false;
    </script>
    <style>
        html, 
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            position:absolute;
            top:0;
            bottom:0;
            right:0;
            left:0;
        }
        #map_be3890559835e2c5ba77c06bf9176cbe {
            position: relative;
            width: 100.0%;
            height: 100.0%;
            left: 0.0%;
            top: 0.0%;
        }
    </style>
    <script src="./assets/js/mapa/leaflet.min.js"></script>
    <script src="./assets/js/mapa/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/mapa/bootstrap.min.js"></script>
    <script src="./assets/js/mapa/leaflet.awesome-markers.js"></script>
    <link rel="stylesheet" href="./assets/css/mapa/leaflet.css"/>
    <link rel="stylesheet" href="./assets/css/mapa/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assets/css/mapa/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="./assets/css/mapa/font-awesome.min.css"/>
    <link rel="stylesheet" href="./assets/css/mapa/leaflet.awesome-markers.css"/>
    <link rel="stylesheet" href="./assets/css/mapa/leaflet.awesome.rotate.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body>    
    <div class="folium-map" id="map_be3890559835e2c5ba77c06bf9176cbe" ></div>     
</body>
<script src="./assets/js/jquery.min.js"></script>
<script>          

    let locationAmbulante = [<?php echo($locale['lati'].", ".$locale['longi']) ?>]

    $(document).ready(() => {
        updateLocation();
    });

    function updateLocation(){
        var map_be3890559835e2c5ba77c06bf9176cbe = L.map(
            "map_be3890559835e2c5ba77c06bf9176cbe",
            {
                center: locationAmbulante,
                crs: L.CRS.EPSG3857,
                zoom: 16,
                zoomControl: true,
                preferCanvas: false,
            }
        );
        
        if (navigator.geolocation) {    
            navigator.geolocation.getCurrentPosition(update);
            function update(position) {
        
                var marker_2ca14a778564e15c74e777f25d004483 = L.marker(
                    [position.coords.latitude, position.coords.longitude],
                    {}
                ).addTo(map_be3890559835e2c5ba77c06bf9176cbe);          
        
                var popup_e84898a5d78bc936a5dbf59a130c4b60 = L.popup({"maxWidth": "100%"});      
            
                var html_5de6fd3970b0549906e6c60161527716 = $(`<div id="html_5de6fd3970b0549906e6c60161527716" style="width: 100.0%; height: 100.0%;"><i>Você está aqui</i></div>`)[0];
                popup_e84898a5d78bc936a5dbf59a130c4b60.setContent(html_5de6fd3970b0549906e6c60161527716);     
        
                marker_2ca14a778564e15c74e777f25d004483.bindPopup(popup_e84898a5d78bc936a5dbf59a130c4b60);
            }
        }        

        var tile_layer_1e8723f12a79ad77d74788195f3af375 = L.tileLayer(
            "https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}.jpg",
            {
                "attribution": "Map tiles by \u003ca href=\"http://stamen.com\"\u003eStamen Design\u003c/a\u003e, under \u003ca href=\"http://creativecommons.org/licenses/by/3.0\"\u003eCC BY 3.0\u003c/a\u003e. Data by \u0026copy; \u003ca href=\"http://openstreetmap.org\"\u003eOpenStreetMap\u003c/a\u003e, under \u003ca href=\"http://creativecommons.org/licenses/by-sa/3.0\"\u003eCC BY SA\u003c/a\u003e.", 
                "detectRetina": false, 
                "maxNativeZoom": 18, 
                "maxZoom": 18, 
                "minZoom": 0, 
                "noWrap": false, 
                "opacity": 1, 
                "subdomains": "abc", 
                "tms": false
            }
        ).addTo(map_be3890559835e2c5ba77c06bf9176cbe); 

        var marker_47d52623005d596d15b88a2aa6285ccc = L.marker(
            locationAmbulante,
            {}
        ).addTo(map_be3890559835e2c5ba77c06bf9176cbe);

        var popup_7bbc22194f1f4e7c56ce46f5336fa9a5 = L.popup({"maxWidth": "100%"});

        var html_3ad037ca4c5190f382bb83c6d4c9d82f = $(`<div id="html_3ad037ca4c5190f382bb83c6d4c9d82f" style="width: 100.0%; height: 100.0%;"><i>Estamos Aqui</i></div>`)[0];
        popup_7bbc22194f1f4e7c56ce46f5336fa9a5.setContent(html_3ad037ca4c5190f382bb83c6d4c9d82f);  

        marker_47d52623005d596d15b88a2aa6285ccc.bindPopup(popup_7bbc22194f1f4e7c56ce46f5336fa9a5);
    }        
</script>