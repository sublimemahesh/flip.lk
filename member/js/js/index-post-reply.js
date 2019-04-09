$(document).ready(function () {
    $('#output').on('click', '.add-reply', function () {
        var comment_id = this.id;
        $('#reply-form-' + comment_id).removeClass('hidden');
    });

    $('#output').on('click', '.index-post-reply', function () {
        
        var comment = $(this).attr('comment');
        var type = $(this).attr('type');
        var member = $(this).attr('member');
        var reply =  $('#comment-reply-list-' + comment).find('#reply-' + comment).val();
        if (type == 'post') {
            
            $.ajax({
                url: "post-and-get/ajax/post-reply.php",
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


                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += '<img src="../upload/member/' + result.profile + '" alt="author">';
                        html += '<div class="author-date">';
                        html += '<a class="h6 post__author-name fn" href="profile.php?id=' + member + '">' + result.member + '</a>';
                        html += '<div class="post__date">';
                        html += '<time class="published" datetime="2017-03-24T18:18">';
                        html += 'just now';
                        html += '</time>';
                        html += '</div>';
                        html += '</div>';
                        html += '<a href="#" class="more">';
                        html += '<svg class="olymp-three-dots-icon">';
                        html += '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                        html += '</svg>';
                        html += '</a>';
                        html += '</div>';
                        html += '<p>' + result.reply + '</p>';
                        html += '<a class="reply add-reply" id="' + comment + '">Reply</a>';
                        html += '</li>';
                        alert(html);
                        $('#comment-reply-list-' + comment).append(html);
                    }
                }
            });

        } else {
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


                        html += '<li class="comment-item">';
                        html += '<div class="post__author author vcard inline-items">';
                        html += '<img src="../upload/member/' + result.profile + '" alt="author">';
                        html += '<div class="author-date">';
                        html += '<a class="h6 post__author-name fn" href="profile.php?id=' + member + '">' + result.member + '</a>';
                        html += '<div class="post__date">';
                        html += '<time class="published" datetime="2017-03-24T18:18">';
                        html += 'just now';
                        html += '</time>';
                        html += '</div>';
                        html += '</div>';
                        html += '<a href="#" class="more">';
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
        }
        $('#reply-form-' + comment).addClass('hidden');
        $('#reply-list-' + comment).removeClass('hidden');
    });
//    $(function () {
//        $(".comment-reply-list").each(function (index) {
//
//            if ($(this).children(".comment-reply-item").length > 1) {
//
//                var comment = $(this).attr('comment-id');
//                $("#see-more-replies-" + comment).removeClass('hidden');
//            }
//            $(this).children(".comment-reply-item").slice(-1).show();
//        });
//
//        $(".see-more-replies").click(function (e) {
//            e.preventDefault();
//            var $link = $(this);
//            var $div = $link.closest('.comment-reply-list');
//
//            if ($link.hasClass('visible')) {
//                $link.text('Show all replies');
//                $div.children(".comment-reply-item").slice(0, -1).slideUp()
//            } else {
//                $link.text('Show less replies');
//                $div.children(".comment-reply-item").slideDown();
//            }
//
//            $link.toggleClass('visible');
//        });
//    });

    $('.edit-reply').click(function () {
        var reply = this.id;
        var type = $(this).attr('type');
        var p = $('#reply-p-' + reply).text();
        $('#reply-p-' + reply).addClass('hidden');

        if (type == '0') {
            $('#reply-edit-form-' + reply).removeClass('hidden');
            $('#reply-' + reply).val(p);
        } else {
            $('#shared-reply-edit-form-' + reply).removeClass('hidden');
            $('#shared-reply-' + reply).val(p);
        }

    });
    $('.edit-ad-reply').click(function () {
        var reply = this.id;
        var p = $('#ad-reply-p-' + reply).text();

        $('#ad-reply-p-' + reply).addClass('hidden');

        $('#ad-reply-edit-form-' + reply).removeClass('hidden');
        $('#ad-reply-' + reply).val(p);

    });
    $('.reply-edited-cancel').click(function () {
        var reply = $(this).attr('reply');
        $('#reply-p-' + reply).removeClass('hidden');
        $('#reply-edit-form-' + reply).addClass('hidden');
        $('#reply-' + reply).val('');

    });
    $('.shared-reply-edited-cancel').click(function () {
        var reply = $(this).attr('reply');
        $('#reply-p-' + reply).removeClass('hidden');
        $('#shared-reply-edit-form-' + reply).addClass('hidden');
        $('#shared-reply-' + reply).val('');

    });
    $('.ad-reply-edited-cancel').click(function () {
        var reply = $(this).attr('reply');
        $('#ad-reply-p-' + reply).removeClass('hidden');
        $('#ad-reply-edit-form-' + reply).addClass('hidden');
        $('#ad-reply-' + reply).val('');

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
    $('.shared-post-edited-reply').click(function () {
        var id = $(this).attr('reply');
        var type = $(this).attr('type');
        var reply = $('#shared-reply-' + id).val();

        if (type == 'post') {
            $.ajax({
                url: "post-and-get/ajax/post-reply.php",
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
                        $('#shared-reply-edit-form-' + id).addClass('hidden');
                        $('#shared-reply-' + id).val('');
                    }
                }
            });
        } else {
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
                        $('#shared-reply-edit-form-' + id).addClass('hidden');
                        $('#shared-reply-' + id).val('');
                    }
                }
            });
        }


        $('#reply-form-' + reply).removeClass('hidden');
        $('#reply-list-' + reply).removeClass('hidden');
    });
    $('.ad-post-edited-reply').click(function () {
        var id = $(this).attr('reply');
        var reply = $('#ad-reply-' + id).val();

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
                    $('#ad-reply-p-' + id).removeClass('hidden');
                    $('#ad-reply-p-' + id).text(result.reply);
                    $('#ad-reply-edit-form-' + id).addClass('hidden');
                    $('#ad-reply-' + id).val('');
                }
            }
        });


        $('#reply-form-' + reply).removeClass('hidden');
        $('#reply-list-' + reply).removeClass('hidden');
    });
    $('.delete-reply').click(function () {
        var reply = this.id;
        var type = $(this).attr('type');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this reply!",
            closeOnConfirm: false
        }, function () {
            if (type == 'post') {
                $.ajax({
                    url: "post-and-get/ajax/post-reply.php",
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
            } else {

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
            }
        });

    });

});

