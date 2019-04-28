$(document).ready(function () {
    $('.boost-ad-link').click(function () {
        var adid = this.id;
        $('#send-boost-email').attr('adid', adid);
    });
    $('#send-boost-email').click(function () {

        if (!$('#boostFrom').val() || $('#boostFrom').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the date which you need to start boosting ad",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#boostTo').val() || $('#boostTo').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the date which you need to stop boosting ad",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var adid = $(this).attr('adid');
            var fromdate = $('#boostFrom').val();
            var todate = $('#boostTo').val();

            $.ajax({
                type: 'POST',
                url: 'post-and-get/ajax/advertisement.php',
                dataType: "json",
                data: {
                    adid: adid,
                    fromdate: fromdate,
                    todate: todate,
                    option: 'SENDBOOSTEMAIL'
                },
                success: function (result) {
                    if (result === 'success') {
                        swal({
                            title: "Success!",
                            text: "Your enquiry has been sent successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "Success!",
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
