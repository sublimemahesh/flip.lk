var googleUser = {};
//var startApp = function () {
function init() {
    gapi.load('auth2', function () {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '75588900629-33opn7tn9inl9lhfomba1bffmctjlb1h.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
            //client secret:  grXB3Tqf8P0KKrzca8vn2bJK 
        });
        attachSignin(document.getElementById('google-login'));
        attachSignin(document.getElementById('google-login1'));
    });
};

function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
            function (googleUser) {
                var profile = googleUser.getBasicProfile();

                var primaryEmail;
                var usrid;
                var name;
                var small_image;
                var image;

                primaryEmail = profile.getEmail();
                usrid = profile.getId();
                name = profile.getName();
                small_image = profile.getImageUrl();
                image = small_image + '?sz=500';

                $.ajax({
                    url: "post-and-get/ajax/google-login.php",
                    type: "POST",
                    data: {
                        userID: usrid,
                        name: name,
                        email: primaryEmail,
                        picture: image,
//            accessToken: primaryEmail,
//            expiresIn: expiresIn,
//            signedRequest: signedRequest,
//            status: status,
                        memberLogin: '1'
                    },
                    dataType: "JSON",
                    success: function (result) {
                        if (result.message === 'success-log') {

                            if (result.back === '') {
                                window.location.replace("./");
                            } else {
                                window.location = result.back;
                            }

                        } else if (result.message === 'success-cre') {
                            if (result.back === '') {
                                window.location.replace('./?message=22');
                            } else {
                                window.location = result.back;
                            }

                        }
                    }
                });

                     
            }, function (error) {
        document.getElementById('google-error-display').innerText = "Something went wrong with google sign in";
//        JSON.stringify(error, undefined, 2);
    });
}
$(document).ready(function () {
    $('#google-login').click(function () {
        console.log();
        init();
    });
});