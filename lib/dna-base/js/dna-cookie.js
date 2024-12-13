/*================================================================================== */
/* Jquery START ==================================================================== */
jQuery(document).ready(function ($) {
    "use strict";

    var cookieName = 'noticeCookie';

    if (!readCookie(cookieName)) {
        var htmlAppend = "<div id='notice-cookie-content'>"+dnaL10n.msgCookie+" <a href='#' id='agree-cookie'>"+dnaL10n.okCookie+"</a></div>";
        $('#notice-cookie').append(htmlAppend);

        $('#agree-cookie').on('click', function(ev){
            createCookie(cookieName, 1, 30);
            $('.super-top-navigation-wrapper').slideUp();

            return ev.preventDefault();
        });
    }
});

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}