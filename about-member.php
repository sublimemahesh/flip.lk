<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$MEM = '';
if (isset($_GET['id'])) {
    $MEM = new Member($_GET['id']);
} else {
    $MEM = new Member($_SESSION['id']);
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> About || Member || Flip.lk</title>
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
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <?php
        include './banner.php';
        ?>
        <div class="container index-container body-content">

            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <?php
                include './member-header.php';
                ?>
                <!-- ... end Top Header-Profile -->

                <div class="container">
                    <div class="row">
                        <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 order-md-2 col-sm-12 col-12">
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">Personal Info</h6>
                                </div>
                                <div class="ui-block-content">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info">
                                        <li>
                                            <span class="title">About Me:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->aboutMe) {
                                                    echo $MEM->aboutMe;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Birthday:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->dob) {
                                                    echo date_format(date_create($MEM->dob), "F dS, Y");
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Lives in:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->address) {
                                                    echo $MEM->address;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">City:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->cityString) {
                                                    echo $MEM->cityString;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">District:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->districtString) {
                                                    echo $MEM->districtString;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Occupation:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->occupation) {
                                                    echo $MEM->occupation;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Joined:</span>
                                            <span class="text"><?php echo date_format(date_create(substr($MEM->createdAt, 0, 10)), "F dS, Y"); ?></span>
                                        </li>
                                        <li>
                                            <span class="title">Gender:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->gender) {
                                                    echo ucfirst($MEM->gender);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Status:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->civilStatus) {
                                                    if ($MEM->civilStatus == 'not_married') {
                                                        echo 'Not Married';
                                                    } else {
                                                        echo 'Married';
                                                    };
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <a class="text"><?php echo $MEM->email; ?></a>
                                        </li>
                                        <li>
                                            <span class="title">Phone Number:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->phoneNumber) {
                                                    echo $MEM->phoneNumber;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="autocomplete2" placeholder="Location" value="<?php echo $_GET['location']; ?>">
        <div id="map"></div>
        <?php
        include './footer.php';
        ?>
        <?php
        include './window-pop-up.php';
        ?>


        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/read-more-and-less.js" type="text/javascript"></script>
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
        <script src="js/js/ad-comment.js" type="text/javascript"></script>
        <script src="js/js/ad-reply.js" type="text/javascript"></script>
        <script src="js/js/shared-ad.js" type="text/javascript"></script>
        <script src="js/js/login-first.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
    </body>
</html>