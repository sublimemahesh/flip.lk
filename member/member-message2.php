<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);

$id = '';
$status = '';
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//    $AD = new Advertisement($id);
//    $SENDER = new Member($MEMBER->id);
//    $RECIEVER = new Member($AD->member);
//    $DISTINCTRECIVERS = AdvertisementMessage::getDistinctOwnersByMemberId($MEMBER->id);
//} else {
//    $SENDER = new Member($MEMBER->id);
//    $DISTINCTRECIVERS = AdvertisementMessage::getDistinctMembersByOwnerId($MEMBER->id);
//}
//dd($DISTINCTRECIVERS);
if (isset($_GET['status'])) {
    $status = $_GET['status'];
}


if ($status == 'withad') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $AD = new Advertisement($id);

    $SENDER = new Member($MEMBER->id);

    $RECIEVER = new Member($AD->member);

    $DISTINCTRECIVERS = AdvertisementMessage::getDistinctOwnersByMemberId($MEMBER->id);
//    dd($DISTINCTRECIVERS);
} elseif ($status == 'withoutad') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $AD = new Advertisement($id);
        $RECIEVER = new Member($AD->member);

        $DISTINCTRECIVERS = AdvertisementMessage::getDistinctMembersByOwnerId($MEMBER->id);
    } else {
        $DISTINCTRECIVERS = AdvertisementMessage::getDistinctMembersByOwnerId($MEMBER->id);
    }
    $SENDER = new Member($MEMBER->id);
}
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
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
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

        <?php
        include './header.php';
        ?>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <div class="header-spacer header-spacer-small"></div>

            <!-- Main Header Account -->
            <!--<div class="col col-xl-12 col-12">-->
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
            <!--<div class="container">-->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Chat / Messages</h6>
                        </div>

                        <div class="row">
                            <div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12  padding-r-0">
                                <!-- Notification List Chat Messages -->
                                <ul class="notification-list chat-message">

                                    <?php
                                    $maxids = array();
                                    foreach ($DISTINCTRECIVERS as $reciever) {
                                        if (isset($_GET['id'])) {
                                            $max = AdvertisementMessage::getMaxIDOfDistinctOwner($reciever['owner'], $MEMBER->id);
                                        } else {
                                            $max = AdvertisementMessage::getMaxIDOfDistinctMember($reciever['member'], $MEMBER->id);
                                        }

                                        array_push($maxids, $max['max']);
//                                        return $maxids;
                                    }
                                    rsort($maxids);
                                    foreach ($maxids as $key => $maxid) {
                                        $MESSAGE = new AdvertisementMessage($maxid);
                                        if (isset($_GET['id'])) {
                                            $MEM = new Member($MESSAGE->owner);
                                        } else {
                                            $MEM = new Member($MESSAGE->member);
                                        }
                                        ?>

                                        <li class="<?php
                                    if ($MESSAGE->owner == $AD->member) {
                                        echo 'active';
                                    }
                                        ?>">
                                            <div class="author-thumb message-box">
                                                <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                            </div>
                                            <div class="notification-event">
                                                <a class="h6 notification-friend" href="member-message.php?id=<?php echo $MESSAGE->advertisement; ?>&status=withad">
                                                    <?php echo $MEM->firstName . ' ' . $MEM->lastName; ?>
                                                </a>
                                                <span class="chat-message-item">
                                                    <?php
                                                    if (strlen($MESSAGE->message) > 30) {
                                                        echo substr($MESSAGE->message, 0, 28) . '...';
                                                    } else {
                                                        echo $MESSAGE->message;
                                                    }
                                                    ?>
                                                </span>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                                            </div>
                                            <span class="notification-icon">
                                                <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                            </span>

                                        </li>

                                        <?php
                                    }
                                    ?>
                                </ul>

                                <!-- ... end Notification List Chat Messages -->
                            </div>

                            <div class="col col-xl-7 col-lg-6 col-md-12 col-sm-12  padding-l-0">
                                <!-- Chat Field -->
                                <?php
                                if (isset($_GET['id'])) {
                                    ?>
                                    <div class="chat-field">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo $RECIEVER->firstName . ' ' . $RECIEVER->lastName; ?></h6>
                                            <div class="author-thumb message-box">
                                                <img src="../upload/member/<?php echo $RECIEVER->profilePicture; ?>" alt="author">
                                            </div>
                                        </div>
                                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                                            <ul class="notification-list chat-message chat-message-field">
                                                <?php
                                                $MESSAGES = AdvertisementMessage::getMessagesByMemberAndOwnerASC($MEMBER->id, $RECIEVER->id);

                                                foreach ($MESSAGES as $msg) {
                                                    if ($msg['sender'] = 'member') {
                                                        $MEM1 = new Member($msg['member']);
                                                    } else {
                                                        $MEM1 = new Member($msg['owner']);
                                                    }
                                                    ?>
                                                    <li>
                                                        <div class="author-thumb message-box">
                                                            <img src="../upload/member/<?php echo $MEM1->profilePicture; ?>" alt="author">
                                                        </div>
                                                        <div class="notification-event">
                                                            <a href="#" class="h6 notification-friend"><?php echo $MEM1->firstName . ' ' . $MEM1->lastName; ?></a>
                                                            <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                                                            <div class="chat-message-item"><?php echo $msg['message']; ?></div>
                                                        </div>

                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="form-group label-floating is-empty">
                                            <form id="send-message" method="post" enctype="multipart/form-data" action="post-and-get/member-message.php">
                                                <label class="control-label">Write your message...</label>
                                                <textarea class="form-control" name="message" id="message" placeholder=""  ></textarea>
                                                <input type="hidden" name="member" value="<?php echo $_SESSION['id']; ?>">
                                                <input type="hidden" name="owner" id="owner" value="<?php echo $AD->member; ?>">
                                                <input type="hidden" name="advertisement" id="advertisement" value="<?php echo $AD->id; ?>">
                                                <input type="hidden" name="sender" value="member">
                                                <div class="add-options-message">
                                                    <button type="submit" name="member-message" id="member-message" class="btn btn-primary btn-sm">
                                                        Send
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>

                                <!-- ... end Chat Field -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include './account-navigation.php';
                ?>
            </div>
            <!--</div>-->
            <!-- ... end Your Account Personal Information -->
        </div>
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
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/profile.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script>
            var placeSearch, autocomplete, autocomplete2;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "lk"}
                };
                var input = document.getElementById('autocomplete');
                var input2 = document.getElementById('autocomplete2');

                autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete2 = new google.maps.places.Autocomplete(input2, options);

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
                autocomplete2.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                var place2 = autocomplete2.getPlace();
                $('#district').val(place.place_id);
                $('#city').val(place2.place_id);
//                $('#longitude').val(place.geometry.location.lng());
//                $('#latitude').val(place.geometry.location.lat());
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                        autocomplete2.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
        <script>
            // Retrieve Details from Place_ID
            function initMap() {
                setTimeout(function () {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -33.866, lng: 151.196},
                        zoom: 15
                    });

                    var infowindow = new google.maps.InfoWindow();
                    var service = new google.maps.places.PlacesService(map);
                    var place_id = $('#district').val();
                    var place_id2 = $('#city').val();
                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            $('#autocomplete').val(place.name);
                            $('.district-label').removeClass('is-empty');
                        }
                    });
                    service.getDetails({
                        placeId: place_id2
                    }, function (place2, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#autocomplete2').val(place2.name);
                            $('.city-label').removeClass('is-empty');
                        }
                    });
                }, 1000);
            }

            $(document).ready(function () {
                initMap();
            });


        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>