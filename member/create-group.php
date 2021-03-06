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
$CATEGORIES = BusinessCategory::all();
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Group || Flip.lk</title>
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
            <!-- Your Account Personal Information -->
            <!--<div class="container">-->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Create Your Group</h6>
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
                                            <input class="form-control" placeholder="" type="text" name="group_name" id="group-name"  value="">
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input class="form-control" placeholder="" type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Phone Number</label>
                                            <input class="form-control" placeholder="" type="text" name="phone_number" id="phone-number" value="<?php echo $_SESSION['phone_number']; ?>">
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
                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
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
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" placeholder="" type="text"  name="address" id="address" value="<?php echo $_SESSION['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">District</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="district" id="district" value="">-->
                                            <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE" value="<?php echo $_SESSION['district_string']; ?>">
                                            <input type="hidden" name="district" id="district" value="<?php echo $_SESSION['district']; ?>"/>
                                            <input type="hidden" name="district_string" id="district-string" value="<?php echo $_SESSION['district_string']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">City</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="city" id="city" value="">-->
                                            <input type="text" id="autocomplete2" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE" value="<?php echo $_SESSION['city_string']; ?>">
                                            <input type="hidden" name="city" id="city" value="<?php echo $_SESSION['city']; ?>"/>
                                            <input type="hidden" name="city_string" id="city-string" value="<?php echo $_SESSION['city_string']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Write a little description about the page</label>
                                            <textarea class="form-control" placeholder="" name="description" id="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="row upload-group-pro-pic pro-img">
                                            <div class="uploadgroupphotobx" id="uploadgroupphotobx"> 
                                                <div class="progroupimg">
                                                    <!--<img src="../upload/group/<?php echo $groupimg; ?>" class="group-profile-default-image pro-pic" id="blah" alt=""/>-->
                                                    <img src="image/profile.png" class="pro-pic" id="blah" alt=""/>

                                                </div>
                                                <label class="uploadgroupBox">
                                                    <input type="hidden" name="upload-group-profile" id="upload-group-profile" value="TRUE">
                                                    <input type="hidden" name="sort" id="sort" value="1">
                                                    <input type="hidden" id="group-pro" name="group_profile" value="<?php echo $groupimg; ?>" />
                                                </label>
                                            </div>
                                            <span class="upload-group-span" id="upload-group-span">
                                                <i class="fa fa-camera fa-2x"></i><br />
                                                Click here to Upload photo
                                                <input type="file" name="group-profile-picture" id="group-profile-picture" class="group-profile-picture" sort="1" value="">
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="row upload-group-cover-pic">
                                            <div class="uploadgroupphotobx2" id="uploadgroupphotobx2"> 
                                                <div class="coverimg">
                                                    <img src="image/cover.jpg" class="cover-pic" id="blah1" alt=""/>

                                                </div>
                                                <label class="uploadgroupBox2">
                                                    <input type="hidden" name="upload-group-cover" id="upload-group-cover" value="TRUE">
                                                    <input type="hidden" name="sort" id="sort" value="1">
                                                    <input type="hidden" id="group-cover" name="group_cover" value="<?php echo $groupcover; ?>" />
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
                                        <input type="hidden" name="member" value="<?php echo $_SESSION['id']; ?>" />
                                        <input type="submit" name="create-group" id="btn-group" class="btn btn-primary btn-lg full-width" value="Save all Changes" />
                                    </div>
                                </div>
                            </form>
                            <!-- ... end Form Favorite Page Information -->
                        </div>
                    </div>
                </div>
                <?php
                include './account-navigation.php';
                ?>
            </div>
            <!--</div>-->
            <!-- ... end Your Account Personal Information -->
            <!-- Window-popup -->
        </div>
        <?php
        include './window-pop-up.php';
        ?>
        <?php
        include './footer.php';
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
        <script src="js/js/add-group-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-group-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/sub-categories.js" type="text/javascript"></script>
        <script src="js/js/group.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
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
                                                    $('#district-string').val(place.name);
                                                    $('#city').val(place2.place_id);
                                                    $('#city-string').val(place2.name);
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>
