$(document).ready(function () {

    $('#btn-group').click(function () {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#group-name').val() || $('#group-name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the group name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "Please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#select-business-category').val() || $('#select-business-category').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#sub-category').val() || $('#sub-category').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the sub category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the address",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;

        } else if (!$('#district').val() || $('#district').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the district",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the city",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            return true;
        }
    });

    $('#active-group').click(function (e) {
        e.preventDefault();
        var status = $(this).attr('status');
        var id = $(this).attr('group_id');
        if (status == 1) {
            swal({
                title: "Are you sure?",
                text: "Are you want to inactive this group!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, inactive it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/group.php",
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
                                text: "Your group has been inactivated.",
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
                text: "Are you want to active this group!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, active it!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "post-and-get/ajax/group.php",
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
                                text: "Your group has been activated.",
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

    $('#delete-group').click(function (e) {
        var id = $(this).attr('group_id');
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
                url: "post-and-get/ajax/group.php",
                type: "POST",
                data: {
                    id: id,
                    status: '0',
                    option: 'DELETEGROUP'
                },
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr) {

                        swal({
                            title: "Deleted!",
                            text: "Your group has been deleted.",
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

    $('.confirm-invitation').click(function () {

        var row = $(this).attr('row_id');
        alert(row);
        $.ajax({
            url: "post-and-get/ajax/group.php",
            type: "POST",
            data: {
                row: row,
                option: 'CONFIRMINVITATION'
            },
            dataType: 'json',
            success: function (mess) {
                $('#request-to-join-' + mess.groupId).addClass('hidden');
                $('#accepted-invititation-' + mess.groupId).removeClass('hidden');

                var count = $('#group-invitation-count').text();
                $('#group-invitation-count').text(count - 1);
            }
        });
    });

    $('.delete-invitation').click(function () {

        var row_id;
        row_id = $(this).attr('row_id');

        $.ajax({
            url: "post-and-get/ajax/group.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'DELETEINVITATION'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });

    $('.remove-member').click(function () {

        var member, group;
        member = $(this).attr('member');
        group = $(this).attr('group');

        $.ajax({
            url: "post-and-get/ajax/group.php",
            type: "POST",
            data: {
                member: member,
                group: group,
                option: 'REMOVEMEMBER'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });
});