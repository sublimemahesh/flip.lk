$(document).ready(function () {
    var memberid = $('#member').val();

    $.ajax({
        url: "post-and-get/ajax/advertisement.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            member: memberid,
            option: 'GETADSBYGROUPSOFMEMBER'
        },
        success: function (ads) {

            $.each(ads, function (key, ad) {
                if (ad.type == 'post') {
                    $.ajax({
                        url: "post-and-get/ajax/post.php",
                        cache: false,
                        dataType: "json",
                        type: "POST",
                        data: {
                            post: ad.id,
                            option: 'GETPOSTBYID'
                        },
                        success: function (post) {
                                if (post.sharedAd == 0) {
                                    
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
                                                $('#gallery-post-' + ad.id).imagesGrid({
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
                                            id: post.sharedAd,
                                            option: 'GETADPHOTOS'
                                        },
                                        success: function (result) {
                                            $(function () {
                                                
                                                $('#gallery-post-' + ad.id).imagesGrid({

                                                    images: result.thumb,
                                                    full_images: result.full
                                                });

                                            });

                                        }
                                    });
                                }
                        }
                    });


                } else {
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
                                $('#gallery-ad-' + ad.id).imagesGrid({
                                    images: result.thumb,
                                    full_images: result.full
                                });

                            });

                        }
                    });
                }

//                $.ajax({
//                    url: "post-and-get/ajax/ad-images.php",
//                    cache: false,
//                    dataType: "json",
//                    type: "POST",
//                    data: {
//                        id: ad.id,
//                        option: 'GETADPHOTOS'
//                    },
//                    success: function (result) {
//                        $(function () {
//                            $('#gallery-' + ad.id).imagesGrid({
//                                images: result.thumb,
//                                full_images: result.full
//                            });
//
//                        });
//
//                    }
//                });
            });


        }
    });

});