jQuery(document).ready(function($){

    /* prepend menu icon */
    $('#nav').prepend('<div id="menu-icon"></div>');

    /* toggle nav */
    $("#menu-icon").on("click", function(){
        $("#menu-navigation").slideToggle();
        $(this).toggleClass("active");
    });

});