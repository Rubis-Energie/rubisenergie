function recaptchaCallback() {
    $('#f_recaptcha').valid();
}


$(document).ready(function(){
    
    /*------------------------------------*\
        STICKY MENU
    \*------------------------------------*/
    
    var didScroll;
    var lastScrollTop = 0;
    var delta = 20;
    var header = document.querySelector('header');    
    
    var documentIsScrolling = function () {
        didScroll = true;
    
        setInterval(function() {
            if (didScroll) {
                handleScrollForMenu();
                didScroll = false;
            }
        }, 250);
    }
    
    var handleScrollForMenu = function () {
        var st = window.scrollY;
    
        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta) return;
        
        if ( st < 100 ) {
            // console.log('documentIsScrolling BACKTOTHETOP');
            header.classList.remove('-out');
        }
        else if (st > lastScrollTop ){
            // console.log('documentIsScrolling DOWN');
            header.classList.add('-out');
        } 
        else {
            // console.log('documentIsScrolling UP');
            header.classList.remove('-out');
        }
    
        lastScrollTop = st;
    }
    
    document.addEventListener("scroll", documentIsScrolling, false);
    


    fileInput  = $('.input-file');
    button     = $( ".input-file-trigger" );
    the_return = $(".file-return");

    button.keydown(function( event ) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            $(this).parent().find(fileInput).focus();
        }
    });

    button.click(function( event ) {
        $(this).parent().find(fileInput).focus();
        return false;
    });

    fileInput.change(function( event ) {
        $(this).parent().parent().find(".file-return").html(this.files[0].name);
    });

    $.validator.addMethod("validateRecaptcha", function (value, element) {
        if (grecaptcha.getResponse() == '') {
            return false;
        } else {
            return true;
        }
    }, "Vous devez valider le reCAPTCHA");

    setTimeout(function () {
        if ($('#container_form form').length) {
            $('#contactRgpd').rules('add', {
                validateCgv: true
            });
            $('#f_recaptcha').rules('add', {
                validateRecaptcha: true
            });
        }
    }, 100);

    $.extend($.validator.messages, {
        required: "Ce champ est obligatoire.",
        email: "Veuillez fournir une adresse électronique valide."
    });

    $.validator.addMethod("validateCgv", function (value, element) {
        return $('#contactRgpd').is(':checked');
    }, "Vous devez avoir pris connaissance de notre politique de confidentialité");

    $('#container_form form').validate({
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                var parentElm = element.closest('.form-group');
                error.addClass("checkbox");
                parentElm.append(error);
            }
            else
                error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    // $('.select-selected').bind('DOMSubtreeModified', function() {
    //     $("#formActus").submit();
    //     // console.log('test');
    // });

    $('body').on('DOMSubtreeModified', '.select-selected', function() {
        setTimeout(function() {
            $("#formActus").submit();
        }, 3000);
    });

    // Menu
    $('.toggleMenu').click(function() {
        $(this).toggleClass('openMenu');
        $('.mainMenu').toggleClass('openMenu');
        $('body').toggleClass('openMenu');
    });

    if (window.matchMedia("(max-width: 991px)").matches) {

        $('.dropdown.nav-item').click(function() {
            var heightSubMenu = $(this).find('.subMenu').outerHeight(true);
            console.log(heightSubMenu);
            var heightLabel = $(this).find('.nav-link.dropdown-toggle').outerHeight(true) + 30;
            console.log(heightLabel);
            $(this).toggleClass('openSub');
            $(this).find('.containerSubmenu').toggleClass('openSub');

            if($(this).hasClass('openSub') && $(this).find('.containerSubmenu').hasClass('openSub')) {
                $(this).css('height', heightLabel + heightSubMenu);
                $(this).find('.containerSubmenu').css('height', heightSubMenu);
            } else {
                $(this).css('height', heightLabel);
                $(this).find('containerSubmenu').css('height', '0');
            }
        });
    }

    // Produit
    $('.textHover').hover(function() {
        var attrText = $(this).attr('data-hover');

        $('.imgHover').each(function() {
            var attrImg = $(this).attr('data-hover');


            if(attrText == attrImg) {
                var dataImg = $(this).attr('data-img');
                $('#imgBg').css({
                    'background-image': 'url(' + dataImg + ')',
                    // 'transition': '0.1s ease'
                });
            }
        });
    });

    // block slider

    var IDnumber = 1;
	var NEXTPREVnumber = 1;

    $('.owl-slider').each(function() {

        var newID = 'owl-slider' + IDnumber;

        $(this).attr('id', newID);
		IDnumber++;

        var owl = $('#' + newID);

        owl.owlCarousel({

            loop: true,
            nav: false,
            dots: false,
            smartSpeed: 2000,
            items: 1,
            responsiveClass: true,
            responsive : {
                0 : {
                    dots: true,
                },
                575 : {
                dots: false,
                }
            }
        });

        owl.trigger('refresh.owl.carousel');

        $(this).next().find('.nextBtn').addClass('nextBtn' + NEXTPREVnumber)
		$(this).next().find('.prevBtn').addClass('prevBtn' + NEXTPREVnumber)

        $(".prevBtn" + NEXTPREVnumber).click(function() {
            owl.trigger('prev.owl.carousel');
        });

        $(".nextBtn" + NEXTPREVnumber).click(function() {
            owl.trigger('next.owl.carousel');
        });

        NEXTPREVnumber++;
    });


    $('.owl-sliderNone').owlCarousel({
        loop: false,
        nav: false,
        dots: false,
        items: 1,
        mouseDrag: false,
        touchDrag: false,
        freeDrag: false,
    });

    // Map implantation show/hide the scroll
    $('.innerContainerEachText').each(function() {
        var heightTexts = $(this).outerHeight(true);
        var heightContainer = $(this).parent('.eachTextCountry').outerHeight(true) - 50;

        if(heightTexts > heightContainer) {
            $(this).parent('.eachTextCountry').addClass('scroll');
        }
    });

    var goscroll = false;
    var the_hash = $(location).attr('hash');
    var the_element = '';

    if(the_hash.match("\#(.+)")) {

        if($(the_hash).length>0) {
            goscroll = true;
        }
        else if($("a[name=" + the_hash + "]").length>0) {
            the_element = "a[name=" + the_hash + "]";
            goscroll = true;
        }

        if(goscroll) {
            $('html, body').animate({
                scrollTop:$(the_hash).offset().top - 150
            }, 1);
            return false;
        }
    }
});


