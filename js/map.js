//var markers = [
//  [22, 37.322743,-122.047731],
//	[34, -34.028249, 151.157507],
// 	[64, 37.350531,-121.871963],
// 	[50, 48.8566140,2.3522220],
//	[152, 38.7755940,-9.1353670],
//  [12, 12.0733335, 52.8234367],
//];
//var markers =[];
var ln = "../images/android-locate.svg";
ln = '../images/ios-circle-filled.svg';
var map = new google.maps.Map(document.getElementById('map_canvas'), {
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
            title: 'You are Here.',
            icon: ln
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
var bounds = new google.maps.LatLngBounds();
map.fitBounds(bounds);

var lon = [];
function addBusToList(busId) {
    lon.push(busId);
    //$('#buses').find('div').each(function () {
    //    var innerDivId = $(this).attr('id');
    //    if (innerDivId == 'noBus') {
    //        //continue;
    //        //lon = [];
    //    } else {
    //        lon.push(innerDivId);
    //    }
    //});


    if (lon.length > 0) {

        (function worker() {
            $.ajax({
                type: "POST",
                async: false,
                url: 'http://mybus.readmybluebutton.com/longLat.php',
//                            data: form_data,
                data: {lines: lon},
                //dataType: "json",
                success: function (response) {
                    if (response == "error") {
                        alert('Unable to Get Bus Data. Please Try Again later.');
                        console.log(error);

                    }
                    console.log(response);
                    //(JSON).parse(response);
                    bob = response;
                    //var bob = response;
                    //window.json = response;
                },
                error: function (xhr, status, error) {
                    alert('Unable to Get Bus Data. Please Try Again later.');
                    console.log(error);
                    //}});
                },
                complete: function () {
                    // Schedule the next request when the current one's complete
                    setTimeout(worker, 15000);
                }
            })
        })();
        var markers = JSON.parse(bob);
////function initMap() {
//        var map = new google.maps.Map(document.getElementById('map_canvas'), {
//            center: {lat: 37.7749295, lng: -122.4194155},
//            zoom: 6,
//            disableDefaultUI: true,
//            zoomControl: true
//        });
//        var infoWindow = new google.maps.InfoWindow({map: map});

// Try HTML5 geolocation.
//        if (navigator.geolocation) {
//            navigator.geolocation.getCurrentPosition(function (position) {
//                var pos = {
//                    lat: position.coords.latitude,
//                    lng: position.coords.longitude
//                };
//                var marker = new google.maps.Marker({
//                    position: pos,
//                    map: map,
//                    title: 'You are Here.'
//                });
////                infoWindow.setPosition(pos);
////                infoWindow.setContent('Your Are Here.');
//                map.setCenter(pos);
//                map.setZoom(17);
//            }, function () {
//                handleLocationError(true, infoWindow, map.getCenter());
//            });
//        } else {
//            // Browser doesn't support Geolocation
//            handleLocationError(false, infoWindow, map.getCenter());
//        }
//        var bounds = new google.maps.LatLngBounds();

//}
//initMap();


        var generateIconCache = {};

        function generateIcon(number, callback) {
            if (generateIconCache[number] !== undefined) {
                callback(generateIconCache[number]);
            }

            var fontSize = 16,
                imageWidth = imageHeight = 35;

            //if (number >= 1000) {
            //  fontSize = 10;
            //  imageWidth = imageHeight = 55;
            //} else if (number < 1000 && number > 100) {
            //  fontSize = 14;
            //  imageWidth = imageHeight = 35;
            //}

            var svg = d3.select(document.createElement('div')).append('svg')
                .attr('viewBox', '0 0 54.4 54.4')
                .append('g');

            var circles = svg.append('circle')
                .attr('cx', '27.2')
                .attr('cy', '27.2')
                .attr('r', '21.2')
                .style('fill', '#2980b9');

            //var path = svg.append('path')
            //  .attr('d', 'M27.2,0C12.2,0,0,12.2,0,27.2s12.2,27.2,27.2,27.2s27.2-12.2,27.2-27.2S42.2,0,27.2,0z M6,27.2 C6,15.5,15.5,6,27.2,6s21.2,9.5,21.2,21.2c0,11.7-9.5,21.2-21.2,21.2S6,38.9,6,27.2z')
            //  .attr('fill', '#FFFFFF');

            var text = svg.append('text')
                .attr('dx', 27)
                .attr('dy', 32)
                .attr('text-anchor', 'middle')
                .attr('style', 'font-size:' + fontSize + 'px; fill: #FFFFFF; font-family: Open Sans, Arial, sans-serif; font-weight: bold')
                .text(number);

            var svgNode = svg.node().parentNode.cloneNode(true),
                image = new Image();

            d3.select(svgNode).select('clippath').remove();

            var xmlSource = (new XMLSerializer()).serializeToString(svgNode);

            image.onload = (function (imageWidth, imageHeight) {
                var canvas = document.createElement('canvas'),
                    context = canvas.getContext('2d'),
                    dataURL;

                d3.select(canvas)
                    .attr('width', imageWidth)
                    .attr('height', imageHeight);

                context.drawImage(image, 0, 0, imageWidth, imageHeight);

                dataURL = canvas.toDataURL();
                generateIconCache[number] = dataURL;

                callback(dataURL);
            }).bind(this, imageWidth, imageHeight);

            image.src = 'data:image/svg+xml;base64,' + btoa(encodeURIComponent(xmlSource).replace(/%([0-9A-F]{2})/g, function (match, p1) {
                    return String.fromCharCode('0x' + p1);
                }));
        }


        markers.forEach(function (point) {
            //if (point[1] && point[2] === null) {
            //    console.log('bad');
            //}
            //console.log(point[0]);
            generateIcon(point[0], function (src) {
                var pos = new google.maps.LatLng(point[1], point[2]);

                //bounds.extend(pos);

                new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: src,
                    id: point[0]
                });
            });
            //console.log('good');

        });

        //map.fitBounds(bounds);


    }
    else {

    }
}