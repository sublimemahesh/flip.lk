$(document).ready(function () {
    $('.delete-ad').click(function () {

        var adid = this.id;
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this advertisement!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/advertisement.php",
                type: "POST",
                data: {
                    ad: adid,
                    option: 'DELETEAD'
                },
                async: false,
                dataType: 'json',
                success: function (result) {

                    swal({
                        title: "Deleted!",
                        text: "Advertisement has been deleted.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('.ad_' + adid).remove();
                }
            });
        });
    });
    
    $('#delete-ad').click(function () {

        var adid = $(this).attr('ad_id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this advertisement!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/advertisement.php",
                type: "POST",
                data: {
                    ad: adid,
                    option: 'DELETEAD'
                },
                async: false,
                dataType: 'json',
                success: function (result) {

                    swal({
                        title: "Deleted!",
                        text: "Advertisement has been deleted.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('.ad_' + adid).remove();
                }
            });
        });
    });
});