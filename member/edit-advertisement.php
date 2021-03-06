<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ADVERTISEMENT = new Advertisement($id);
$GROUP = new Group($ADVERTISEMENT->groupId);
$CATEGORY = new BusinessCategory($GROUP->category);
$SUBCATEGORY = new BusinessSubCategory($GROUP->subCategory);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Advertisement || Flip.lk</title>
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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
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
            <!--<div class="container">-->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <h6 class="title">Manage Advertisement</h6>
                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12 manage-group-section">
                                <a class="btn btn-blue btn-md-2" id="delete-ad"   ad_id="<?php echo $id; ?>">Delete Advertisement</a>
                            </div>
                        </div>
                        <div class="ui-block-content">
                            <div class="description-toggle col-md-6">
                                <div class="description-toggle-content">
                                    <div class="h6">Status</div>
                                    <p>
                                        <?php
                                        if ($ADVERTISEMENT->status == 1) {
                                            echo 'Published';
                                        } else {
                                            echo 'Unpublished';
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" id="publish-ad" <?php
                                        if ($ADVERTISEMENT->status == 1) {
                                            echo 'checked=""';
                                        };
                                        ?>  ad_id="<?php echo $id; ?>" status="<?php echo $ADVERTISEMENT->status; ?>">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Edit Advertisement</h6>
                        </div>
                        <div class="ui-block-content">
                            <!-- Personal Information Form  -->
                            <form method="post" id="form-edit-ad">
                                <div class="row">

                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <input class="form-control" placeholder="" name="title" id="title" type="text" value="<?php echo $ADVERTISEMENT->title; ?>">
                                        </div>

                                        <div class="form-group label-floating">
                                            <label class="control-label"></label>
                                            <textarea class="form-control" placeholder="" name="description" id="description"><?php echo $ADVERTISEMENT->description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" placeholder="" type="text"  name="address" id="address" value="<?php echo $ADVERTISEMENT->address; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">City</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="city" id="city" value="">-->
                                            <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete">
                                            <input type="hidden" name="city" id="city"  value="<?php echo $ADVERTISEMENT->city; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Phone Number</label>
                                            <input class="form-control" placeholder="" type="text"  name="phonenumber" id="phonenumber" value="<?php echo $ADVERTISEMENT->phoneNumber; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input class="form-control" placeholder="" type="text"  name="email" id="email" value="<?php echo $ADVERTISEMENT->email; ?>">
                                        </div>
                                    </div>

                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Price (Rs)</label>
                                            <input class="form-control" placeholder="" name="price" id="price" type="text" value="<?php echo $ADVERTISEMENT->price; ?>" >
                                        </div>
                                    </div>
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

                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Website</label>
                                            <input class="form-control" placeholder="" name="website" id="website" type="text" value="<?php echo $ADVERTISEMENT->website; ?>">
                                        </div>
                                    </div>
                                    <div id="gallery"></div>
                                    <div id="remove-circle"></div>
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
                                                                    <input multiple="" name="upload-other-images" title="Choose a file to upload" data-testid="add-more-photos" display="inline-block" type="file" class="_uploadinput _outlinenone" id="add-more-photos-edit">
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
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="city_string" id="city_string" value="<?php echo $ADVERTISEMENT->cityString; ?>"/>
                                        <input type="hidden" name="edit" id="" value="" />
                                        <a name="" id="edit-ad" class="btn btn-primary btn-lg full-width" >Save all Changes</a>
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
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/edit-ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
        <script src="js/heartcode-canvasloader.js" type="text/javascript"></script>
        <script src="js/image-preloader.js" type="text/javascript"></script>
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
                    var place_id = $('#city').val();
                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#autocomplete').val(place.name);
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