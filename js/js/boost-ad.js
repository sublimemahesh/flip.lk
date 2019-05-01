$(document).ready(function () {
    ;
    $.ajax({
        url: "post-and-get/ajax/boost-ad.php",
        type: "POST",
        data: {
            option: 'BOOSTDEACTIVEAD'
        },
        dataType: 'json',
        success: function (mess) {
            return true;
        }
    });
});

