$(document).ready(function () {
    $('.upload-pro-pic').mouseover(function () {
        $('.upload-span').removeClass('hidden');
    });
    $('.upload-pro-pic').mouseout(function () {
        $('.upload-span').addClass('hidden');
    });
    $('.upload-cover-pic').mouseover(function () {
        $('.upload-span2').removeClass('hidden');
    });
    $('.upload-cover-pic').mouseout(function () {
        $('.upload-span2').addClass('hidden');
    });

    $('#groups-you-manage').click(function () {
        $('.your-groups').addClass('hidden');
        $('.discover-groups').addClass('hidden');
        $('.groups-you-manage').removeClass('hidden');
    });
    $('#your-groups').click(function () {
        $('.groups-you-manage').addClass('hidden');
        $('.discover-groups').addClass('hidden');
         $('.group-invitations').addClass('hidden');
        $('.your-groups').removeClass('hidden');
    });
    $('#discover-groups').click(function () {
        $('.groups-you-manage').addClass('hidden');
        $('.your-groups').addClass('hidden');
        $('.group-invitations').addClass('hidden');
        $('.discover-groups').removeClass('hidden');
    });
    $('#group-invitations').click(function () {
        $('.groups-you-manage').addClass('hidden');
        $('.your-groups').addClass('hidden');
        $('.discover-groups').addClass('hidden');
        $('.group-invitations').removeClass('hidden');
    });

});
