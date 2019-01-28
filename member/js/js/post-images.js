$(document).ready(function () {
    $('#upload_first_image').change(function () {
        var fi = document.getElementById('upload_first_image'); // GET THE FILE INPUT.
        if (fi.files.length > 0) {

            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                if (Math.round((fsize / 1024)) > 10000) {
                    swal({
                        title: "Error!",
                        text: "Image is too large and please upload a image size less than 10MB",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return false;
                }
            }
        }
        var formData = new FormData($('#post-form')[0]);

        $.ajax({
            url: "post-and-get/ajax/post-images.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {

                var arr = mess.filename.split('.');
                var html = '';
                html += '<div class="_uploadedimagesbox" role="presentation" id="col_' + arr[0] + '">';
                html += '<div data-testid="media-attachment-photo">';
                html += '<span>';
                html += '<div class="_uploadedimages" style="width: 100px; height: 100px;" id="js_3mg" aria-controls="js_3mh" aria-haspopup="true">';
                html += '<img alt="Cute-baby-girl-pics-for-facebook-profile-4-1024x640.jpg" class="img" src="../upload/post/thumb2/' + mess.filename + '" width="100" height="100">';
                html += '<input type="hidden" name="post-all-images[]" value="' + mess.filename + '"/>';
                html += '<i class="img-post-delete _buttons _btn _removebtn _5upp _42ft fa fa-times" title="Remove Photo" id="' + arr[0] + '"></i>';
                html += '</div>';
                html += '</span>';
                html += '</div>';
                html += '</div>';

                $('.flipScrollableArea').removeClass('hidden');
                $('.flipScrollableAreaContent1').prepend(html);
                $('#upload_first_image').val('');

                if ($('#image-list ._uploadedimagesbox').length > 1) {
                    var left = $('._uploadouterbox').css('left');
                    var newleft = parseInt(left) + 100;
                    $('._uploadouterbox').css('left', newleft + 'px');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#add-more-photos').change(function () {

        var fi = document.getElementById('add-more-photos'); // GET THE FILE INPUT.
        if (fi.files.length > 0) {

            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                if (Math.round((fsize / 1024)) > 10000) {
                    swal({
                        title: "Error!",
                        text: "Image is too large and please upload a image size less than 10MB",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return false;
                }
            }
        }
        var formData = new FormData($('#post-form')[0]);

        $.ajax({
            url: "post-and-get/ajax/post-images.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {

                var arr = mess.filename.split('.');
                var html = '';

                html += '<div class="_uploadedimagesbox" role="presentation" id="col_' + arr[0] + '">';
                html += '<div data-testid="media-attachment-photo">';
                html += '<span>';
                html += '<div class="_uploadedimages" style="width: 100px; height: 100px;" id="js_3mg" aria-controls="js_3mh" aria-haspopup="true">';
                html += '<img alt="Cute-baby-girl-pics-for-facebook-profile-4-1024x640.jpg" class="img" src="../upload/post/thumb2/' + mess.filename + '" width="100" height="100">';
                html += '<input type="hidden" name="post-all-images[]" value="' + mess.filename + '"/>';
                html += '<i class="img-post-delete _buttons _btn _removebtn _5upp _42ft fa fa-times" title="Remove Photo" id="' + arr[0] + '"></i>';
                html += '</div>';
                html += '</span>';
                html += '</div>';
                html += '</div>';

                $('.flipScrollableAreaContent1').prepend(html);
                var left = $('._uploadouterbox').css('left');
                var newleft = parseInt(left) + 100;
                $('._uploadouterbox').css('left', newleft + 'px');


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#image-list').on('click', '.img-post-delete', function () {

        var image = this.id;

        $.ajax({
            url: 'post-and-get/ajax/post-images.php',
            type: "POST",
            dataType: "JSON",
            data: {
                image_name: image,
                option: 'DELETEIMAGE'
            },
            success: function (response) {
                $('#col_' + image).remove();
                var left = $('._uploadouterbox').css('left');
                if (left == '112px') {

                    $('.flipScrollableArea').addClass('hidden');
                } else {
                    var newleft = parseInt(left) - 100;
                    $('._uploadouterbox').css('left', newleft + 'px');
                }
            }
        });
    });


    $('#edit-post-section').on('change', '#upload_first_image_edit', function () {

        var fi = document.getElementById('upload_first_image_edit'); // GET THE FILE INPUT.
        if (fi.files.length > 0) {

            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                if (Math.round((fsize / 1024)) > 10000) {
                    swal({
                        title: "Error!",
                        text: "Image is too large and please upload a image size less than 10MB",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return false;
                }
            }
        }
        var formData = new FormData($('#edit-post-form')[0]);

        $.ajax({
            url: "post-and-get/ajax/post-images.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {

                var arr = mess.filename.split('.');
                var html = '';
                html += '<div class="_uploadedimagesbox_edit" role="presentation" id="col1_' + arr[0] + '">';
                html += '<div data-testid="media-attachment-photo">';
                html += '<span>';
                html += '<div class="_uploadedimages" style="width: 100px; height: 100px;" id="js_3mg" aria-controls="js_3mh" aria-haspopup="true">';
                html += '<img alt="Cute-baby-girl-pics-for-facebook-profile-4-1024x640.jpg" class="img" src="../upload/post/thumb2/' + mess.filename + '" width="100" height="100">';
                html += '<input type="hidden" name="post-all-images[]" value="' + mess.filename + '"/>';
                html += '<i class="img-edit-post-delete _buttons _btn _removebtn _5upp _42ft fa fa-times" title="Remove Photo" onClick="removePhoto(this)" id="' + arr[0] + '"></i>';
                html += '<input type="hidden" id="rem-photo" value="' + arr[0] + '"/>';
                html += '</div>';
                html += '</span>';
                html += '</div>';
                html += '</div>';

                $('.flipScrollableArea').removeClass('hidden');
                $('.flipScrollableAreaContent1').prepend(html);
                $('#upload_first_image_edit').val('');
                if ($('#image-list-edit ._uploadedimagesbox_edit').length > 1) {
                    var left = $('._uploadouterbox_edit').css('left');
                    var newleft = parseInt(left) + 100;
                    $('._uploadouterbox_edit').css('left', newleft + 'px');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });


    $('#edit-post-section').on('click', '#remove-post-image', function () {
        var id = $('#id').val();

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/post-images.php",
                type: "POST",
                data: {
                    post: id,
                    option: 'DELETEPOSTIMAGES'
                },
                async: false,
                dataType: 'json',
                success: function (result) {
                    if (result == 'success') {
                        
                        swal({
                            title: "Deleted!",
                            text: "Images has been deleted.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#gallery1').remove();
                        $('.panel-post').addClass('hidden');
                    }
                }
            });
        });
    });


/*not working*/
    $('#edit-post-section').on('change', '#add-more-photos-edit', function () {
alert(111);
        var fi = document.getElementById('add-more-photos-edit'); // GET THE FILE INPUT.
        if (fi.files.length > 0) {

            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                if (Math.round((fsize / 1024)) > 10000) {
                    swal({
                        title: "Error!",
                        text: "Image is too large and please upload a image size less than 10MB",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return false;
                }
            }
        }
        var formData = new FormData($('#edit-post-form')[0]);

        $.ajax({
            url: "post-and-get/ajax/post-images.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (mess) {

                var arr = mess.filename.split('.');
                var html = '';

                html += '<div class="_uploadedimagesbox_edit" role="presentation" id="col_' + arr[0] + '">';
                html += '<div data-testid="media-attachment-photo">';
                html += '<span>';
                html += '<div class="_uploadedimages" style="width: 100px; height: 100px;" id="js_3mg" aria-controls="js_3mh" aria-haspopup="true">';
                html += '<img alt="Cute-baby-girl-pics-for-facebook-profile-4-1024x640.jpg" class="img" src="../upload/post/thumb2/' + mess.filename + '" width="100" height="100">';
                html += '<input type="hidden" name="post-all-images[]" value="' + mess.filename + '"/>';
                html += '<i class="img-post-delete _buttons _btn _removebtn _5upp _42ft fa fa-times" title="Remove Photo" id="' + arr[0] + '"></i>';
                html += '</div>';
                html += '</span>';
                html += '</div>';
                html += '</div>';

                $('.flipScrollableAreaContent1').prepend(html);
                var left = $('._uploadouterbox_edit').css('left');
                var newleft = parseInt(left) + 100;
                $('._uploadouterbox_edit').css('left', newleft + 'px');


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    /*not working*/
    $('#edit-post-section').on('click', '.img-post-delete', function () {

        var image = this.id;

        $.ajax({
            url: 'post-and-get/ajax/post-images.php',
            type: "POST",
            dataType: "JSON",
            data: {
                image_name: image,
                option: 'DELETEIMAGE'
            },
            success: function (response) {
                $('#col_' + image).remove();
                var left = $('._uploadouterbox').css('left');
                if (left == '112px') {

                    $('.flipScrollableArea').addClass('hidden');
                } else {
                    var newleft = parseInt(left) - 100;
                    $('._uploadouterbox').css('left', newleft + 'px');
                }
            }
        });
    });
});

function removePhoto(input) {
    input.parentNode.remove();

    var left = $('._uploadouterbox_edit').css('left');

    if (left == '112px') {
        $('.flipScrollableArea').addClass('hidden');
    } else {
        var newleft = parseInt(left) - 100;
        $('._uploadouterbox_edit').css('left', newleft + 'px');
    }

    var input = document.getElementById('rem-photo');
    var image = input.defaultValue;
    $('#col1_' + image).addClass('removeItems');
    $.ajax({
        url: 'post-and-get/ajax/post-images.php',
        type: "POST",
        dataType: "JSON",
        data: {
            image_name: image,
            option: 'DELETEIMAGE'
        },
        success: function (response) {
            return true;
        }
    });
}