$(document).ready(function () {
    $('.add-comment').click(function () {
        var ad_id = this.id;
        $('#comment-form-' + ad_id).removeClass('hidden');
        $('#comment-list-' + ad_id).removeClass('hidden');
    });
    $('.post-comment').click(function () {
        var ad = $(this).attr('ad');
        var member = $(this).attr('member');
        var comment = $('#comment-' + ad).val();

        $.ajax({
            url: "post-and-get/ajax/ad-comment.php",
            type: "POST",
            data: {
                ad: ad,
                member: member,
                comment: comment,
                option: 'ADDCOMMENT'
            },
            dataType: "JSON",
            success: function (result) {
                if (result) {
                    $('#comment-' + ad).val('');
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
                    html += '<a href="#" class="more">';
                    html += '<svg class="olymp-three-dots-icon">';
                    html += '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                    html += '</svg>';
                    html += '</a>';
                    html += '</div>';
                    html += '<p>' + result.comment + '</p>';
                    html += '<a href="#" class="reply">Reply</a>';
                    html += '</li>';
                    $('#comment-list-' + ad).append(html);
                }
            }
        });


        $('#comment-form-' + ad).removeClass('hidden');
        $('#comment-list-' + ad).removeClass('hidden');
    });
    $(function () {
        $(".comments-list").each(function (index) {
            if ($(this).children(".comment-item").length > 3) {
                var ad = $(this).attr('ad-id');
                $("#see-more-" + ad).removeClass('hidden');
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


//        $('#comment-form-' + post).removeClass('hidden');
//        $('#comment-list-' + post).removeClass('hidden');
    });
    $('.delete-comment').click(function () {
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
        });
       
    });
    
});

