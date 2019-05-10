$(document).ready(function () {
    $('.suspend-member').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Deactive member!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/suspend-member.php",
                type: "POST",
                data: {id: id, option: 'SUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Deactivated!",
                            text: "Member has been deactivated.",
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
    $('.remove-suspend').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Active member!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "ajax/suspend-member.php",
                type: "POST",
                data: {id: id, option: 'REMOVESUSPEND'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Activated!",
                            text: "Member has been activated.",
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

