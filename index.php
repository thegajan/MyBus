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
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&v=3"></script>
    <script type="text/javascript" src="js/d3.min.js"></script>
</head>
<nav class="navbar" id="header-nav">
    <div class="container-fluid divs">
        <div class="navbar-header">
            <a class="navbar-brand" id="header-nav-logo"> <img
                    src="images/navicon.svg" id="header-nav-navicon">
                MyBus</a>
        </div>
    </div>
    <div id="dropDown" class="divs"><img src="images/chevron-down.svg" id="arrowDown" class="arrow">
<!--        <img src="images/chevron-up.svg"-->
<!--                                                                                            id="arrowUp" class="arrow">-->
    </div>
    <div class="drop-down bubble" id="add-drop-down">
        <ul id="dropDownUl">
            <li class="borderImgBottom"><img src="images/ios-gear-outline.svg" class="dropdownImg"> Settings</li>
            <li class="borderImgBottom borderImgTop"><img src="images/ios-help-outline.svg" class="dropdownImg"> Help</li>
            <li class="borderImgTop"><img src="images/ios-information-outline.svg" class="dropdownImg"> About</li>
        </ul>
    </div>
</nav>

<body>
<!--<div id="map"></div>-->
<?php include_once "side-links.php"; ?>
<div id="map_canvas"></div>
<script src="js/map.js"></script>
</body>
</html>