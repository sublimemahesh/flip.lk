$(document).ready(function () {
    $('#autocomplete').keyup(function () {

        if ($('#autocomplete').val() == '') {
            $('#city').val('');
        }
    });
    $("#ad-slider").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 4,
        nav: true,
        dot: false,
        margin: 10,
        responsive: {
            0: {
                items: 1,
                dot: false,
                nav: false
            },
            600: {
                items: 2,
                dot: false,
                nav: false
            },
            1000: {
                items: 3,
                dot: false,
                nav: true,
            }
        }
    });
    $("#more-ads-slider").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 2,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        nav: true,
        dot: true,
        margin: 10,
        responsive: {
            0: {
                items: 1,
                dots: true,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 2,
                nav: true,
            }
        }
    });
    
//    Typed-js master

    var typed2 = new Typed('#typed2', {
        strings: ['<b style="font-size: 40px; color: #003263;">FLIP.LK</b>', '<b style="font-size: 28px; color: #003263;">Sri Lankan Biggest Business Group</b>'],
        typeSpeed: 100,
        backSpeed: 0,
        fadeOut: true,
        loop: true
    });


});
