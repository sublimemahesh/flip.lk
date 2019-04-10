<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$groupimg = '';
$groupcover = '';


if (isset($_SESSION['group-image'])) {
    $groupimg = $_SESSION['group-image'];
}
if (isset($_SESSION['group-cover'])) {
    $groupcover = $_SESSION['group-cover'];
}

$id = '';
$filter = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}


$GROUP = new Group($id);
if ($filter == 'published') {
    $publisedAds = Advertisement::getPublishedAdsByGroup($id);
} elseif ($filter == 'unpublished') {
    $unpublisedAds = Advertisement::getUnpublishedAdsByGroup($id);
} elseif ($filter == 'requests') {
    $requests = GroupAndMemberRequest::getMemberRequestsByGroup($id);
} elseif ($filter == 'members') {
    $members = GroupMember::getAllMembersByGroup($id);
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Group || Flip.lk</title>
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
        <div class="header-spacer"></div>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <?php
            include './group-header.php';
            ?>

            <div class="container">
                <div class="row">
                    <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-6 order-md-1 col-sm-12 col-12">
                        <?php
                        if ($filter == 'published') {
                            ?>
                            <section class="">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12  m-auto">


                                            <ul class="table-careers">
                                                <li class="head">
                                                    <span>ID</span>
                                                    <span>DATE POSTED</span>
                                                    <span>TITLE</span>
                                                    <span>MEMBER</span>
                                                    <span></span>
                                                </li>
                                                <?php
                                                $ads = Advertisement::getPublishedAdsByGroup($id);
                                                $i = 1;
                                                if (count($ads) > 0) {
                                                    foreach ($ads as $key => $ad) {
                                                        $GROUP = new Group($ad['group_id']);
                                                        $MEM = new Member($ad['member']);
                                                        ?>
                                                        <li id="li_p_<?php echo $ad['id']; ?>">
                                                            <span class=""><?php echo $i; ?></span>
                                                            <span class="date"><?php echo substr($ad['created_at'], 0, 10); ?></span>
                                                            <span class="bold"><?php echo $ad['title']; ?></span>
                                                            <span class="town-place"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></span>
                                                            <span><a href="#" class="btn btn-primary btn-sm full-width view-ad-link" data-toggle="modal" data-target="#view-ad" id="<?php echo $ad['id']; ?>" status="<?php echo $ad['status']; ?>">View Ad</a></span>
                                                        </li>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                        } elseif ($filter == 'unpublished') {
                            ?>
                            <section class="">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12  m-auto">


                                            <ul class="table-careers">
                                                <li class="head">
                                                    <span>ID</span>
                                                    <span>DATE POSTED</span>
                                                    <span>TITLE</span>
                                                    <span>MEMBER</span>
                                                    <span></span>
                                                </li>
                                                <?php
                                                $ads = Advertisement::getUnpublishedAdsByGroup($id);
                                                $i = 1;
                                                if (count($ads) > 0) {
                                                    foreach ($ads as $key => $ad) {
                                                        $GROUP = new Group($ad['group_id']);
                                                        $MEM = new Member($ad['member']);
                                                        ?>
                                                        <li id="li_unp_<?php echo $ad['id']; ?>">
                                                            <span class=""><?php echo $i; ?></span>
                                                            <span class="date"><?php echo substr($ad['created_at'], 0, 10); ?></span>
                                                            <span class="bold"><?php echo $ad['title']; ?></span>
                                                            <span class="town-place"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></span>
                                                            <span><a href="#" class="btn btn-primary btn-sm full-width view-ad-link" data-toggle="modal" data-target="#view-ad" id="<?php echo $ad['id']; ?>" status="<?php echo $ad['status']; ?>">View Ad</a></span>
                                                        </li>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php
                        } elseif ($filter == 'requests') {
                            $requests = GroupAndMemberRequest::getMemberRequestsByGroup($id);
                            ?>
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">Member requests (<span id="member-request-count"><?php echo count($requests); ?></span>)</h6>
                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                </div>


                                <!-- Notification List Frien Requests -->

                                <ul class="notification-list friend-requests">
                                    <?php
                                    foreach ($requests as $request) {
                                        $MEM = new Member($request['member']);
                                        ?>

                                        <li id="request-to-join-<?php echo $MEM->id; ?>" class="request-to-join-<?php echo $MEM->id; ?>">
                                            <div class="author-thumb member-request-profile-pic">
                                                <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                            </div>
                                            <div class="notification-event">
                                                <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                                <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                            </div>
                                            <span class="notification-icon">
                                                <a href="#" class="accept-request approve-request" id="approve-request" row_id="<?php echo $request['id']; ?>">
                                                    <span class="icon-add">
                                                        <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                    </span>
                                                    Approve Member Request
                                                </a>

                                                <a href="#" class="accept-request request-del decline-request" id="decline-request" row_id="<?php echo $request['id']; ?>">
                                                    <span class="icon-minus">
                                                        <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                    </span>
                                                </a>

                                            </span>

                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                            </div>
                                        </li>

                                        <li class="accepted accepted-request-<?php echo $MEM->id; ?> hidden" id="accepted-request-<?php echo $MEM->id; ?>">
                                            <div class="author-thumb member-request-profile-pic">
                                                <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                            </div>
                                            <div class="notification-event">
                                                <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> just became member of your group.
                                            </div>
                                            <span class="notification-icon">
                                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                            </span>

                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>

                                <!-- ... end Notification List Frien Requests -->
                            </div>
                            <?php
                        } elseif ($filter == 'members') {
                            $members = GroupMember::getAllMembersByGroup($id);
                        }
                        ?>


                    </div>

                    <?php
                    include './group-about-nav.php';
                    ?>

                </div>
            </div>
        </div>
        <div id="map"></div>
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
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/add-group-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-group-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/sub-categories.js" type="text/javascript"></script>
        <script src="js/js/group.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/publish-ad.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
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
//                        alert(place.name);
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