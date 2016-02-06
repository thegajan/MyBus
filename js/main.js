$(document).ready(function () {
    $('#header-nav-navicon').click(function () {
        var visible = $('#side-menu');
        if (visible.hasClass('visible')) {
            visible.animate({"left": "-300px"}, "fast").removeClass('visible');
        } else {
            visible.animate({"left": "0px"}, "fast").addClass('visible');
        }
    });
    function noBus() {
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

    $(".arrow").click(function () {
        $("#add-drop-down").toggle();
        //$("#arrowDown").toggle();
        //$("#arrowUp").toggle();
    });
    //function getCookie(cName) {
    //    var cVal = document.cookie.match('(?:^|;) ?' + cName + '=([^;]*)(?:;|$)');
    //    if (!cVal) {
    //        return "";
    //    } else {
    //        return cVal[1];
    //    }
    //}
    //var cookie = getCookie("busList");
    //if (!cookie) {
    //    var busList = [],
    //    json_str = JSON.stringify(busList);
    //    allCookies = document.cookie;
    //    document.cookie = "busList=" + json_str;
    //    //docCookies.setItem("busList", 31536e3);
    //} else {
    //    // cookie exists
    //}
    //function addBusCookie (busNum){
    //    if($.inArray(busNum, array)) == 0){
    //
    //    }else {
    //
    //    }
    //}
    $('#search-bus div').click(function () {
        var angle = 0;
        var img = $(this).find('img');
        if ($(this).parent().attr("id") == "search-bus") {
            $(this).detach().appendTo('#buses');
            noBus();
            angle += 45;
            $(img).css('transform', 'rotate(' + angle + 'deg)');
            orderBus('buses');
        }
        else {
            $(this).detach().appendTo('#search-bus');
            noBus();
            $(img).css('transform', 'rotate(' + angle + 'deg)');
            orderBus('search-bus');
        }
    });


    //var xhttp = new XMLHttpRequest();
    //xhttp.onreadystatechange = function() {
    //    if (xhttp.readyState == 4 && xhttp.status == 200) {
    //        console.log(xhttp.responseText);
    //    }
    //};
    //xhttp.open("GET", "http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json", true);
    //xhttp.send();
});