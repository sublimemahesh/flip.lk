$(document).ready(function () {
    var id = $('#id').val();

    $.ajax({
        url: "post-and-get/ajax/ad-images.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            id: id,
            option: 'GETADPHOTOS'
        },
        success: function (result) {
            $(function () {
                $('#gallery').imagesGrid({
                    images: result.thumb,
                    full_images: result.full
                });
                var html1 = '';
                html1 = '<i class="fa fa-times-circle remove-ad-image" id="remove-ad-image"></i>';

                $('#remove-circle').append(html1);
            });

        }
    });
});