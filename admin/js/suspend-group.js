$(document).ready(function () {
    $('.suspend-group').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to suspend this group?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, suspend this group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/suspend-group.php",
                type: "POST",
                data: {id: id, option: 'SUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Suspended!",
                            text: "This group has been suspended.",
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
    $('.remove-ad-suspend').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to remove suspend?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, remove suspend!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/suspend-group.php",
                type: "POST",
                data: {id: id, option: 'REMOVESUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Removed!",
                            text: "Group's suspend has been removed.",
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

