$(document).ready(function () {
    $('#header-nav-navicon').click(function () {
        var visible = $('#side-menu');
        if (visible.hasClass('visible')) {
            visible.animate({"left": "-300px"}, "fast").removeClass('visible');
        } else {
            visible.animate({"left": "0px"}, "fast").addClass('visible');
        }
    });
    function noBus(){
        if (document.getElementById('buses').childNodes.length > 3) {
            $('#noBus').css('display', 'none');
        } else {
            $('#noBus').css('display', 'block');
        }
    }
    function orderBus(someVar) {
        var main = document.getElementById(someVar);

        [].map.call(main.children, Object).sort(function (a, b) {
            return +a.id - +b.id;
        }).forEach(function (elem) {
            main.appendChild(elem);
        });
    }
    $('#search-bus div').click(function () {
        var angle = 0;
        var img = $(this).find('img');
        if ($(this).parent().attr("id") == "search-bus") {
            $(this).detach().appendTo('#buses');
            noBus();
            angle += 45;
            $(img).css('transform','rotate(' + angle + 'deg)');
            orderBus('buses');
        }
        else {
            $(this).detach().appendTo('#search-bus');
            noBus();
            $(img).css('transform','rotate(' + angle + 'deg)');
            orderBus('search-bus');
        }
    });
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
        }
    };
    xhttp.open("GET", "http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json", true);
    xhttp.send();
});