$(document).ready(function(){


	function mylazyload () {
   
        // Bas de la fenetre (en pixels)
        var windowBottom = $(window).scrollTop() + $(window).height();

        // Afficher les images et le texte quand on scroll
        $('.mylazyload').each(function(){

            // Le haut de mon Ã©lÃ©ment (y)
            var myTop = $(this).offset().top;  

            // DÃ¨s que l'Ã©lÃ©ment devient visible dans la fenetre
            if (myTop < (windowBottom - 50)) {
               
                $(this).addClass('active');

                // On affiche l'image (en lazyload)
                $(this).find("img").each(function(){
                    $(this).attr("src", $(this).data('src'));
                    $(this).removeAttr('data-src');
                });

            } else {
                // L'Ã©lÃ©ment n'est pas dans la fenetre
            }

        });
    }



mylazyload();
$( window ).scroll(mylazyload);



});