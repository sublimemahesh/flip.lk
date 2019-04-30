<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$back_url = '';
if (isset($_SESSION["back_url"])) {
    $back_url = $_SESSION["back_url"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log in || Flip.lk</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
        <script src="js/js/google-login.js" type="text/javascript"></script>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Main Font -->
        <script src="js/webfontloader.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:300,400,500,700:latin']
                }
            });
        </script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>


    </head>
    <body class="landing-page">
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <div class="container login-container body-content">
            <a href="post-and-get/ajax/google-login.php"></a>
            <div class="row">
                <div class="col col-xl-6 order-xl-1 col-lg-6 order-lg-1 col-md-12 col-sm-12 col-12 form-login">
                    <div class="form">

                        <ul class="tab-group">
                            <li class="tab active"><a href="#login">Log In</a></li>
                            <li class="tab"><a href="#signup">Sign Up</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="login">   
                                <h1>Welcome Back!</h1>

                                <div class="top-bott20 m-l-25 m-r-15">
                                    <?php
                                    if (isset($_GET['message'])) {

                                        $MESSAGE = New Message($_GET['message']);
                                        ?>
                                        <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                            <?php echo $MESSAGE->description; ?>
                                        </div>
                                        <?php
                                    }

                                    $vali = new Validator();

                                    $vali->show_message();
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left fb-login" id="fb-login"><i class="fab fa-facebook-f" aria-hidden="true"></i>Login with Facebook</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-lg bg-google full-width btn-icon-left google-login" id="google-login"><i class="fab fa-google" aria-hidden="true"></i>Login with Google</a>
                                        <script>startApp();</script>
                                    </div>
                                </div>
                                <div class="or"></div>
                                <form  action="post-and-get/member.php" method="post">
                                    <div class="field-wrap">
                                        <label>
                                            Email Address<span class="req">*</span>
                                        </label>
                                        <input type="email" required autocomplete="off"  name="email"/>
                                    </div>
                                    <div class="field-wrap">
                                        <label>
                                            Password<span class="req">*</span>
                                        </label>
                                        <input type="password" required autocomplete="off"  name="password"/>
                                    </div>
                                    <p class="forgot"><a href="forgot-password.php">Forgot Password?</a></p>
                                    <input type="hidden" class="form-control"  name="back_url" value="<?php echo $back_url; ?>">
                                    <button type="submit" class="button button-block" name="login"/>Log In</button>

                                </form>
                            </div>
                            <div id="signup">   
                                <h1>Sign Up for Free</h1>
                                <div class="top-bott20 m-l-25 m-r-15">
                                    <?php
                                    if (isset($_GET['message'])) {

                                        $MESSAGE = New Message($_GET['message']);
                                        ?>
                                        <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                            <?php echo $MESSAGE->description; ?>
                                        </div>
                                        <?php
                                    }

                                    $vali = new Validator();

                                    $vali->show_message();
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left fb-login" id="fb-login"><i class="fab fa-facebook-f" aria-hidden="true"></i>Sign up with Facebook</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-lg bg-google full-width btn-icon-left google-login" id="google-login1"><i class="fab fa-google" aria-hidden="true"></i>Sign up with Google</a>
                                        <script>startApp1();</script>
                                    </div>
                                </div>
                                <div class="or"></div>

                                <form id="register" action="#">
                                    <div class="top-row">
                                        <div class="field-wrap">
                                            <label>
                                                First Name<span class="req">*</span>
                                            </label>
                                            <input type="text" required autocomplete="off" name="fname" />
                                        </div>

                                        <div class="field-wrap">
                                            <label>
                                                Last Name<span class="req">*</span>
                                            </label>
                                            <input type="text"required autocomplete="off" name="lname"/>
                                        </div>
                                    </div>

                                    <div class="field-wrap">
                                        <label>
                                            Email Address<span class="req">*</span>
                                        </label>
                                        <input type="email"required autocomplete="off" name="email"/>
                                    </div>

                                    <div class="field-wrap">
                                        <label>
                                            Password<span class="req">*</span>
                                        </label>
                                        <input type="password"required autocomplete="off" name="password"/>
                                    </div>
                                    <div class="field-wrap">
                                        <label>
                                            Confirm Password<span class="req">*</span>
                                        </label>
                                        <input type="password"required autocomplete="off" name="cpassword"/>
                                    </div>
                                    <a class="button button-block" id="btnRegister"/>Sign Up Now</a>
                                    <input type="hidden" name="save"  value="">
                                </form>

                            </div>
                        </div><!-- tab-content -->
                    </div> <!-- /form -->
                </div>
                <div class="col col-xl-6 order-xl-1 col-lg-6 order-lg-1 col-md-12 col-sm-12 col-12 slider-banner">
                    <div class="banner-sec">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="image/slider1.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="image/slider2.jpg" alt="First slide">	
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="image/slider3.jpg" alt="First slide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <!--custom js-->
        <script src="js/js/add-member.js" type="text/javascript"></script>
        <script src="js/js/login.js" type="text/javascript"></script>
        <script src="js/js/fb-login-scripts.js" type="text/javascript"></script>


    </body>
</html>