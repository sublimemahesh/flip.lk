$(document).ready(function () {
    $('.suspend-advertisement').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to suspend this advertisement?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, suspend this advertisement!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/suspend-advertisement.php",
                type: "POST",
                data: {id: id, option: 'SUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Suspended!",
                            text: "This advertisement has been suspended.",
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
                url: "ajax/suspend-advertisement.php",
                type: "POST",
                data: {id: id, option: 'REMOVESUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Removed!",
                            text: "Advertisement's suspend has been removed.",
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

