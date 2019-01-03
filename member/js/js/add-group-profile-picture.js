$(document).ready(function () {

    $('.proimg').empty();

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#group-profile-picture').change(function () {
        readURL(this);
        var formData = new FormData($('#form-group')[0]);

        $.ajax({
            url: "post-and-get/ajax/group-profile-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var html = '';
                $('.group-profile-default-image').css('display', 'none');
                $('#group-pro').val(mess);
//                window.location.replace('create-group.php');
//                alert(111);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
//
//
//    function readURL(input) {
//
//        if (input.files && input.files[0]) {
//            var reader = new FileReader();
//
//            reader.onload = function (e) {
//                console.log(e.target);
//                return false;
//                $('#blah').attr('src', e.target.result);
//                $('#group_profile').val()
//            }
//
//            reader.readAsDataURL(input.files[0]);
//        }
//    }
//
//    $("#group-profile-picture").change(function () {
//
//        readURL(this);
//    });
});