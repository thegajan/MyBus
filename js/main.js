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
    //function orderBus (list) {
    //    if (list == '#buses' && $(list).children().length > 2) {
    //        $(list + " div").sort(function (a, b) {
    //            return parseInt(a.id) > parseInt(b.id);
    //        }).each(function () {
    //            var elem = $(this);
    //            elem.remove();
    //            $(elem).appendTo("#search-bus");
    //        })
    //    }
    //    else if ($(list).children().length >2){
    //        $(list + " div").sort(function (a, b) {
    //            return parseInt(a.id) > parseInt(b.id);
    //        }).each(function () {
    //            var elem = $(this);
    //            elem.remove();
    //            $(elem).appendTo("#search-bus");
    //        })
    //    }
    //}
    //function orderBus (list) {
    //        $(list + " div").sort(function (a, b) {
    //            return parseInt(a.id) > parseInt(b.id);
    //        }).each(function () {
    //            var elem = $(this);
    //            elem.remove();
    //            $(elem).appendTo(list);
    //        })
    //
    //}
    $('#search-bus div').click(function () {
        if ($(this).parent().attr("id") == "search-bus") {
            $(this).detach().appendTo('#buses');
            noBus();
            //orderBus('#buses');
        }
        else {
            $(this).detach().appendTo('#search-bus');
            noBus();
            //orderBus('#search-bus');
        }
    });
    //(function($){
    //    $(window).load(function(){
    //        $("#search-bus").mCustomScrollbar();
    //    });
    //})(jQuery);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
        }
    };
    xhttp.open("GET", "http://api.511.org/transit/StopMonitoring?api_key=c4f75444-cda2-412c-b987-8667c2eb5385&agency=vta&format=json", true);
    xhttp.send();
});