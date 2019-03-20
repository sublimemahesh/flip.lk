$(document).ready(function () {

//    $('.proimg').empty();
    $('#profile-picture').change(function () {

        var formData = new FormData($('#form-profile-picture')[0]);

        $.ajax({
            url: "post-and-get/ajax/profile-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var html = '';
//                html = '<img class="pro-pic" src="../upload/member/' + mess + '" alt=""/>';

                $('.profile-default-image').css('display', 'none');
//                $('.proimg').empty();
//                $('.proimg').append(html);
                $('#pro').val(mess);
                window.location.replace('login2.php');



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
