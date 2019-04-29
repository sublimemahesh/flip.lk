$(document).ready(function () {
    $('.boost-ad-link').click(function () {
        var adid = this.id;
        $('#send-boost-email').attr('adid', adid);
    });
    $('#send-boost-email').click(function () {

        if (!$('#boost_period').val() || $('#boost_period').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select boost period",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var adid = $(this).attr('adid');
            var period = $('#boost_period').val();

            $.ajax({
                type: 'POST',
                url: 'post-and-get/ajax/advertisement.php',
                dataType: "json",
                data: {
                    adid: adid,
                    period: period,
                    option: 'SENDBOOSTEMAIL'
                },
                success: function (result) {
                    if (result === 'success') {
                        swal({
                            title: "Success!",
                            text: "Your request has been sent successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#boost-ad').modal('hide');
                    } else {
                        swal({
                            title: "Error!",
                            text: "There was an error. Please try again later.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                    

                }
            });

        }

    });
});
