<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Typed.js - Type your heart out</title>
        <script src="plugins/type-js/js/typed.min.js" type="text/javascript"></script>
        <script src="plugins/type-js/js/demos.js"></script>
        <!--<link href="plugins/type-js/css/demos.css" rel="stylesheet"/>-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>-->
        <script>hljs.initHighlightingOnLoad();</script>
    </head>
    <style>
       

        .nav {
            height: 50px;
            width: 100%;
            background-color: #003263;
            position: relative;
            border-bottom: 1px solid #fff;
        }

        .nav > .nav-header {
            display: inline;
        }

        .nav > .nav-header > .nav-title {
            display: inline-block;
            font-size: 22px;
            color: #fff;
            padding: 7px 10px 6px 10px;
        }

        .nav > .nav-btn {
            display: none;
        }

        .nav > .nav-links {
            display: inline;
            float: right;
            font-size: 18px;
        }

        .nav > .nav-links > a {
            display: inline-flex;
            padding: 13px 10px 13px 10px;
            text-decoration: none;
            color: #efefef;
        }

        .nav > .nav-links > a:hover {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .nav > #nav-check {
            display: none;
        }
        .nav-title.logo img {
            width: 150px;
        }
        .nav-links a img {
            width: 25px;
            margin-right: 15px;
        }
        .nav-links a span {
            font-weight: 600;
        }

        @media (max-width:600px) {
            .nav > .nav-btn {
                display: inline-block;
                position: absolute;
                right: 0px;
                top: 0px;
            }
            .nav > .nav-btn > label {
                display: inline-block;
                width: 50px;
                height: 50px;
                padding: 13px;
            }
            .nav > .nav-btn > label:hover {
                background-color: rgba(0, 0, 0, 0.3);
                border-bottom: 1px solid #fff;
            }
            .nav > .nav-btn > label > span {
                display: block;
                width: 25px;
                height: 10px;
                border-top: 2px solid #eee;
            }
            .nav > .nav-links {
                position: absolute;
                display: block;
                width: 100%;
                background-color: #003263;
                height: 0px;
                transition: all 0.3s ease-in;
                overflow-y: hidden;
                top: 50px;
                left: 0px;
            }
            .nav > .nav-links > a {
                display: inline-flex    ;
                width: 100%;
            }
            .nav > #nav-check:not(:checked) + .nav-links {
                height: 0px;
            }
            .nav > #nav-check:checked + .nav-links {
                height: calc(100vh - 50px);
                overflow-y: auto;
            }


        }
    </style>

    <body>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <div class="nav">
            <div class="nav-header">
                <div class="nav-title logo">
                    <img src="img/logo/logo.jpg" alt=""/>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <input type="checkbox" id="nav-check">
            <div class="nav-links">
                <a href="./"><img src="img/icon/header-icon/home.png" alt=""/>Home</a>
                <a href="all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />Advertisements</a>
                <a href="groups.php"><img src="img/icon/header-icon/group.png" alt=""  />Groups</a>
                <a href="member/"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>
                <a href="member/friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests</a>
                <a href="member/member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>

                <?php
                if (isset($_SESSION['id'])) {
                    ?>
                    <a href="member/profile.php">
                        <?php
                        if ($MEMBER->profilePicture) {
                            ?>
                            <img alt="author" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        } else {
                            ?>
                            <img alt="author" src="upload/member/member.png" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        }
                        ?>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="member/login.php">
                        <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                        Sign In
                    </a>
                    <?php
                }
                ?>
                 <a href="member/create-advertisement.php?back=ad">
                    <button class="btn-post">
                        <i class="icon fa fa-thumbtack"></i>
                        Post Your Ad
                    </button>
                </a>
            </div>
        </div>
    </body>

</html>
===================================================

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

                    <section class="about-section-values ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="ui-block contact-us-block">
<!--                                            <div class="ui-block-title">
                                                <h6 class="title">Find Us</h6>
                                            </div>-->

                                            <div class="ui-block-content">
                                                

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group label-floating">

<!--                                                        <P>
                                                            <?php echo $CONTACTUS->description; ?>
                                                        </P>-->
                                                        <div class="company-contact-info-area">
                                                            <div class="company-info-item d-flex align-items-center">
<!--                                                                <div class="contact-icon border-line col-md-3 ">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>-->
                                                                <div class="content box-details col-md-9">
                                                                    <!--<span class="title">Phone Number</span>-->
                                                                    <div class="row col-md-12">
                                                                    <div class="title title11 col-md-3"><i class="fa fa-phone"></i></div>
                                                                    <div class="title col-md-9">Phone Number</div>
                                                                    </div>
                                                                    <div class="row phone">
                                                                        <div class="contact-icon border-line col-md-3 ">
                                                                    <!--<i class="fa fa-phone"></i>-->
                                                                </div>
                                                                    <?php echo $PHONE_NUMBER1->description; ?> 
                                                                    <?php echo $PHONE_NUMBER2->description; ?>
                                                                    </div>

                                                                </div>
                                                            </div> 
                                                            <!--company-info-item end--> 
                                                            
                                                            <div class="company-info-item d-flex align-items-center">
                                                                <div class="contact-icon">
                                                                    <i class="fa fa-envelope"></i>
                                                                </div>
                                                                <div class="content box-details col-md-9">
                                                                     <div class="row col-md-12">
                                                                    <div class="title title11 col-md-3"><i class="fa fa-phone"></i></div>
                                                                    <div class="title">Email Address</div>
                                                                     </div>
                                                                    <!--<span class="title">Email Address</span>-->
                                                                    <div class="row phone">
                                                                    <?php echo $EMAIL->description; ?>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <!--company-info-item end--> 

                                                            <div class="company-info-item d-flex align-items-center">
                                                                <div class="contact-icon">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                                <div class="content address box-details col-md-9">
                                                                     <div class="row col-md-12">
                                                                    <div class="title title11 col-md-3"><i class="fa fa-phone"></i></div>
                                                                    <div class="title">location</div>
                                                                     </div>
                                                                    <!--<span class="title">location</span>-->
                                                                    <div class="row phone">
                                                                    <?php echo $LOCATION->description; ?>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <!--company-info-item end--> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-sm-6">
                                        <div class="ui-block contact-us-block">
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
                    <!--<section class="about-section ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">-->

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
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
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
