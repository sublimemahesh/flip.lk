$(document).ready(function () {
    $('.confirm-request').click(function () {
        
        var row = $(this).attr('row_id');
        $.ajax({
            url: "post-and-get/ajax/friend-request.php",
            type: "POST",
            data: {
                row: row,
                option: 'CONFIRMREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                $('.request-to-join-' + mess.member).addClass('hidden');
                $('#accepted-request-' + mess.member).removeClass('hidden');

                var count = $('#member-request-count').text();
                $('#member-request-count').text(count - 1);
            }
        });
    });

    $('.delete-request').click(function () {

        var row_id;
        row_id = $(this).attr('row_id');
alert(row_id);
        $.ajax({
            url: "post-and-get/ajax/friend-request.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'DELETEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });
    
    $('#confirm-request').click(function () {
        
        var row = $(this).attr('row-id');
        $.ajax({
            url: "post-and-get/ajax/friend-request.php",
            type: "POST",
            data: {
                row: row,
                option: 'CONFIRMREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });

    $('#delete-request').click(function () {

        var row_id;
        row_id = $(this).attr('row-id');

        $.ajax({
            url: "post-and-get/ajax/friend-request.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'DELETEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });

    $('#unfollow-friend').click(function () {
        
        var member, friend, row;
        row = $(this).attr('row-id');
        member = $(this).attr('member-id');
        friend = $(this).attr('friend-id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Unfollow!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/friend-request.php",
                type: "POST",
                data: {
                    row: row,
                    member: member,
                    friend: friend,
                    option: 'UNFOLLOW'
                },
                dataType: 'json',
                success: function (mess) {
                    location.reload();
                }
            });
        });
    });
    
    $('.leave-group').click(function () {

        var member, group;
        member = $(this).attr('member-id');
        group = $(this).attr('group-id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Leave from group!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "post-and-get/ajax/join-group.php",
                type: "POST",
                data: {
                    member: member,
                    group: group,
                    option: 'LEAVEGROUP'
                },
                dataType: 'json',
                success: function (mess) {
                    location.reload();
                }
            });
        });
    });
});


