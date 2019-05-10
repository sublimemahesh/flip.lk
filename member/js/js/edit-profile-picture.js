$(document).ready(function () {
    $(".progressbar-section").hide();
    $('#profile-picture').change(function () {
        $(".progressbar-section").show();
        var fi = document.getElementById('profile-picture'); // GET THE FILE INPUT.
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

        var formData = new FormData($('#edit-profile-picture-form')[0]);

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
                            $("#profile_pic").attr("src", "../upload/member/" + mess.filename);
                            $("#profile_pic1").attr("src", "../upload/member/" + mess.filename);
                            $("#profile_pic2").attr("src", "../upload/member/" + mess.filename);
                            $('#update-profile-photo').modal('hide');
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
                    $('.nav-link').click();
                }


            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

});
