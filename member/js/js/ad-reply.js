$(document).ready(function () {
    $('.add-reply').click(function () {
        var comment_id = this.id;
        $('#reply-form-' + comment_id).removeClass('hidden');
    });
    $('.post-reply').click(function () {
        var comment = $(this).attr('comment');
        var member = $(this).attr('member');
        var reply = $('#reply-' + comment).val();
        $.ajax({
            url: "post-and-get/ajax/ad-reply.php",
            type: "POST",
            data: {
                comment: comment,
                member: member,
                reply: reply,
                option: 'ADDREPLY'
            },
            dataType: "JSON",
            success: function (result) {
                if (result) {
                    $('#reply-' + comment).val('');
                    var html = '';

                    var img = '';

                    if (result.profile) {
                        if (result.facebook_id && substr(result.profile, 0, 5) === "https") {

                            img = '<img alt="profile picture" src="' + result.profile + '" >';
                        } else if (result.google_id && substr(result.profile, 0, 5) === "https") {

                            img = '<img alt="profile picture" src="' + result.profile + '" >';
                        } else {

                            img = '<img alt="profile picture" src="../upload/member/' + result.profile + '">';
                        }
                    } else {
                        img = '<img alt="profile picture" src="../upload/member/member.png">';
                    }

                    html += '<li class="comment-item">';
                    html += '<div class="post__author author vcard inline-items">';
                    html += img;
                    html += '<div class="author-date">';
                    html += '<a class="h6 post__author-name fn" href="profile.php?id=' + member + '">' + result.member + '</a>';
                    html += '<div class="post__date">';
                    html += '<time class="published" datetime="2017-03-24T18:18">';
                    html += 'just now';
                    html += '</time>';
                    html += '</div>';
                    html += '</div>';
                    html += '<a class="more">';
                    html += '<svg class="olymp-three-dots-icon">';
                    html += '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                    html += '</svg>';
                    html += '</a>';
                    html += '</div>';
                    html += '<p>' + result.reply + '</p>';
                    html += '<a class="reply add-reply" id="' + comment + '">Reply</a>';
                    html += '</li>';
                    $('#comment-reply-list-' + comment).append(html);
                }
            }
        });


        $('#reply-form-' + comment).addClass('hidden');
        $('#reply-list-' + comment).removeClass('hidden');
    });
    $(function () {
        $(".comment-reply-list").each(function (index) {

            if ($(this).children(".comment-reply-item").length > 1) {
                var comment = $(this).attr('comment-id');
                $("#see-more-replies-" + comment).removeClass('hidden');
            }
            $(this).children(".comment-reply-item").slice(-1).show();
        });

        $(".see-more-replies").click(function (e) {
            e.preventDefault();
            var $link = $(this);
            var $div = $link.closest('.comment-reply-list');

            if ($link.hasClass('visible')) {
                $link.text('Show all replies');
                $div.children(".comment-reply-item").slice(0, -1).slideUp()
            } else {
                $link.text('Show less replies');
                $div.children(".comment-reply-item").slideDown();
            }

            $link.toggleClass('visible');
        });
    });

    $('.edit-reply').click(function () {
        var reply = this.id;
        var p = $('#reply-p-' + reply).text();
        $('#reply-p-' + reply).addClass('hidden');
        $('#reply-edit-form-' + reply).removeClass('hidden');
        $('#reply-' + reply).val(p);

    });
    $('.reply-edited-cancel').click(function () {
        var reply = $(this).attr('reply');
        $('#reply-p-' + reply).removeClass('hidden');
        $('#reply-edit-form-' + reply).addClass('hidden');
        $('#reply-' + reply).val('');

    });
    $('.post-edited-reply').click(function () {
        var id = $(this).attr('reply');
        var reply = $('#reply-' + id).val();

        $.ajax({
            url: "post-and-get/ajax/ad-reply.php",
            type: "POST",
            data: {
                id: id,
                reply: reply,
                option: 'UPDATEREPLY'
            },
            dataType: "JSON",
            success: function (result) {

                if (result) {
                    $('#reply-p-' + id).removeClass('hidden');
                    $('#reply-p-' + id).text(result.reply);
                    $('#reply-edit-form-' + id).addClass('hidden');
                    $('#reply-' + id).val('');
                }
            }
        });


        $('#reply-form-' + reply).removeClass('hidden');
        $('#reply-list-' + reply).removeClass('hidden');
    });
    $('.delete-reply').click(function () {
        var reply = this.id;

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this reply!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/ad-reply.php",
                type: "POST",
                data: {
                    id: reply,
                    option: 'DELETEREPLY'
                },
                async: false,
                dataType: 'json',
                success: function (result) {
                    swal({
                        title: "Deleted!",
                        text: "Reply has been deleted.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#li_r_' + reply).remove();
                }
            });
        });

    });

});