<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Account - Personal Information</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">
        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Main Font -->
        <script src="js/webfontloader.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:300,400,500,700:latin']
                }
            });
        </script>
    </head>
    <body>

        <!-- Profile Settings Responsive -->
        <div class="profile-settings-responsive">

            <a href="#" class="js-profile-settings-open profile-settings-open">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <div class="mCustomScrollbar" data-mcs-theme="dark">
                <div class="ui-block">
                    <div class="your-profile">
                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">Your PROFILE</h6>
                        </div>

                        <div id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne-1">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-1" aria-expanded="true" aria-controls="collapseOne">
                                            Profile Settings
                                            <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                        </a>
                                    </h6>
                                </div>

                                <div id="collapseOne-1" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                    <ul class="your-profile-menu">
                                        <li>
                                            <a href="28-YourAccount-PersonalInformation.html">Personal Information</a>
                                        </li>
                                        <li>
                                            <a href="29-YourAccount-AccountSettings.html">Account Settings</a>
                                        </li>
                                        <li>
                                            <a href="30-YourAccount-ChangePassword.html">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="31-YourAccount-HobbiesAndInterests.html">Hobbies and Interests</a>
                                        </li>
                                        <li>
                                            <a href="32-YourAccount-EducationAndEmployement.html">Education and Employement</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="ui-block-title">
                            <a href="33-YourAccount-Notifications.html" class="h6 title">Notifications</a>
                            <a href="#" class="items-round-little bg-primary">8</a>
                        </div>
                        <div class="ui-block-title">
                            <a href="34-YourAccount-ChatMessages.html" class="h6 title">Chat / Messages</a>
                        </div>
                        <div class="ui-block-title">
                            <a href="35-YourAccount-FriendsRequests.html" class="h6 title">Friend Requests</a>
                            <a href="#" class="items-round-little bg-blue">4</a>
                        </div>
                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">FAVOURITE PAGE</h6>
                        </div>
                        <div class="ui-block-title">
                            <a href="36-FavPage-SettingsAndCreatePopup.html" class="h6 title">Create Fav Page</a>
                        </div>
                        <div class="ui-block-title">
                            <a href="36-FavPage-SettingsAndCreatePopup.html" class="h6 title">Fav Page Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ... end Profile Settings Responsive -->

        <?php
        include './sidebar-left.php';
        ?>
        <?php
        include './sidebar-right.php';
        ?>
        <?php
        include './header.php';
        ?>

        <div class="header-spacer header-spacer-small"></div>

        <!-- Main Header Account -->

        <div class="main-header">
            <div class="content-bg-wrap bg-account"></div>
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
                        <div class="main-header-content">
                            <h1>Your Account Dashboard</h1>
                            <p>Welcome to your account dashboard! Here you’ll find everything you need to change your profile
                                information, settings, read notifications and requests, view your latest messages, change your pasword and much
                                more! Also you can create or manage your own favourite page, have fun!</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="img-bottom" src="img/account-bottom.png" alt="friends">
        </div>

        <!-- ... end Main Header Account -->
        <!-- Your Account Personal Information -->
        <div class="container">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Personal Information</h6>
                        </div>
                        <div class="ui-block-content">
                            <!-- Personal Information Form  -->
                            <form action="post-and-get/member.php" method="post">
                                <div class="row">

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">First Name</label>
                                            <input class="form-control" placeholder="" name="fname" type="text" value="<?php echo $MEMBER->firstName; ?>">
                                        </div>

                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Email</label>
                                            <input class="form-control" placeholder="" name="email" type="email" value="<?php echo $MEMBER->email; ?>" disabled="disabled">
                                        </div>

                                        <div class="form-group date-time-picker label-floating">
                                            <label class="control-label">Your Birthday</label>
                                            <input name="datetimepicker" id="dob" placeholder="" value="<?php echo $MEMBER->dob; ?>" />
                                            <span class="input-group-addon">
                                                <svg class="olymp-month-calendar-icon icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-month-calendar-icon"></use></svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last Name</label>
                                            <input class="form-control" placeholder="" name="lname" type="text" value="<?php echo $MEMBER->lastName; ?>">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Phone Number</label>
                                            <input class="form-control" placeholder="" name="phone_number" type="text" value="<?php echo $MEMBER->phoneNumber; ?>">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Your Occupation</label>
                                            <input class="form-control" placeholder="" name="occupation" type="text" value="<?php echo $MEMBER->occupation; ?>">
                                        </div>



                                    </div>

                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Address</label>
                                            <input class="form-control" placeholder="<?php echo $MEMBER->address; ?>" name="address" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your District</label>
                                            <select class="selectpicker form-control" name="district">
                                                <option value="">-- Please Select --</option>
                                                <option value="CA">California</option>
                                                <option value="TE">Texas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City</label>
                                            <select class="selectpicker form-control" name="city">
                                                <option value="">-- Please Select --</option>
                                                <option value="SF">San Francisco</option>
                                                <option value="NY">New York</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Write a little description about you</label>
                                            <textarea class="form-control" placeholder="" name="about_me"><?php echo $MEMBER->aboutMe; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Gender</label>
                                            <select class="selectpicker form-control" name="gender">
                                                <option value="">-- Please Select --</option>
                                                <option value="male" <?php
                                                if ($MEMBER->gender == 'male') {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>Male</option>
                                                <option value="female" <?php
                                                if ($MEMBER->gender == 'female') {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Status</label>
                                            <select class="selectpicker form-control" name="status">
                                                <option value="">-- Please Select --</option>
                                                <option value="married" <?php
                                                if ($MEMBER->civilStatus == 'married') {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>Married</option>
                                                <option value="not_married" <?php
                                                if ($MEMBER->civilStatus == 'not_married') {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>Not Married</option>
                                            </select>
                                        </div>
                                    </div>
<!--                                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group with-icon label-floating">
                                            <label class="control-label">Your Facebook Account</label>
                                            <input class="form-control" type="text" value="www.facebook.com/james-spiegel95321">
                                            <i class="fab fa-facebook-f c-facebook" aria-hidden="true"></i>
                                        </div>
                                    </div>-->
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <button class="btn btn-secondary btn-lg full-width">Restore all Attributes</button>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
                                        <input type="submit" name="update" class="btn btn-primary btn-lg full-width" value="Save all Changes" />
                                    </div>

                                </div>
                            </form>

                            <!-- ... end Personal Information Form  -->
                        </div>
                    </div>
                </div>
                <?php
                include './account-navigation.php';
                ?>
            </div>
        </div>
        <!-- ... end Your Account Personal Information -->

        <!-- Window-popup -->
        <?php
        include './window-pop-up.php';
        ?>
        <!-- ... end Window-popup -->

        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script src="js/jquery.matchHeight.js"></script>
        <script src="js/svgxuse.js"></script>
        <script src="js/imagesloaded.pkgd.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/velocity.js"></script>
        <script src="js/ScrollMagic.js"></script>
        <script src="js/jquery.waypoints.js"></script>
        <script src="js/jquery.countTo.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/material.min.js"></script>
        <script src="js/bootstrap-select.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/selectize.js"></script>
        <script src="js/swiper.jquery.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/daterangepicker.js"></script>
        <script src="js/simplecalendar.js"></script>
        <script src="js/fullcalendar.js"></script>
        <script src="js/isotope.pkgd.js"></script>
        <script src="js/ajax-pagination.js"></script>
        <script src="js/Chart.js"></script>
        <script src="js/chartjs-plugin-deferred.js"></script>
        <script src="js/circle-progress.js"></script>
        <script src="js/loader.js"></script>
        <script src="js/run-chart.js"></script>
        <script src="js/jquery.magnific-popup.js"></script>
        <script src="js/jquery.gifplayer.js"></script>
        <script src="js/mediaelement-and-player.js"></script>
        <script src="js/mediaelement-playlist-plugin.min.js"></script>
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
    </body>
</html>