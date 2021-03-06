$(document).ready(function () {
    setTimeout(function () {
        if ($('#gallery img').length > 0) {
            $('#remove-circle').show();
        } else {
            $('#remove-circle').hide();
        }
    }, 3000);



    $('#add-more-photos').change(function () {

        $('.flipScrollableArea').removeClass('hidden');
        $('._uploadloaderbox').css('display', 'inline-block');
        var left = $('._uploadouterbox').css('left');
        var newleft = parseInt(left) + 110;
        $('._uploadouterbox').css('left', newleft + 'px');


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
        var formData = new FormData($('#form-edit-ad')[0]);
        alert(111);
        $.ajax({
            url: "ajax/ad-images.php",
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
                html += '<img alt="IMAGE" class="img" src="../upload/advertisement/thumb2/' + mess.filename + '" width="100" height="100">';
                html += '<input type="hidden" name="post-all-images[]" class="post-all-ad-images" value="' + mess.filename + '"/>';
                html += '<i class="img-post-delete _buttons _btn _removebtn _5upp _42ft fa fa-times" title="Remove Photo" id="' + arr[0] + '"></i>';
                html += '</div>';
                html += '</span>';
                html += '</div>';
                html += '</div>';

                $('.flipScrollableArea').removeClass('hidden');
                $('._uploadloaderbox').css('display', 'none');
                $('.flipScrollableAreaContent1').prepend(html);
                $('#add-more-photos').val('');

                var left1 = $('._uploadloaderbox').css('left');
                var newleft1 = parseInt(left1) + 110;
                $('._uploadloaderbox').css('left', newleft1 + 'px');


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#image-list').on('click', '.img-post-delete', function () {

        var image = this.id;

        $.ajax({
            url: 'post-and-get/ajax/ad-images.php',
            type: "POST",
            dataType: "JSON",
            data: {
                image_name: image,
                option: 'DELETEIMAGE'
            },
            success: function (response) {
                $('#col_' + image).remove();
                var left = $('._uploadouterbox').css('left');
                var newleft = parseInt(left) - 110;
                $('._uploadouterbox').css('left', newleft + 'px');

                var left1 = $('._uploadloaderbox').css('left');
                var newleft1 = parseInt(left1) - 110;
                $('._uploadloaderbox').css('left', newleft1 + 'px');
            }
        });
    });

    $('#remove-circle').on('click', '#remove-ad-image', function () {
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
                url: "ajax/ad-images.php",
                type: "POST",
                data: {
                    ad: id,
                    option: 'DELETEADIMAGES'
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
                        $('#gallery').remove();
                        $('#remove-ad-image').addClass('hidden');
                    }
                }
            });
        });
    });



    function loader() {

        "use strict";
        var element = $('<div class="loader"></div>').css({
            width: 100,
            height: 100,
            border: '0px'
        }).appendTo('._uploadloaderbox');
        element.canvasLoader({
            color: '#ff0000'
        });
        element.canvasLoader(false);
        element.canvasLoader(true);
//    $(element).trigger('stop.canvasLoader');
//    element.canvasLoader.options.color = '#008000';
        $(element).trigger('start.canvasLoader');
        $.fn.canvasLoader.options.color = '#0000ff';
        var version = $.fn.canvasLoader.version;
    }
    ;
    function stoploader() {

        "use strict";
        var element = $('<div class="loader"></div>').css({
            width: 100,
            height: 100,
            border: '0px'
        }).appendTo('._uploadloaderbox');
        element.canvasLoader({
            color: '#ff0000'
        });
        element.canvasLoader(false);
        element.canvasLoader(true);
        $(element).trigger('stop.canvasLoader');
        element.canvasLoader.options.color = '#008000';
//    $(element).trigger('start.canvasLoader');
//    $.fn.canvasLoader.options.color = '#0000ff';
        var version = $.fn.canvasLoader.version;
    }
    ;

});