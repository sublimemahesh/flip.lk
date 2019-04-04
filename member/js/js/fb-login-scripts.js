
window.fbAsyncInit = function () {
    FB.init({
        appId: '2515349665205076',
        cookie: true,
        xfbml: true,
        version: 'v2.8'
    });
    FB.AppEvents.logPageView();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState() {


    var userID;
    var accessToken;
    var expiresIn;
    var signedRequest;
    var status;
    var name;
    var email;
    var picture;

    FB.login(function (response) {
        if (response.authResponse) {
            accessToken = response.authResponse.accessToken;
            expiresIn = response.authResponse.expiresIn;
            signedRequest = response.authResponse.signedRequest;
            status = response.status;
            FB.api('/me?fields=id,name,email,permissions,picture', function (response) {
                userID = response.id;
                name = response.name;
                email = response.email;
                picture = "https://graph.facebook.com/v2.12/" + userID + "/picture?height=250&width=250&access_token" + accessToken;

                $.ajax({
                    url: "post-and-get/ajax/fb-login.php",
                    type: "POST",
                    data: {
                        userID: userID,
                        name: name,
                        email: email,
                        picture: picture,
                        accessToken: accessToken,
                        expiresIn: expiresIn,
                        signedRequest: signedRequest,
                        status: status,
                        memberLogin: '1'
                    },
                    dataType: "JSON",
                    success: function (result) {
                       
                        if (result.message === 'success-log') {

                            if (result.back === '') {
                                window.location.replace("visitor-profile.php");
                            } else {
                                window.location = result.back;
                            }

                        } else if (result.message === 'success-cre') {
                            if (result.back === '') {
                                window.location.replace('visitor-profile.php?message=22');
                            } else {
                                window.location = result.back;
                            }

                        }
                    }
                });


            });
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {scope: 'public_profile,email'});
}


$(document).ready(function () {
    $('#fb-login').click(function () {
        checkLoginState();
    });
});