$(document).ready(function () {
    $('#header-nav-navicon').click(function(){
        var visible = $('#side-menu');
        if (visible.hasClass('visible')){
            visible.animate({"left":"-300px"}, "fast").removeClass('visible');
        } else {
            visible.animate({"left":"0px"}, "fast").addClass('visible');
        }
    });
    $('#search-bus div').click(function(){
        if ($(this).parent().attr("id") == "search-bus") {
            $(this).detach().appendTo('#buses');
        }
        else {
            //$(elem).detach().appendTo('#nonSelected');
        }
    });
});