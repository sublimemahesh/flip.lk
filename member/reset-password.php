<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
if (!isset($_SESSION)) {
    session_start();
}
$CATEGORIES = BusinessCategory::all();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reset Password || Flip.lk</title>
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
                    <div class="tab-content">
                        <div id="forgot-password">   
                            <h1>Reset Password</h1>
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
                            <p>Please check your email for your code. Your code is 5 characters in length.</p>
                            <form class="content" id="register" action="post-and-get/member.php" method="post">
                                <div class="field-wrap">
                                    <label>
                                        Password Reset Code<span class="req">*</span>
                                    </label>
                                    <input type="text" required autocomplete="off"  name="code"/>
                                </div>
                                <div class="field-wrap">
                                    <label>
                                        Password<span class="req">*</span>
                                    </label>
                                    <input type="password" required autocomplete="off"  name="password"/>
                                </div>
                                <div class="field-wrap">
                                    <label>
                                        Confirm Password<span class="req">*</span>
                                    </label>
                                    <input type="password" required autocomplete="off"  name="cpassword"/>
                                </div>
                                <button type="submit" class="button button-block" name="reset-password"/>Reset Password</button>
                            </form>
                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->
            </div>
            <!-- JS Scripts -->
            <script src="js/jquery-3.2.1.js"></script>
            <script defer src="fonts/fontawesome-all.js"></script>
            <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
            <script src="js/js/login.js" type="text/javascript"></script>
            <!--custom js-->
    </body>
</html>