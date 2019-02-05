$(document).ready(function () {
    $('.share-ad-link').click(function () {
        alert(111);
        var adid = this.id;
        alert(adid);
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
                        console.log(member);
                        alert('member');
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

                        $('#share-post').attr('ad', ad.id)
                        $('#shared-ad-details').empty();
                        $('#shared-ad-details').append(html);

                    }
                });

            }
        });
    });

    $('.share-post').click(function () {
        alert(111);
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


