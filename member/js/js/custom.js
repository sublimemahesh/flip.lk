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
});
