$(document).ready(function () {
    $('.add-comment').click(function () {
        var post_id = this.id;
        $('#comment-form-' + post_id).removeClass('hidden');
        $('#comment-list-' + post_id).removeClass('hidden');
    });
    $('.post-comment').click(function () {
        var post = $(this).attr('post');
        var member = $(this).attr('member');
        var comment = $('#comment-' + post).val();

        $.ajax({
            url: "post-and-get/ajax/comment.php",
            type: "POST",
            data: {
                post: post,
                member: member,
                comment: comment,
                option: 'ADDCOMMENT'
            },
            dataType: "JSON",
            success: function (result) {
                if (result) {
                    $('#comment-form-' + post).removeClass('hidden');
                    $('#comment-list-' + post).removeClass('hidden');
                    $('#comment-' + post).val('');
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
                    html += '<a class="h6 post__author-name fn" href="#">' + result.member + '</a>';
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
                    html += '<p>' + result.comment + '</p>';
                    html += '<a class="reply">Reply</a>';
                    html += '</li>';
                    $('#comment-list-' + post).append(html);
                }
            }
        });



    });
    $(function () {
        $(".comments-list").each(function (index) {
            if ($(this).children(".comment-item").length > 3) {
                var post = $(this).attr('post-id');
                $("#see-more-" + post).removeClass('hidden');
            }
            $(this).children(".comment-item").slice(-3).show();
        });

        $(".see-more").click(function (e) {
            e.preventDefault();
            var $link = $(this);
            var $div = $link.closest('.comments-list');

            if ($link.hasClass('visible')) {
                $link.text('Show all comments');
                $div.children(".comment-item").slice(0, -3).slideUp()
            } else {
                $link.text('Show less comments');
                $div.children(".comment-item").slideDown();
            }

            $link.toggleClass('visible');
        });
    });

    $('.edit-comment').click(function () {
        var comment = this.id;
        var p = $('#comment-p-' + comment).text();
        $('#comment-p-' + comment).addClass('hidden');
        $('#comment-edit-form-' + comment).removeClass('hidden');
        $('#comment-' + comment).val(p);

    });
    $('.post-edited-cancel').click(function () {
        var comment = $(this).attr('comment');
        $('#comment-p-' + comment).removeClass('hidden');
        $('#comment-edit-form-' + comment).addClass('hidden');
        $('#comment-' + comment).val('');

    });
    $('.post-edited-comment').click(function () {
        var id = $(this).attr('comment');
        var comment = $('#comment-' + id).val();

        $.ajax({
            url: "post-and-get/ajax/comment.php",
            type: "POST",
            data: {
                id: id,
                comment: comment,
                option: 'UPDATECOMMENT'
            },
            dataType: "JSON",
            success: function (result) {

                if (result) {
                    $('#comment-p-' + id).removeClass('hidden');
                    $('#comment-p-' + id).text(result.comment);
                    $('#comment-edit-form-' + id).addClass('hidden');
                    $('#comment-' + id).val('');
                }
            }
        });


//        $('#comment-form-' + post).removeClass('hidden');
//        $('#comment-list-' + post).removeClass('hidden');
    });
    $('.delete-post').click(function () {
        var comment = this.id;

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this comment!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/comment.php",
                type: "POST",
                data: {
                    id: comment,
                    option: 'DELETECOMMENT'
                },
                async: false,
                dataType: 'json',
                success: function (result) {
                    swal({
                        title: "Deleted!",
                        text: "Comment has been deleted.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('#li_' + comment).remove();
                }
            });
        });

    });

});
