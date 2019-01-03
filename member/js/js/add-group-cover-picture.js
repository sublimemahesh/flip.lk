$(document).ready(function () {
   
   $('.proimg').empty();

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $('#group-cover-picture').change(function () {
        readURL(this);
        var formData = new FormData($('#form-group')[0]);

        $.ajax({
            url: "post-and-get/ajax/group-cover-picture.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {
                var html = '';
                $('.group-cover-default-image').css('display', 'none');
                $('#group-cover').val(mess);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
