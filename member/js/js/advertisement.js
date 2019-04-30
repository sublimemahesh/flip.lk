$(document).ready(function () {
    $('#create-ad').click(function () {

        if (!$('#group').val() || $('#group').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the group first",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter title",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter address",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the city",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            
            var group = $('#group').val();
            var member = $('#member').val();
            var title = $('#title').val();
//            var description = tinyMCE.get('description').getContent();
            var description = $('#description').val();
            var city = $('#city').val();
            var cityString = $('#city_string').val();
            var address = $('#address').val();
            var category = $('#select-business-category').val();
            var subCategory = $('#sub-category').val();
            var website = $('#website').val();
            var price = $('#price').val();
            var phonenumber = $('#phonenumber').val();
            var email = $('#email').val();
//            var images = $('[name="post-all-images[]"]').serialize();
            var images = $('.post-all-ad-images').serializeArray();
            
            $.ajax({
                type: 'POST',
                url: 'post-and-get/ajax/advertisement.php',
                dataType: "json",
                data: {
                    group: group,
                    member: member,
                    title: title,
                    description: description,
                    city: city,
                    cityString: cityString,
                    address: address,
                    category: category,
                    subcategory: subCategory,
                    website: website,
                    price: price,
                    phonenumber: phonenumber,
                    email: email,
                    images: images,
                    option: 'SAVEAD'
                },
                success: function (result) {
                    swal({
                        title: "Success!",
                        text: "Your advertisement was posted successfully",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#form-create-ad')[0].reset();
                    $('.post-all-ad-images').val("");
                    $('._uploadedimagesbox').remove();

                    $('._uploadouterbox').css('left', '0px');
                }
            });
        }
    });

    $('#edit-ad').click(function () {

        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter title",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter address",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the city",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            
            var id = $('#id').val();
            var title = $('#title').val();
            var description = tinyMCE.get('description').getContent();
            var city = $('#city').val();
            var cityString = $('#city_string').val();
            var address = $('#address').val();
            var website = $('#website').val();
            var price = $('#price').val();
            var phonenumber = $('#phonenumber').val();
            var email = $('#email').val();
            var images = $('.post-all-ad-images').serializeArray();
            $.ajax({
                type: 'POST',
                url: 'post-and-get/ajax/advertisement.php',
                dataType: "json",
                data: {
                    id: id,
                    title: title,
                    description: description,
                    city: city,
                    cityString: cityString,
                    address: address,
                    website: website,
                    price: price,
                    phonenumber: phonenumber,
                    email: email,
                    images: images,
                    option: 'EDITAD'
                },
                success: function (result) {
                    swal({
                        title: "Success!",
                        text: "Your advertisement was updated successfully",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#form-create-ad')[0].reset();
                    $('.post-all-ad-images').val("");
                    $('._uploadedimagesbox').remove();

                    $('._uploadouterbox').css('left', '0px');
                }
            });

        }
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
                url: "post-and-get/ajax/ad-images.php",
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
    
    $('#publish-ad').click(function (e) {
        e.preventDefault();
        var status = $(this).attr('status');
        var id = $(this).attr('ad_id');
        if (status == 1) {
            swal({
                title: "Are you sure?",
                text: "Are you want to unpublished this group!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, unpublished it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/advertisement.php",
                    type: "POST",
                    data: {
                        id: id,
                        status: '0',
                        option: 'UPDATESTATUS'
                    },
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr.status) {

                            swal({
                                title: "Unpublished!",
                                text: "Your advertisement has been unpublished.",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            location.reload();
                        }
                    }
                });
            });
        } else {
            swal({
                title: "Are you sure?",
                text: "Are you want to published this advertisement!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, published it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/advertisement.php",
                    type: "POST",
                    data: {
                        id: id,
                        status: '1',
                        option: 'UPDATESTATUS'
                    },
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr.status) {

                            swal({
                                title: "Published!",
                                text: "Your advertisement has been published.",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});

