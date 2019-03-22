$(document).ready(function () {
    $("#login-first-btn").click(function () {
        var page_url = $(this).attr("page-url");
        $.ajax({
            url: "post-and-get/ajax/login-first.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                page_url: page_url,
                option: 'CREATESESSION'
            },
            success: function (result) {
                return true;
            }
        });
    });
});


