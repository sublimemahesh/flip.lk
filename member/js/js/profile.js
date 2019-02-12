$(document).ready(function() {
   $('#active-profile').click(function (e) {
        e.preventDefault();
        var status = $(this).attr('status');
        var id = $(this).attr('member_id');
        if (status == 1) {
            swal({
                title: "Are you sure?",
                text: "Are you want to Deactive your account!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Deactive it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/profile.php",
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
                                title: "Inactivated!",
                                text: "Your account has been deactivated.",
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
                text: "Are you want to active this account!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, active it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/profile.php",
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
                                title: "Activated!",
                                text: "Your account has been activated.",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                        location.reload();
                    }
                });
            });
        }
    });
    
    $('#delete-profile').click(function (e) {
        var id = $(this).attr('profile_id');
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
                    url: "post-and-get/ajax/profile.php",
                    type: "POST",
                    data: {
                        id: id,
                        status: '0',
                        option: 'DELETEPROFILE'
                    },
                    dataType: "JSON",
                    success: function (jsonStr) {
                        if (jsonStr) {

                            swal({
                                title: "Deleted!",
                                text: "Your profile has been deleted.",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            window.location.replace('manage-groups.php');
                        }
                    }
                });
            });
    }); 
});


