$(document).ready(function () {
    $('.publish-advertisement').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to publish this advertisement?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, publish this advertisement!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/publish-advertisement.php",
                type: "POST",
                data: {id: id, option: 'PUBLISH'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Published!",
                            text: "This advertisement has been published.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        location.reload(); 

                    }
                }
            });
        });
    });
    $('.unpublish-advertisement').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to unpublish this advertisement!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Unpublish this advertisement!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/publish-advertisement.php",
                type: "POST",
                data: {id: id, option: 'UNPUBLISH'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Unpublished!",
                            text: "Advertisement has been unpublished.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        location.reload(); 

                    }
                }
            });
        });
    });
});

