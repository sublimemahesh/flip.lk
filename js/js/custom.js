$(document).ready(function () {
    $('#autocomplete').keyup(function () {

        if ($('#autocomplete').val() == '') {
            $('#city').val('');
        }
    });
    $("#ad-slider").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 4,
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
                items: 2,
                nav: false
            },
            1000: {
                items: 4,
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
});
