$(document).ready(function () {
    if ($('#c').val() == 'c') {
        $('#cover-pic-upload').css('display', 'block');
        $('#profile-pic-upload').css('display', 'none');
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
                } else if(result.back) {
                    window.location.replace(result.back);
                }

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
