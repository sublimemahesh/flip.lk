$(document).ready(function () {
    $(".progressbar-section").hide();
//    $('.proimg').empty();
    $('#profile-picture').change(function () {
        $(".progressbar-section").show();
        var formData = new FormData($('#form-profile-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/profile-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var elem = document.getElementById("myBar");
                var width = 1;
                var id = setInterval(frame, 10);
                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        $(".progress-label").text("Complete");
                        setTimeout(function () {

                            $(".progressbar-section").hide();
                            var html = '';
                            $('.profile-default-image').css('display', 'none');
                            $('#pro').val(mess);
                            window.location.replace('login2.php');
                            elem.style.width = '1%';
                            $(".progress-label").text("Loading...");
                        }, 1000);
                    } else {
                        width++;
                        elem.style.width = width + '%';
                        $(".progress-label").text(width + "%");
                    }
                }






            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#upload-pro-pic').click(function (e) {

        e.preventDefault();

        var formData = new FormData($('#form-profile-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/profile-picture-upload.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (result) {
                if (result.response === 'success') {
                    $('#cover-pic-upload').css('display', 'block');
                    $('#profile-pic-upload').css('display', 'none');
                }


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