// MAP IMPLANTATION
am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    /* Create map instance */
    var chart = am4core.create("chartdiv", am4maps.MapChart);

    /* Set map definition */
    chart.geodata = am4geodata_worldLow;

    /* Set projection */
    chart.projection = new am4maps.projections.Miller();
    chart.seriesContainer.draggable = false;
    chart.seriesContainer.resizable = false;
    chart.homeZoomLevel = 2;
    chart.seriesContainer.events.disableType("doublehit");
    chart.chartContainer.background.events.disableType("doublehit");

    /* Create map polygon series */
    var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

    /* Make map load polygon (like country names) data from GeoJSON */
    polygonSeries.useGeodata = true;

    /* Configure series */
    var polygonTemplate = polygonSeries.mapPolygons.template;
    polygonTemplate.applyOnClones = true;
    polygonTemplate.togglable = true;
    polygonTemplate.nonScalingStroke = true;
    polygonTemplate.strokeOpacity = 0.5;
    polygonTemplate.fill = am4core.color("#D6D6D6");


    polygonSeries.exclude = ["AQ"];

// Pays masqués (à ne pas supprimer au cas ou on voudrait les enlever)
// polygonSeries.exclude = ["AQ", "AU", "RU", "US", "CA", "GL", "MX", "CO", "UY", "BR", "PE", "BO", "CL", "HN", "AR", "PY", "GY", "GF", "VE", "EC", "PA", "CR", "NI", "GT", "CU", "PR", "TT", "ID", "MY", "IS", "SE", "NO", "FI", "MN", "CN", "LA", "VN", "KR", "KP", "JP", "PH", "PG", "NZ", "TH", "MM", "BD", "SJ", "KH", "HK", "TW", "SR"];

    polygonSeries.data = countries;

    polygonTemplate.propertyFields.fill = "fill";

    // Small map
    // chart.smallMap = new am4maps.SmallMap();
    // // Re-position to top right (it defaults to bottom left)
    // chart.smallMap.align = "left";
    // chart.smallMap.valign = "top";
    // chart.smallMap.series.push(polygonSeries);

    // Zoom control
    chart.zoomControl = new am4maps.ZoomControl();
    // chart.zoomControl.slider.height = 100;
    chart.zoomControl.plusButton.disabled = true;
    chart.zoomControl.minusButton.disabled = true;
    chart.chartContainer.wheelable = false;


    var homeButton = new am4core.Button();
    homeButton.events.on("hit", function(){
        polygonSeries.data = countries;
        chart.goHome();
    });

    // homeButton.icon = new am4core.Sprite();
    // homeButton.padding(7, 5, 7, 5);
    // homeButton.width = 30;
    // homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
    // homeButton.marginBottom = 10;
    // homeButton.parent = chart.zoomControl;
    // homeButton.insertBefore(chart.zoomControl.plusButton);

    var lastSelected;

    $('.continents-click').click(function() {
        var cont = $(this).attr('data-cont');
        if (cont != 'all') {
            $('.continentCountries').removeAttr('data-back');

            if (cont == 'eu') {
                tab = zoomToeu;
            }
            if (cont == 'af') {
                tab = zoomToaf;
            }
            if (cont == 'an') {
                tab = zoomToan;
            }
            if (cont == 'as') {
                tab = zoomToas;
            }
            if (cont == 'zh') {
                tab = zoomTozh;
            }
            if (cont == 'ca') {
                tab = zoomToca;
            }
            if (cont == 'oc') {
                tab = zoomTooc;
            }

            zoomToContinent(cont, tab);
        } else {
            $('.continentCountries').attr('data-back', 'all');
        }
        // $('.continents-click').removeClass('active');
        // $(this).addClass('active');

    });

    function zoomToContinent(id, tab) {

        var north, south, west, east;

         // Find extreme coordinates for all pre-zoom countries
        for(var i = 0; i < tab.length; i++) {
            // if (id == 'BM') {
            //     console.log(tab[i].id);
            //     var country = polygonSeries.getPolygonById(tab[i].id);
            //     console.log(country);
            // } else {
            //     var country = polygonSeries.getPolygonById(tab[i]);
            // }

            var country = polygonSeries.getPolygonById(tab[i]);
            if (north == undefined || (country.north > north)) {
                north = country.north;
            }
            if (south == undefined || (country.south < south)) {
                south = country.south;
            }
            if (west == undefined || (country.west < west)) {
                west = country.west;
            }
            if (east == undefined || (country.east > east)) {
                east = country.east;
            }
            country.isActive = true
        }

        if (id == 'eu') {
            polygonSeries.data = eu;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.2, true);
        }
        if (id == 'af') {
            polygonSeries.data = af;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.5, true);
        }
        if (id == 'an') {
            polygonSeries.data = an;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.10, true);
        }
        if (id == 'as') {
            polygonSeries.data = as;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.10, true);
        }
        if (id == 'zh') {
            polygonSeries.data = zh;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.10, true);
        }
        if (id == 'ca') {
            polygonSeries.data = ca;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.7, true);
        }
        if (id == 'oc') {
            polygonSeries.data = oc;
            // Pre-zoom
            chart.zoomToRectangle(north, east, south, west, 1.10, true);
        }
    }

    $(".countries-click").on("click", function(ev) {

        var polygonId = $(this).attr('data-id');
        var wpId = $(this).attr('data-pid');
        // console.log(polygonId);

        var target = polygonSeries.getPolygonById(polygonId);
        chart.zoomToMapObject(target, 10);


        if (polygonId == 'JE' || polygonId == 'GP' || polygonId == 'KY' || polygonId == 'MQ' || polygonId == 'BL' || polygonId == 'TC' || polygonId == 'KM' || polygonId == 'BM') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 30);
        }

        if (polygonId == 'CM' || polygonId == 'CF' || polygonId == 'CD' || polygonId == 'CQ' || polygonId == 'TD') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 5);
        }

        if (polygonId == 'BB' || polygonId == 'VC' || polygonId == 'LC' || polygonId == 'GD' || polygonId == 'DM' || polygonId == 'AG' || polygonId == 'SR' || polygonId == 'GY') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 10);
        }

        if(polygonId == 'BS' || polygonId == 'TC') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 25);
        }

        if (polygonId == 'TG' || polygonId == 'BJ' || polygonId == 'BF' || polygonId == 'NE' || polygonId == 'GH' || polygonId == 'ML') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 7);
        }

        if (polygonId == 'GQ') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 5);
        }

        if (polygonId == 'ZA' || polygonId == 'SN' || polygonId == 'IN' || polygonId == 'BW' || polygonId == 'LS' || polygonId == 'SZ' || polygonId == 'ZW' || polygonId == 'NA' || polygonId == 'MR' || polygonId == 'GM' || polygonId == 'GW' || polygonId == 'GN' || polygonId == 'ML') {
            var target = polygonSeries.getPolygonById(polygonId);
            chart.zoomToMapObject(target, 8);
        }

        var c = [{
            "id": polygonId,
            "fill": am4core.color("#0a624b")
        }];
        polygonSeries.data = c;

        $(".eachTextCountry").each(function() {
            var wpIdText = $(this).attr('data-pid');

            if(wpIdText == wpId) {
                $(this).css({
                    "opacity" : "1",
                    "pointer-events" : "inherit",
                    "transition" : "0.3s ease",
                });
            } else {
                $(this).css({
                    "opacity" : "0",
                    "pointer-events" : "none",
                    "transition" : "0.3s ease",
                });
            }
        });

        // Groupe Afrique australe
        if (polygonId == 'ZA' || polygonId == 'BW' || polygonId == 'LS' || polygonId == 'SZ' || polygonId == 'ZW' || polygonId == 'NA') {
            var children = [{
                "id": "BW",
                "name": "Botswana",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "LS",
                "name": "Lesotho",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "SZ",
                "name": "Swaziland",
                "fill": am4core.color("#0a624b"),
                }, {
                "id": "ZW",
                "name": "Zimbabwe",
                "fill": am4core.color("#569886")
                }, {
                "id": "NA",
                "name": "Namibie",
                "fill": am4core.color("#569886")
                }, {
                "id": "ZA",
                "name": "Afrique du Sud",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Togo
        if (polygonId == 'TG' || polygonId == 'BJ' || polygonId == 'BF' || polygonId == 'NE' || polygonId == 'GH' || polygonId == 'ML') {
            var children = [{
                "id": "BJ",
                "name": "Benin",
                "value": 36,
                "fill": am4core.color("#569886")
                }, {
                "id": "BF",
                "name": "Burkina Faso",
                "value": 37,
                "fill": am4core.color("#569886")
                }, {
                "id": "NE",
                "name": "Niger",
                "value": 38,
                "fill": am4core.color("#569886")
                }, {
                "id": "GH",
                "name": "Ghana",
                "value": 39,
                "fill": am4core.color("#569886")
                }, {
                "id": "ML",
                "name": "Mali",
                "value": 40,
                "fill": am4core.color("#569886")
                }, {
                "id": "TG",
                "name": "Togo",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Sénégal
        if (polygonId == 'SN' || polygonId == 'MR' || polygonId == 'GM' || polygonId == 'GW' || polygonId == 'GN' || polygonId == 'ML') {
            var children = [{
                "id": "MR",
                "name": "Mauritanie",
                "value": 41,
                "fill": am4core.color("#569886")
                }, {
                "id": "GM",
                "name": "Gambie",
                "value": 42,
                "fill": am4core.color("#569886")
                }, {
                "id": "GW",
                "name": "Guinée Bisseau",
                "value": 43,
                "fill": am4core.color("#569886")
                }, {
                "id": "GN",
                "name": "Guinée",
                "value": 44,
                "fill": am4core.color("#569886")
                }, {
                "id": "ML",
                "name": "Mali",
                "value": 40,
                "fill": am4core.color("#569886")
                }, {
                "id": "LR",
                "name": "Libéria",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "SL",
                "name": "Sierra Leone",
                "value": 49,
                "fill": am4core.color("#569886")
                }, {
                "id": "SN",
                "name": "Sénégal",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Mali
        if (polygonId == 'ML') {
            var children = [{
                "id": "MR",
                "name": "Mauritanie",
                "value": 41,
                "fill": am4core.color("#569886")
                }, {
                "id": "GM",
                "name": "Gambie",
                "value": 42,
                "fill": am4core.color("#569886")
                }, {
                "id": "GW",
                "name": "Guinée Bisseau",
                "value": 43,
                "fill": am4core.color("#569886")
                }, {
                "id": "GN",
                "name": "Guinée",
                "value": 44,
                "fill": am4core.color("#569886")
                }, {
                "id": "ML",
                "name": "Mali",
                "value": 40,
                "fill": am4core.color("#569886")
                }, {
                "id": "SN",
                "name": "Sénégal",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "BF",
                "name": "Burkina Faso",
                "value": 37,
                "fill": am4core.color("#569886")
                }, {
                "id": "NE",
                "name": "Niger",
                "value": 38,
                "fill": am4core.color("#569886")
                }, {
                "id": "BJ",
                "name": "Benin",
                "value": 36,
                "fill": am4core.color("#569886")
                }, {
                "id": "TG",
                "name": "Togo",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "GH",
                "name": "Ghana",
                "value": 39,
                "fill": am4core.color("#569886")
            }];

            polygonSeries.data = children;
        }

        // Cameroun
        if (polygonId == 'CM' || polygonId == 'CF' || polygonId == 'CD' || polygonId == 'TD') {
            var children = [{
                "id": "CF",
                "name": "République Centrafricaine",
                "value": 45,
                "fill": am4core.color("#569886")
                }, {
                "id": "CD",
                "name": "République du Congo",
                "value": 46,
                "fill": am4core.color("#569886")
                }, {
                "id": "GQ",
                "name": "Guinée Equatoriale",
                "value": 47,
                "fill": am4core.color("#569886")
                }, {
                "id": "TD",
                "name": "Tchad",
                "value": 48,
                "fill": am4core.color("#569886")
                }, {
                "id": "CM",
                "name": "Cameroun",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Libéria
        if (polygonId == 'LR' || polygonId == 'SL') {
            var children = [{
                "id": "SL",
                "name": "Sierra Leone",
                "value": 49,
                "fill": am4core.color("#569886")
            }, {
                "id": "GN",
                "name": "Guinée",
                "value": 44,
                "fill": am4core.color("#569886")
            },{
                "id": "LR",
                "name": "Libéria",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Gabon
        if (polygonId == 'GA') {
            var children = [{
                "id": "GQ",
                "name": "Guinée équatoriale",
                "fill": am4core.color("#569886")
            }, {
                "id": "GA",
                "name": "Gabon",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Guinée Équatoriale
        if (polygonId == 'GQ') {
            var children = [{
                "id": "GQ",
                "name": "Guinée équatoriale",
                "fill": am4core.color("#569886")
            }, {
                "id": "GA",
                "name": "Gabon",
                "fill": am4core.color("#0a624b")
            }, {
                "id": "TD",
                "name": "Tchad",
                "value": 48,
                "fill": am4core.color("#569886")
            }, {
                "id": "CM",
                "name": "Cameroun",
                "fill": am4core.color("#0a624b")
            }, {
                "id": "CF",
                "name": "République Centrafricaine",
                "value": 45,
                "fill": am4core.color("#569886")
            }, {
                "id": "CD",
                "name": "République du Congo",
                "value": 46,
                "fill": am4core.color("#569886")
            }];

            polygonSeries.data = children;
        }

        // Îles Anglo-Normandes
        if (polygonId == 'JE') {
            var children = [{
                "id": "GG",
                "name": "Guernesey",
                "value": 49,
                "fill": am4core.color("#0a624b")
            }, {
                "id": "JE",
                "name": "Jersey",
                "fill": am4core.color("#0a624b")
            }];

            polygonSeries.data = children;
        }

        // Maroc
        if (polygonId == 'MA') {
            var children = [{
                "id": "MA",
                "name": "Maroc",
                "fill": am4core.color("#01614d")
            }, {
                "id": "EH",
                "name": "Sahara Occidental",
                "fill": am4core.color("#569886")
            }];

            polygonSeries.data = children;
        }

        // Sahara Occidental
        if (polygonId == 'EH') {
            var children = [{
                "id": "MA",
                "name": "Maroc",
                "fill": am4core.color("#569886")
            }, {
                "id": "EH",
                "name": "Sahara Occidental",
                "fill": am4core.color("#01614d")
            }];

            polygonSeries.data = children;
        }


        // Groupe Barbade, Antigua et Barbuda, Dominique, Marie Galante, Sainte Lucie, St Vincent, Guyana, Suriname
        if (polygonId == 'BB' || polygonId == 'VC' || polygonId == 'LC' || polygonId == 'GD' || polygonId == 'DM' || polygonId == 'AG' || polygonId == 'SR' || polygonId == 'GY') {
            var children = [{
                "id": "VC",
                "name": "Saint Vincent & les Grenadines",
                "fill": am4core.color("#569886")
                }, {
                "id": "LC",
                "name": "Sainte Lucie",
                "fill": am4core.color("#569886")
                }, {
                "id": "GD",
                "name": "Grenade",
                "fill": am4core.color("#569886"),
                }, {
                "id": "DM",
                "name": "Dominique",
                "fill": am4core.color("#569886")
                }, {
                "id": "AG",
                "name": "Antigua et Barbuda",
                "fill": am4core.color("#569886")
                }, {
                "id": "BB",
                "name": "Barbade",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "SR",
                "name": "Suriname",
                "fill": am4core.color("#569886")
                }, {
                "id": "GY",
                "name": "Guyana",
                "fill": am4core.color("#569886")
            }];

            polygonSeries.data = children;
        }


        // Groupe Guadeloupe, Martinique, Saint Barthélémy, Marie Galante
        if (polygonId == 'GP' || polygonId == 'MQ' || polygonId == 'BL') {
            var children = [{
                "id": "GP",
                "name": "Guadeloupe",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "MQ",
                "name": "Martinique",
                "fill": am4core.color("#569886")
                }, {
                "id": "BL",
                "name": "Saint Barthélémy",
                "fill": am4core.color("#569886"),
            }];

            polygonSeries.data = children;
        }


        // Groupe Bahamas et Iles turks
        if (polygonId == 'BS' || polygonId == 'TC') {
            var children = [{
                "id": "BS",
                "name": "Bahamas",
                "fill": am4core.color("#0a624b")
                }, {
                "id": "TC",
                "name": "Îles Turks et Caïques",
                "fill": am4core.color("#569886")
            }];

            polygonSeries.data = children;
        }
    });

    $('.continents-click').click(function() {
        var continent = $(this).attr('data-cont');
        $('.eachTextCountry').css({
            "opacity" : "0",
            "pointer-events" : "none",
            "transition" : "0.3s ease",
        });
        if (continent == 'all') {
            $('.allCountry').css({
                "opacity" : "1",
                "pointer-events" : "inherit",
                "transition" : "0.3s ease",
            });
        } else {
            $('.eachTextCountry.'+continent).css({
                "opacity" : "1",
                "pointer-events" : "inherit",
                "transition" : "0.3s ease",
            });
        }
    });

    $('.back.continent').click(function() {
        $('.eachTextCountry').css({
            "opacity" : "0",
            "pointer-events" : "none",
            "transition" : "0.3s ease",
        });
        $('.continentContent').css({
            "opacity" : "1",
            "pointer-events" : "inherit",
            "transition" : "0.3s ease",
        });
        polygonSeries.data = countries;
        chart.goHome();

    });

    $('.back.continentCountries').click(function() {
        var backAll = $(this).attr('data-back');
        var contBack = $(this).attr('data-cont');

        if (typeof backAll !== 'undefined' && backAll !== false) {
            $('.eachTextCountry').css({
                "opacity" : "0",
                "pointer-events" : "none",
                "transition" : "0.3s ease",
            });
            $('.allCountry').css({
                "opacity" : "1",
                "pointer-events" : "inherit",
                "transition" : "0.3s ease",
            });
            polygonSeries.data = countries;
            chart.goHome();

        } else {
            $('.eachTextCountry').css({
                "opacity" : "0",
                "pointer-events" : "none",
                "transition" : "0.3s ease",
            });
            $('.eachTextCountry.'+contBack).css({
                "opacity" : "1",
                "pointer-events" : "inherit",
                "transition" : "0.3s ease",
            });

            if (contBack == 'eu') {
                tab = zoomToeu;
            }
            if (contBack == 'af') {
                tab = zoomToaf;
            }
            if (contBack == 'an') {
                tab = zoomToan;
            }
            if (contBack == 'as') {
                tab = zoomToas;
            }
            if (contBack == 'zh') {
                tab = zoomTozh;
            }
            if (contBack == 'ca') {
                tab = zoomToca;
            }
            if (contBack == 'oc') {
                tab = zoomTooc;
            }
            zoomToContinent(contBack, tab);
        }
    });
    /* Create selected and hover states and set alternative fill color */
    // var ss = polygonTemplate.states.create("active");
    // ss.properties.fill = am4core.color("#4a58c1");

    // var hs = polygonTemplate.states.create("hover");
    // hs.properties.fill = am4core.color("#73e6a3");

}); // end am4core.ready()