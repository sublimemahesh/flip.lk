<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$CONTACTUS = New Page(7);
$PHONE_NUMBER1 = New Page(8);
$PHONE_NUMBER2 = New Page(9);
$EMAIL = New Page(10);
$LOCATION = New Page(11);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Contact Us || Flip.lk</title>

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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/flaticon.css" rel="stylesheet" type="text/css"/>
        <link href="contact-us-form/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <?php
        include './banner.php';
        ?>
        <div class="">


            <div class="row">
                <!-- Main Content -->
                <main class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                    <section class="about-section-values ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 intro-section1">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="ui-block-content">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="company-contact-info-area">
                                                        <div class="office">
                                                            <h3>Contact No</h3>
                                                            <div class="icon">
                                                                <img src="img/icon/about-us-icon/phone-call.png" alt=""/>
                                                            </div>
                                                        </div>
                                                        <div class="short_info_wrap">

                                                            <div class="row">
                                                                <!--<label>Phone:</label>-->
                                                                <?php echo $PHONE_NUMBER1->description; ?> 


                                                            </div>
                                                            <div class="row">
                                                                <!--<label>Mobile:</label>-->
                                                                <!--<span> 076-155-4800     </span>-->
                                                                <?php echo $PHONE_NUMBER2->description; ?>
                                                            </div>
                                                        </div>
                                                        <div class="office">
                                                            <h3>E-mail</h3>
                                                            <div class="icon icon-email">
                                                                <img src="img/icon/about-us-icon/opened-email-envelope.png" alt=""/>
                                                            </div>
                                                        </div>
                                                        <div class="short_info_wrap">

                                                            <div class="row">
                                                                <?php echo $EMAIL->description; ?>
                                                            </div>
                                                        </div>
                                                        <div class="office">
                                                            <h3>Location</h3>
                                                            <div class="icon">
                                                                <i class="fas fa-map-marker-alt map"></i>
                                                            </div>
                                                        </div>
                                                        <div class="short_info_wrap">

                                                            <div class="row">
                                                            </div>
                                                            <div class="row">
                                                                <?php echo $LOCATION->description; ?>
                                                            </div>
                                                        </div>

                                                        <!-- company-info-item end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-sm-6">
                                        <div class="ui-block contact-us-block contact-frame">
                                            <div class="ui-block-title">
                                                <h6 class="title">Personal Information</h6>
                                            </div>
                                            <div class="ui-block-content">
                                                <!-- Contact Form  -->
                                                <div class="row">
                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                            <input class="form-control" placeholder="Your Name" name="txtFullName" id="txtFullName">
                                                            <span id="spanFullName"></span>
                                                        </div>
                                                        <div class="form-group label-floating">
                                                            <input class="form-control" placeholder="Phone Number" name="txtContact" id="txtContact">
                                                            <span id="spanContact"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                            <input type class="form-control" placeholder="Email Address" name="txtEmail" id="txtEmail" >
                                                            <span id="spanEmail"></span>
                                                        </div>
                                                        <div class="form-group label-floating">
                                                            <input class="form-control" placeholder="Subject" name="txtSubject" id="txtSubject" placeholder="Subject">
                                                            <span id="spanSubject"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group label-floating">
                                                            <textarea class="form-control" name="txtmessage" id="txtmessage" placeholder="Message"></textarea>
                                                            <span id="spanmessage"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                        <div class="form-group label-floating contactus">
                                                            <input class="form-control" placeholder="Security Code" name="captchacode" id="captchacode" >
                                                            <span id="capspan"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12 capchatext">
                                                        <div class="form-group label-floating">
                                                            <?php
                                                            include ("./contact-us-form/captchacode-widget.php");
                                                            ?>
                                                            <img id="checking" src="contact-us-form/img/checking.gif" alt=""/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-lg-4 contact-us-button">
                                                        <div class="frm-group">
                                                            <button type="submit" id="btnSubmit" class="btn btn-primary  full-width">Send Your Message</button>
                                                             <!--<input type="submit" name="update" class="btn btn-primary btn-lg full-width" value="Save all Changes" />-->
                                                        </div>
                                                        <div id="dismessage" align="center" class="msg-success" ></div>
                                                    </div>

                                                </div>
                                                <!-- ... end Personal Information Form  -->
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--</section>-->
                </main>
                <!-- ... end Main Content -->
            </div>
        </div>
        <div class="event-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.612711302738!2d80.29093631420835!3d6.0477529956202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDInNTEuOSJOIDgwwrAxNyczNS4zIkU!5e0!3m2!1sen!2slk!4v1553857522508!5m2!1sen!2slk" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <!--footers-->
        <?php
        include './footer.php';
        ?>
        <!--end footer-->
        <!-- Window-popup -->
        <?php
        include './window-pop-up.php';
        ?>

        <!-- ... end Window-popup -->

        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="plugins/OwlCarousel/dist/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="contact-us-form/scripts.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/base-init.js"></script>
        <script>
            $(document).ready(function () {
                $('.about-box').mouseover(function () {
                    $(this).find('.about-box-icon').addClass('about-box-icon-hover');
                });
                $('.about-box').mouseout(function () {
                    $(this).find('.about-box-icon').removeClass('about-box-icon-hover');
                });
            });
        </script>
    </body>
</html>