$(document).ready(function () {
    var memberid = $('#member').val();
    $.ajax({
        url: "post-and-get/ajax/post.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            member: memberid,
            option: 'GETPOST'
        },
        success: function (posts) {
            
            $.each(posts, function (key, post) {
                
                if (post.shared_ad == 0) {
                    $.ajax({
                        url: "post-and-get/ajax/post-photos.php",
                        cache: false,
                        dataType: "json",
                        type: "POST",
                        data: {
                            id: post.id,
                            option: 'GETPOSTPHOTOS'
                        },
                        success: function (result) {
                            $(function () {
                                $('#gallery-' + post.id).imagesGrid({
                                    images: result.thumb,
                                    full_images: result.full
                                });

                            });

                        }
                    });
                } else {
                    $.ajax({
                        url: "post-and-get/ajax/ad-photos.php",
                        cache: false,
                        dataType: "json",
                        type: "POST",
                        data: {
                            id: post.shared_ad,
                            option: 'GETADPHOTOS'
                        },
                        success: function (result) {
                            $(function () {
                                $('#gallery-' + post.id).imagesGrid({

                                    images: result.thumb,
                                    full_images: result.full
                                });

                            });

                        }
                    });
                }
            });


        }
    });

});