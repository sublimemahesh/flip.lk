$(window).scroll(function () {

    if ($(window).scrollTop() == ($(document).height() - $(window).height())) {

        var total_pages = parseInt($("#total_pages").val());
        var page = parseInt($("#page").val()) + 1;
        var offset = parseInt($("#page").attr('offset'));
        var limit = parseInt($("#page").attr('limit'));
        post_and_ad_slider(offset, limit);
//        
        if (page <= total_pages) {
            load_more_data(page, total_pages);

        }

    }
});

function load_more_data(page, total_pages) {
    $("#total_pages, #page").remove();
    $.ajax({
        url: 'post-and-get/ajax/get-ads-and-posts.php',
        type: "POST",
        data: {page: page},
        beforeSend: function () {
            $(".loader").show();
        },
        complete: function () {

            setTimeout(function () {
                $('.loader').hide();
                if (page == total_pages) {
                    $(".loader").html('... No more posts ...').show();
                }
            }, 3000);
        },
        success: function (data) {
            setTimeout(function () {

                $("#output").append(data);
                comments_limit();


            }, 3000);
        },
        error: function () {
            $(".loader").html("No data found!");
        }
    });

}

function post_and_ad_slider(offset, limit) {


    var memberid = $('#member').val();
    $.ajax({
        url: "post-and-get/ajax/advertisement.php",
        cache: false,
        dataType: "json",
        type: "POST",
        data: {
            member: memberid,
            offset: offset,
            limit: limit,
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
}

function comments_limit() {
    $(".comments-list").each(function (index) {

        if ($(this).children(".comment-item").length > 3) {
            var post = $(this).attr('post-id');
            $("#see-more-" + post).removeClass('hidden');
        }
        $(this).children(".comment-item").slice(-3).show();
    });
//$('.comments-list').on('click', '.see-more', function () {
    $(".see-more").click(function (e) {
        e.preventDefault();
        var $link = $(this);
        var $div = $link.closest('.comments-list');

        if ($link.hasClass('visible')) {
            $link.text('Show all comments');
            $div.children(".comment-item").slice(0, -3).slideUp();
            $link.addClass("see-all");
            $link.removeClass("see-more-less");
        } else {
            $link.text('Show less comments');
            $div.children(".comment-item").slideDown();
            
            $link.addClass("see-more-less");
            $link.removeClass("see-all");
        }
        
//        if ($link.hasClass('see-more-less')) {
////            alert(111);
//            $link.text('Show all comments');
//            $div.children(".comment-item").slice(0, -3).slideUp();
//            $link.addClass("see-all");
//            $link.removeClass("see-more-less");
//        } else {
////            alert(222);
//            $link.text('Show less comments');
//            $div.children(".comment-item").slideDown();
//            
//            $link.addClass("see-more-less");
//            $link.removeClass("see-all");
//        }

        $link.toggleClass('visible');
    });
}
