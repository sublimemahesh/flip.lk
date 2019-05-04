$(document).ready(function () {
//    document.getElementById("search").value = "What you are looking for?";

    if ($('#search').val() == '') {
        $('#search').val('');
    }

    $('#search').click(function () {
        $(this).val('');
    });


    $('#autocomplete').keyup(function () {

        if ($('#autocomplete').val() == '') {
            $('#city').val('');
        }
    });
    $("#ad-slider").owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        items: 4,
        nav: true,
        dots: false,
        margin: 10,
        responsive: {
            0: {
                items: 1,
                dots: false,
                nav: false
            },
            600: {
                items: 2,
                dots: false,
                nav: false
            },
            1000: {
                items: 3,
                dots: false,
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
        dots: true,
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
