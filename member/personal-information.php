<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$MEM = new Member($_SESSION['id']);
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
        <div class="header-spacer"></div>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <?php
            include './profile-header.php';
            ?>

            <!--<div class="container">-->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <h6 class="title">Manage Account</h6>
                            </div>
                            <!--                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12 manage-group-section">
                                                            <a class="btn btn-blue btn-md-2" id="delete-group" member_id="<?php echo $MEMBER->id; ?>">Delete Profile</a>
                                                        </div>-->
                        </div>
                        <div class="ui-block-content">
                            <div class="description-toggle col-md-6">
                                <div class="description-toggle-content">
                                    <div class="h6">Status</div>
                                    <p>
                                        <?php
                                        if ($MEMBER->status == 1) {
                                            echo 'Active';
                                        } else {
                                            echo 'Deactive';
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="togglebutton">
                                    <label>
                                        <input type="checkbox" id="active-profile" <?php
                                        if ($MEMBER->status == 1) {
                                            echo 'checked=""';
                                        };
                                        ?>  member_id="<?php echo $MEMBER->id; ?>" status="<?php echo $MEMBER->status; ?>">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                            <input class="form-control" placeholder="" name="address" type="text" value="<?php echo $MEMBER->address; ?>">
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating district-label">
                                            <label class="control-label">Your District</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="district" id="district" value="">-->
                                            <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                            <input type="hidden" name="district" id="district"  value="<?php echo $MEMBER->district; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating city-label">
                                            <label class="control-label">Your City</label>
                                            <!--<input class="form-control" placeholder="" type="text" name="city" id="city" value="">-->
                                            <input type="text" id="autocomplete2" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete" required="TRUE">
                                            <input type="hidden" name="city" id="city"  value="<?php echo $MEMBER->city; ?>"/>
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
            <!-- ... end Your Account Personal Information -->
        </div>
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
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/profile.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
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