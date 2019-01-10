$(document).ready(function () {

    $('#join-group-btn').click(function () {

        var member, group;
        member = $(this).attr('member-id');
        group = $(this).attr('group-id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                member: member,
                group: group,
                option: 'JOINGROUP'
            },
            dataType: 'json',
            success: function (mess) {
                $('#join-block').addClass('hidden');
                $('#request-cancel-block').removeClass('hidden');
                location.reload();
            }
        });
    });

    $('#cancel-request-btn').click(function () {

        var row_id;
        row_id = $(this).attr('row-id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'CANCELREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                $('#request-cancel-block').addClass('hidden');
                $('#join-block').removeClass('hidden');
                location.reload();
            }
        });
    });

    $('.approve-request').click(function () {
        alert(111);
        return false;
        var row = $(this).attr('row_id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row,
                option: 'APPROVEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                $('#request-to-join-' + mess.member).addClass('hidden');
                $('#accepted-request-' + mess.member).removeClass('hidden');

                var count = $('#member-request-count').text();
                $('#member-request-count').text(count - 1);
            }
        });
    });

    $('.decline-request').click(function () {

        var row_id;
        row_id = $(this).attr('row_id');

        $.ajax({
            url: "post-and-get/ajax/join-group.php",
            type: "POST",
            data: {
                row: row_id,
                option: 'DECLINEREQUEST'
            },
            dataType: 'json',
            success: function (mess) {
                location.reload();
            }
        });
    });

    $('#leave-group').click(function () {
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


