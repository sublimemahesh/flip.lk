$(document).ready(function () {
    
    $.ajax({
        url: "post-and-get/ajax/advertisement.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            option: 'GETALLADS'
        },
        success: function (ads) {
            
            $.each(ads, function (key, ad) {
                $.ajax({
                    url: "post-and-get/ajax/ad-images.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        id: ad.id,
                        option: 'GETADPHOTOS'
                    },
                    success: function (result) {
                        $(function () {
                            $('#gallery-' + ad.id).imagesGrid({
                                images: result.thumb,
                                full_images: result.full
                            });

                        });

                    }
                });
            });
        }
    });

});