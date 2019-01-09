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

    $('#approve-request').click(function () {
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
                $('#request-cancel-block').addClass('hidden');
                $('#join-block').removeClass('hidden');
                location.reload();
            }
        });
    });
});


