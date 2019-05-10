$(document).ready(function () {
    $('.share-ad-link').click(function () {
        var adid = this.id;
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
                                        $('#gallery1').imagesGrid({
                                            images: result.thumb,
                                            full_images: result.full
                                        });
                                    });
                                }
                            }
                        });

                        var html = '';
                        var img = '';

                        if (member.profilePicture) {
                            if (member.facebookID && substr(member.profilePicture, 0, 5) === "https") {

                                img = '<img alt="profile picture" src="' + member.profilePicture + '" >';
                            } else if (member.googleID && substr(member.profilePicture, 0, 5) === "https") {

                                img = '<img alt="profile picture" src="' + member.profilePicture + '" >';
                            } else {

                                img = '<img alt="profile picture" src="../upload/member/' + member.profilePicture + '">';
                            }
                        } else {
                            img = '<img alt="profile picture" src="../upload/member/member.png">';
                        }

                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += img;
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

                        $('#share-post').attr('ad', ad.id)
                        $('#shared-ad-details').empty();
                        $('#shared-ad-details').append(html);

                    }
                });

            }
        });
    });

    $('.share-post').click(function () {
        var adid = $(this).attr('ad');
        var member = $(this).attr('member');
        var description = $('#description').val();
        $.ajax({
            url: "post-and-get/ajax/share-ad.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                ad: adid,
                member: member,
                description: description,
                option: 'SHAREAD'
            },
            success: function (ad) {
                swal({
                    title: "Success!",
                    text: "This has been shared to your timeline.",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#share-ad').modal('hide');

            }
        });
    });


});


