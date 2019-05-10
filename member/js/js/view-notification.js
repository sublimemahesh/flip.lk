$(document).ready(function () {
    $('.notif-list').click(function () {
        var notification = $(this).attr('notification');

        $.ajax({
            url: "post-and-get/ajax/notification.php",
            type: "POST",
            data: {
                id: notification,
                option: 'UPDATE'
            },
            dataType: "JSON",
            success: function (result) {
//                $('#notif_' + notification).remove();
                return true;
            }
        });
    })
});

