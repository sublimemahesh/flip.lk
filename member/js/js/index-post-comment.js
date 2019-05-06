$(document).ready(function () {
    $('#output').on('click', '.add-comment', function () {
        var post_id = this.id;
        $('#comment-form-' + post_id).removeClass('hidden');
        $('#comment-list-' + post_id).removeClass('hidden');
//        $('#output').find('#comment-list-' + post_id).removeClass('hidden');
    });
    $('#output').on('click', '.index-post-comment', function () {
        var post = $(this).attr('post');
        var type = $(this).attr('type');
        var member = $(this).attr('member');
        var comment = $('#comment-' + post).val();
        if (type == 'post') {
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
                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += '<img src="../upload/member/' + result.profile + '" alt="author">';
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
        } else {
            $.ajax({
                url: "post-and-get/ajax/ad-comment.php",
                type: "POST",
                data: {
                    ad: post,
                    member: member,
                    comment: comment,
                    option: 'ADDCOMMENT'
                },
                dataType: "JSON",
                success: function (result) {
                    if (result) {
                        $('#comment-' + post).val('');
                        var html = '';
                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += '<img src="../upload/member/' + result.profile + '" alt="author">';
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
        }





    });
    $(function () {
        $(".comments-list").each(function (index) {

            if ($(this).children(".comment-item").length > 3) {
                    var post = $(this).attr('post-id');
                    $("#see-more-" + post).removeClass('hidden');
                }
                $(this).children(".comment-item").slice(-3).show();
            });

//            $('.comments-list').on('click', '.see-more', function () {
//                alert(111);
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
        var type = $(this).attr('type');
        var p = $('#comment-p-' + comment).text();
        $('#comment-p-' + comment).addClass('hidden');

        if (type == '0') {
            $('#comment-edit-form-' + comment).removeClass('hidden');
            $('#comment-' + comment).val(p);
        } else {
            $('#shared-comment-edit-form-' + comment).removeClass('hidden');
            $('#shared-comment-' + comment).val(p);
        }
    });
    $('.ad-edit-comment').click(function () {
        var comment = this.id;
        var p = $('#ad-comment-p-' + comment).text();
        $('#ad-comment-p-' + comment).addClass('hidden');

        $('#ad-comment-edit-form-' + comment).removeClass('hidden');
        $('#ad-comment-' + comment).val(p);

    });
    $('.post-edited-cancel').click(function () {
        var comment = $(this).attr('comment');
        $('#comment-p-' + comment).removeClass('hidden');
        $('#comment-edit-form-' + comment).addClass('hidden');
        $('#comment-' + comment).val('');

    });
    $('.shared-post-edited-cancel').click(function () {
        var comment = $(this).attr('comment');
        $('#comment-p-' + comment).removeClass('hidden');
        $('#shared-comment-edit-form-' + comment).addClass('hidden');
        $('#shared-comment-' + comment).val('');

    });
    $('.ad-post-edited-cancel').click(function () {
        var comment = $(this).attr('comment');
        $('#ad-comment-p-' + comment).removeClass('hidden');
        $('#ad-comment-edit-form-' + comment).addClass('hidden');
        $('#ad-comment-' + comment).val('');

    });
    $('.post-edited-comment').click(function () {
        var id = $(this).attr('comment');
        var type = $(this).attr('type');
        var comment = $('#comment-' + id).val();

        if (type == 'post') {
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
        } else {
            $.ajax({
                url: "post-and-get/ajax/ad-comment.php",
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
        }




//        $('#comment-form-' + post).removeClass('hidden');
//        $('#comment-list-' + post).removeClass('hidden');
    });
    $('.shared-post-edited-comment').click(function () {
        var id = $(this).attr('comment');
        var type = $(this).attr('type');
        var comment = $('#shared-comment-' + id).val();

        if (type == 'post') {
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
                        $('#shared-comment-edit-form-' + id).addClass('hidden');
                        $('#shared-comment-' + id).val('');
                    }
                }
            });
        } else {
            $.ajax({
                url: "post-and-get/ajax/ad-comment.php",
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
                        $('#shared-comment-edit-form-' + id).addClass('hidden');
                        $('#shared-comment-' + id).val('');
                    }
                }
            });
        }




//        $('#comment-form-' + post).removeClass('hidden');
//        $('#comment-list-' + post).removeClass('hidden');
    });
    $('.ad-post-edited-comment').click(function () {
        var id = $(this).attr('comment');
        var comment = $('#ad-comment-' + id).val();

        $.ajax({
            url: "post-and-get/ajax/ad-comment.php",
            type: "POST",
            data: {
                id: id,
                comment: comment,
                option: 'UPDATECOMMENT'
            },
            dataType: "JSON",
            success: function (result) {

                if (result) {
                    $('#ad-comment-p-' + id).removeClass('hidden');
                    $('#ad-comment-p-' + id).text(result.comment);
                    $('#ad-comment-edit-form-' + id).addClass('hidden');
                    $('#ad-comment-' + id).val('');
                }
            }
        });

//        $('#comment-form-' + post).removeClass('hidden');
//        $('#comment-list-' + post).removeClass('hidden');
    });
    $('.delete-comment').click(function () {
        var comment = this.id;
        var type = $(this).attr('type');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this comment!",
            closeOnConfirm: false
        }, function () {
            if (type == 'post') {
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
            } else {
                $.ajax({
                    url: "post-and-get/ajax/ad-comment.php",
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
            }
        });

    });

});