$(document).ready(function () {
    $('.alert-position').addClass('hidden');
    $("#btnRegister").click(function () {
        var datastring = $("#register").serialize();
        $.ajax({
            url: "post-and-get/ajax/add-member.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: datastring,
            success: function (result) {
                if (result.status === 'error') {
                    $('.alert-position').removeClass('hidden');
                    $('#message').text(result.message);
                    return false;
                } else if (result.status === 'success') {
                    window.location.replace('login2.php');
                } else if (result.status === 'notdelivered') {
                    if (result.back === '') {
                        window.location.replace('profile.php?message=22');
                    } else {
                        window.location = result.back;
                    }
                } else if (result.status === 'registered') {
                    window.location.replace('forgot-password.php?message=26');
                }
            }
        });
    });

    $('.btn-register').click(function() {
        $('#home').addClass('active');
        $('#home').addClass('show');
        $('#profile').removeClass('active');
        $('#profile').removeClass ('show');
        $('[href="#home"]').addClass('active');
        $('[href="#profile"]').removeClass('active');
    })

});