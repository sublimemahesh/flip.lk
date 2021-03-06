<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');


if (!isset($_SESSION)) {
    session_start();
}
if (!Member::authenticate()) {
    if ($_GET['back'] == 'ad') {
        $_SESSION["back_url"] = 'https://www.flip.lk/member/create-advertisement.php';
//        $_SESSION["back_url"] = 'http://localhost/flip.lk/member/create-advertisement.php';
    }

    redirect('login.php?message=24');
} else {
    $MEMBER = new Member($_SESSION['id']);
}

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $GROUP = new Group($id);
    $CATEGORY = new BusinessCategory($GROUP->category);
    $SUBCATEGORY = new BusinessSubCategory($GROUP->subCategory);
}
$CATEGORIES = BusinessCategory::all();
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Advertisement || Flip.lk</title>
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
        <div class="header-spacer header-spacer-small"></div>
        <div class="col col-xl-12 col-12">
            <!-- Your Account Personal Information -->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Create Advertisement</h6>
                        </div>
                        <div class="ui-block-content">
                            <!-- Personal Information Form  -->
                            <form method="post" id="form-create-ad">
                                <div class="row">

                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <input class="form-control" placeholder="" name="title" id="title" type="text" value="">
                                        </div>

                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <textarea class="form-control" placeholder="" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" placeholder="" type="text"  name="address" id="address" value="<?php echo $_SESSION['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">City</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="city" id="city" value="">-->
                                            <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete">
                                            <input type="hidden" name="city" id="city"  value=""/>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Phone Number</label>
                                            <input class="form-control" placeholder="" type="text"  name="phonenumber" id="phonenumber" value="<?php echo $_SESSION['phone_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input class="form-control" placeholder="" type="text"  name="email" id="email" value="<?php echo $_SESSION['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Price (Rs)</label>
                                            <input class="form-control" placeholder="" name="price" id="price" type="text" value="" >
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        ?>
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Category</label>
                                                <input class="form-control" placeholder="" name="" type="text" value="<?php echo $CATEGORY->name; ?>" disabled="">
                                            </div>
                                        </div>
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Sub Category</label>
                                                <input class="form-control" placeholder="" name="" type="text" value="<?php echo $SUBCATEGORY->name; ?>" disabled="">
                                            </div>
                                        </div>
                                        <input type="hidden" name="category" id="select-business-category" value="<?php echo $GROUP->category; ?>" />
                                        <input type="hidden" name="subcategory" id="sub-category" value="<?php echo $GROUP->subCategory; ?>" />
                                        <?php
                                    } else {
                                        ?>
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
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
                                        <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label">Business Sub Category</label>
                                                <select class="form-control sub-category-select"  name="sub_category" id="sub-category">
                                                    <option value="">-- Please Select Business Sub Category -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Website</label>
                                            <input class="form-control" placeholder="" name="website" id="website" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="flipScrollableArea col-lg-12" id="image-list" style="/*! height: 112px; */ /*! width: 100%; */">
                                        <div class="flipScrollableAreaWrap">
                                            <div class="flipScrollableAreaBody" style="height: 112px;">
                                                <div class="flipScrollableAreaContent">
                                                    <div class="flipScrollableAreaContent1">
                                                    </div>
                                                    <span class="_uploadouterbox">
                                                        <div class="_m _6a">
                                                            <a class="_uploadbox" rel="ignore">
                                                                <div class="_upload">
                                                                    <input multiple="" name="upload-other-images" title="Choose a file to upload" data-testid="add-more-photos" display="inline-block" type="file" class="_uploadinput _outlinenone" id="add-more-photos">
                                                                    <input multiple="" name="upload-ad-image" type="hidden">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </span>
                                                    <span class="_uploadloaderbox">
                                                        <div class="_m _6a">
                                                            <a class="_uploadbox" rel="ignore">
                                                                <div class="_upload">

                                                                </div>
                                                            </a>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flipScrollableAreaTrack invisible_elem" style="opacity: 0;">
                                            <div class="flipScrollableAreaGripper hidden_elem"></div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <input type="hidden" name="member" id="member" value="<?php echo $_SESSION['id']; ?>" />
                                        <input type="hidden" name="group"id="group" value="<?php
                                        if (empty($id)) {
                                            echo '0';
                                        } else {
                                            echo $id;
                                        }
                                        ?>" />

                                        <input type="hidden" name="create" id="" value="" />
                                        <input type="hidden" name="city_string" id="city_string"  value=""/>
                                        <a name="" id="create-ad" class="btn btn-primary btn-lg full-width" >Save all Changes</a>
                                        <div id="map" class="hidden"></div>
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
            <!--</div>-->
        </div>
        <!-- ... end Your Account Personal Information -->

        <!-- Window-popup -->
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
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/advertisement.js" type="text/javascript"></script>
        <script src="js/js/ad-images.js" type="text/javascript"></script>
        <script src="js/heartcode-canvasloader.js" type="text/javascript"></script>
        <script src="js/image-preloader.js" type="text/javascript"></script>
        <script src="js/js/sub-categories.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>

        <script>
                                                var placeSearch, autocomplete;

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

                                                    // When the user selects an address from the dropdown, populate the address
                                                    // fields in the form.
                                                    autocomplete.addListener('place_changed', fillInAddress);
                                                }

                                                function fillInAddress() {
                                                    // Get the place details from the autocomplete object.
                                                    var place = autocomplete.getPlace();
                                                    $('#city').val(place.place_id);
                                                    $('#city_string').val(place.name);
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
                                                        });
                                                    }
                                                }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>