$(document).ready(function () {
    $('.suspend-member').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, suspend member!",
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
                            title: "Suspended!",
                            text: "Member has been suspended.",
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
            confirmButtonText: "Yes, remove suspended!",
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
                            title: "Removed!",
                            text: "Member's suspend has been removed.",
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

