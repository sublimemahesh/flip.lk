$(document).ready(function () {

    if ($('#c').val() == 'c') {

        $('#cover-pic-upload').css('display', 'block');
        $('#profile-pic-upload').css('display', 'none');
    }
    $(".progressbar-section").hide();
    $('#cover-picture').change(function () {
        $(".progressbar-section").show();
        var formData = new FormData($('#form-cover-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/cover-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var elem = document.getElementById("myBar2");
                var width = 1;
                var id = setInterval(frame, 10);
                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        $(".progress-label").text("Complete");
                        setTimeout(function () {

                            $(".progressbar-section").hide();
                            var html = '';
                            $('.cover-default-image').css('display', 'none');
                            $('#cover').val(mess);
                            window.location.replace('login2.php?c');
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

    $('#upload-cover-pic').click(function (e) {
        e.preventDefault();

        var formData = new FormData($('#form-cover-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/cover-picture-upload.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (result) {
                if (result.response === 'success') {
                    window.location.replace('index.php');
                } else if (result.back) {
                    window.location.replace(result.back);
                }

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
