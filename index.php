<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyBus | Real-time Bus Locator</title>
    <link rel="icon" type="image/png" href="images/locate.png">
    <!--    <link rel="shortcut icon" type="image/svg" href="images/android-bus-favicon.svg"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/sidebar.css" type="text/css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css" />
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            z-index: 999;
            height: 100%;
        }
    </style>
</head>
<nav class="navbar" id="header-nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="header-nav-logo"> <img
                    src="images/navicon.svg" id="header-nav-navicon">
                MyBus</a>
        </div>
    </div>
</nav>

<body>
<div id="map"></div>
<?php include_once "side-links.php";?>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 37.7749295, lng: -122.4194155},
            zoom: 6,
            disableDefaultUI: true,
            zoomControl: true
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'You are Here.'
                });
//                infoWindow.setPosition(pos);
//                infoWindow.setContent('Your Are Here.');
                map.setCenter(pos);
                map.setZoom(17);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"
        async defer>
</script>
</body>
</html>