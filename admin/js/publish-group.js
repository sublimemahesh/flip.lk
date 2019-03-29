$(document).ready(function () {
    $('.publish-group').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to publish this group?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, publish this group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/publish-group.php",
                type: "POST",
                data: {id: id, option: 'PUBLISH'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Published!",
                            text: "This group has been published.",
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
    $('.unpublish-group').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to unpublish this group!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Unpublish this group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/publish-group.php",
                type: "POST",
                data: {id: id, option: 'UNPUBLISH'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Unpublished!",
                            text: "Group has been unpublished.",
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

