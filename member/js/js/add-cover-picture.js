$(document).ready(function () {
    if ($('#c').val() == 'c') {
        $('.nav-link').click();
    }
    $('#cover-picture').change(function () {
        var formData = new FormData($('#form-cover-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/cover-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var html = '';
                $('.cover-default-image').css('display', 'none');
                $('#cover').val(mess);
                window.location.replace('login2.php?c');
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
                }

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});