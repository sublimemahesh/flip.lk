$(document).ready(function () {
    $('.delete-post').click(function () {

        var postid = this.id;
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this post!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/post.php",
                type: "POST",
                data: {
                    post: postid,
                    option: 'DELETEPOST'
                },
                async: false,
                dataType: 'json',
                success: function (result) {

                    swal({
                        title: "Deleted!",
                        text: "Post has been deleted.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('.post_' + postid).remove();
                }
            });
        });
    });
});

