<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
if (!isset($_SESSION)) {
    session_start();
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
        <div class="container index-container body-content">

            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
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
                                    <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fab fa-facebook-f" aria-hidden="true"></i>Login with Facebook</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fab fa-twitter" aria-hidden="true"></i>Login with Twitter</a>
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
                                <p class="forgot"><a href="#">Forgot Password?</a></p>
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
                                    <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fab fa-facebook-f" aria-hidden="true"></i>Sign up with Facebook</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fab fa-twitter" aria-hidden="true"></i>Sign up with Twitter</a>
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


                                <a class="button button-block" id="btnRegister"/>Sing Up Now</a>
                                <input type="hidden" name="save"  value="">
                            </form>

                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->
            </div>
        </div>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <!--custom js-->
        <script src="js/js/add-member.js" type="text/javascript"></script>
        <script src="js/js/login.js" type="text/javascript"></script>

    </body>
</html>