$(document).ready(function () {
    $('.view-ad-link').click(function () {
        var adid = this.id;
        var status = $(this).attr('status');
        
        $.ajax({
            url: "post-and-get/ajax/advertisement.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                ad: adid,
                option: 'GETADBYID'
            },
            success: function (ad) {

                $.ajax({
                    url: "post-and-get/ajax/member.php",
                    cache: false,
                    dataType: "json",
                    type: "POST",
                    data: {
                        member: ad.member,
                        option: 'GETMEMBER'
                    },
                    success: function (member) {
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
                                
                                if (result == '') {
                                    return true;
                                } else {
                                    $(function () {
                                        $('#gallery2').imagesGrid({
                                            images: result.thumb,
                                            full_images: result.full
                                        });
                                    });
                                }
                            }
                        });

                        var html = '';
                        var html1 = '';

                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += '<img src="../upload/member/' + member.profilePicture + '" alt="author">';
                        html += '<div class="author-date">';
                        html += '<a class="h6 post__author-name fn" href="#">' + member.firstName + ' ' + member.lastName + '</a>';
                        html += '<div class="post__date">';
                        html += '<time class="published" datetime="2017-03-24T18:18">';
                        html += '16 hours ago';
                        html += '</time>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<p>' + ad.description + '</p>';
                        html += '</li>';
                        if(status == 0) {
                            html1 = '<button id="publish-ad" class="btn btn-md-2 btn-primary publish-ad" ad="' + ad.id + '" member="' + member.id + '">Publish Ad</button>';
                        } else {
                            html1 = '<button id="unpublish-ad" class="btn btn-md-2 btn-primary unpublish-ad" ad="' + ad.id + '" member="' + member.id + '">Unpublish Ad</button>';
                        }
                        
                        $('#view-ad-details').empty();
                        $('#view-ad-details').append(html);
                        $('.view-ad-btn').empty();
                        $('.view-ad-btn').append(html1);

                    }
                });

            }
        });
    });

    $('.view-ad-btn').on('click', '#publish-ad', function () {
        var adid = $(this).attr('ad');
        var status = 1;
        $.ajax({
            url: "post-and-get/ajax/advertisement.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                id: adid,
                status: status,
                option: 'UPDATESTATUS'
            },
            success: function (ad) {
                swal({
                    title: "Success!",
                    text: "This ad has been published.",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#view-ad').modal('hide');
                $('#li_unp_' + adid).remove();

            }
        });
    });
    $('.view-ad-btn').on('click', '#unpublish-ad', function () {
        var adid = $(this).attr('ad');
        var status = 0;
        $.ajax({
            url: "post-and-get/ajax/advertisement.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                id: adid,
                status: status,
                option: 'UPDATESTATUS'
            },
            success: function (ad) {
                swal({
                    title: "Success!",
                    text: "This ad has been unpublished.",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#view-ad').modal('hide');
                $('#li_p_' + adid).remove();

            }
        });
    });


});