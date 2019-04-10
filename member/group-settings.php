<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$groupimg = '';
$groupcover = '';
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_SESSION['group-image'])) {
    $groupimg = $_SESSION['group-image'];
}
if (isset($_SESSION['group-cover'])) {
    $groupcover = $_SESSION['group-cover'];
}
$GROUP = new Group($id);
$CATEGORIES = BusinessCategory::all();
$SUBCATEGORIES = BusinessSubCategory::all();
$publisedAds = Advertisement::getPublishedAdsByGroup($id);
$unpublisedAds = Advertisement::getUnpublishedAdsByGroup($id);
$member_request = GroupAndMemberRequest::getCountOfMemberRequestsByGroup($id);
$members = GroupMember::getAllMembersByGroup($id);

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
                        <div class="ui-block">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="group-details.php?id=<?php echo $id; ?>&filter=published">Published Ads - <?php if(count($publisedAds) > 9 || count($publisedAds) == 0) { echo count($publisedAds); } else { echo '0' . count($publisedAds); } ?></a>

                                </div>
                                <div class="col-sm-3">
                                    <a href="group-details.php?id=<?php echo $id; ?>&filter=published">Unpublished Ads - <?php if(count($unpublisedAds) > 9 || count($unpublisedAds) == 0) { echo count($unpublisedAds); } else { echo '0' . count($unpublisedAds); } ?></a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="group-details.php?id=<?php echo $id; ?>&filter=published">Member Requests - <?php if($member_request > 9 || $member_request == 0) { echo $member_request; } else { echo '0' . $member_request; } ?></a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="group-details.php?id=<?php echo $id; ?>&filter=published">Group Members - <?php if(count($members) > 9 || count($members) == 0) { echo count($members); } else { echo '0' . count($members); } ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="ui-block">
                            <div class="ui-block-title">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <h6 class="title">Manage Group</h6>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12 manage-group-section">
                                    <a href="#" class="btn btn-blue btn-md-2" id="delete-group" group_id="<?php echo $id; ?>">Delete Group</a>
                                </div>
                            </div>
                            <div class="ui-block-content">
                                <div class="description-toggle col-md-6">
                                    <div class="description-toggle-content">
                                        <div class="h6">Status</div>
                                        <p>
                                            <?php
                                            if ($GROUP->status == 1) {
                                                echo 'Active';
                                            } else {
                                                echo 'Inactive';
                                            }
                                            ?>
                                        </p>
                                    </div>

                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" id="active-group" <?php
                                            if ($GROUP->status == 1) {
                                                echo 'checked=""';
                                            };
                                            ?>  group_id="<?php echo $id; ?>" status="<?php echo $GROUP->status; ?>">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ui-block">
                            <div class="ui-block-title">
                                <h6 class="title">Edit Your Group</h6>
                            </div>
                            <div class="ui-block-content">
                                <?php
                                if (isset($_GET['message'])) {
                                    $MESSAGE = new Message($_GET['message']);
                                    ?>
                                    <div class="alert-in-page">
                                        <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                            <span id="message"><?php echo $MESSAGE->description; ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!-- Form Favorite Page Information -->
                                <form id="form-group" action="post-and-get/group.php" method="post">
                                    <div class="row">
                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name</label>
                                                <input class="form-control" placeholder="" type="text" name="group_name" id="group-name"  value="<?php echo $GROUP->name; ?>">
                                            </div>
                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email</label>
                                                <input class="form-control" placeholder="" type="email" name="email" id="email" value="<?php echo $GROUP->email; ?>">
                                            </div>
                                        </div>

                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Phone Number</label>
                                                <input class="form-control" placeholder="" type="text" name="phone_number" id="phone-number" value="<?php echo $GROUP->phoneNumber; ?>">
                                            </div>
                                        </div>

                                        <div class="col col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label">Business Category</label>
                                                <select class="selectpicker form-control" id="select-business-category" name="category">
                                                    <option value="">-- Please Select Business Category -- </option>
                                                    <?php
                                                    foreach ($CATEGORIES as $category) {
                                                        ?>
                                                        <option value="<?php echo $category['id']; ?>" <?php
                                                        if ($category['id'] == $GROUP->category) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo $category['name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label">Business Sub Category</label>
                                                <select class="form-control sub-category-select"  name="sub_category" id="sub-category">
                                                    <option value="">-- Please Select Business Sub Category -- </option>
                                                    <?php
                                                    foreach ($SUBCATEGORIES as $subcategory) {
                                                        ?>
                                                        <option value="<?php echo $subcategory['id']; ?>" <?php
                                                        if ($subcategory['id'] == $GROUP->subCategory) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo $subcategory['name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address</label>
                                                <input class="form-control" placeholder="" type="text"  name="address" id="address" value="<?php echo $GROUP->address; ?>">
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating district-label">
                                                <label class="control-label">District</label>
                                                <!--<input class="form-control" placeholder="" type="text" name="district" id="district" value="">-->
                                                <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                                <input type="hidden" name="district" id="district"  value="<?php echo $GROUP->district; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating city-label">
                                                <label class="control-label">City</label>
                                                <!--<input class="form-control" placeholder="" type="text" name="city" id="city" value="">-->
                                                <input type="text" id="autocomplete2" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                                <input type="hidden" name="city" id="city"  value="<?php echo $GROUP->city; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Write a little description about the page</label>
                                                <textarea class="form-control" placeholder="" name="description" id="description"><?php echo $GROUP->description; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="row upload-group-pro-pic">
                                                <div class="uploadgroupphotobx" id="uploadgroupphotobx"> 
                                                    <div class="progroupimg">
                                                        <!--<img src="../upload/group/<?php echo $groupimg; ?>" class="group-profile-default-image pro-pic" id="blah" alt=""/>-->
                                                        <img src="../upload/group/<?php echo $GROUP->profilePicture; ?>" class="pro-pic" id="blah" alt=""/>

                                                    </div>
                                                    <label class="uploadgroupBox">
                                                        <input type="hidden" name="upload-group-profile" id="upload-group-profile" value="TRUE">
                                                        <input type="hidden" name="sort" id="sort" value="1">
                                                        <input type="hidden" id="group-pro" name="group_profile" value="<?php echo $GROUP->profilePicture; ?>" />
                                                    </label>
                                                </div>
                                                <span class="upload-group-span" id="upload-group-span">
                                                    <i class="fa fa-camera fa-2x"></i><br />
                                                    Click here to Upload photo
                                                    <input type="file" name="group-profile-picture" id="group-profile-picture" class="group-profile-picture" sort="1" value="">
                                                </span>

                                            </div>
                                        </div>
                                        <div class="col col-lg-6 col-md-4 col-sm-12 col-12">
                                            <div class="row upload-group-cover-pic">
                                                <div class="uploadgroupphotobx2" id="uploadgroupphotobx2"> 
                                                    <div class="coverimg">
                                                        <img src="../upload/group/cover-picture/<?php echo $GROUP->coverPicture; ?>" class="cover-pic" id="blah1" alt=""/>

                                                    </div>
                                                    <label class="uploadgroupBox2">
                                                        <input type="hidden" name="upload-group-cover" id="upload-group-cover" value="TRUE">
                                                        <input type="hidden" name="sort" id="sort" value="1">
                                                        <input type="hidden" id="group-cover" name="group_cover" value="<?php echo $GROUP->coverPicture; ?>" />
                                                    </label>
                                                </div>
                                                <span class="upload-group-span2" id="upload-group-span2">
                                                    <i class="fa fa-camera fa-2x"></i><br />
                                                    Click here to Upload photo
                                                    <input type="file" name="group-cover-picture" id="group-cover-picture" class="group-cover-picture" sort="1" value="">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                            <a href="#" class="btn btn-secondary btn-lg full-width">Restore all Attributes</a>
                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                            <input type="submit" name="edit-group" id="btn-group" class="btn btn-primary btn-lg full-width" value="Save all Changes" />
                                        </div>
                                    </div>
                                </form>
                                <!-- ... end Form Favorite Page Information -->
                            </div>
                        </div>
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
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/add-group-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-group-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/sub-categories.js" type="text/javascript"></script>
        <script src="js/js/group.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
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