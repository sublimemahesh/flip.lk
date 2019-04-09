var googleUser = {};
var startApp = function () {
    gapi.load('auth2', function () {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '75588900629-8gegistgsfrbrald43buibgncs7t7qin.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin'
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('google-login'));
    });
};
var startApp1 = function () {
    gapi.load('auth2', function () {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '75588900629-8gegistgsfrbrald43buibgncs7t7qin.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin'
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
        });
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
                image = small_image + '?sz=300';

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
                    success: function (jsonStr) {
                        if (jsonStr.message = "success-log") {
                            window.location.replace("index.php");
                        }
                        if (jsonStr.message = "success-cre") {

                            window.location.replace("index.php");
                        }
                    }
                });

                    
            }, function (error) {
        // document.getElementById('google-error-display').innerText = "Something went wrong with google sign in";
        JSON.stringify(error, undefined, 2);
    });
}