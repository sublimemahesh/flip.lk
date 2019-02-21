<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$MEMBER = new Member($id);
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Member || Flip.lk</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>
    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?> 
        <section class="content">
            <div class="container-fluid"> 
                <?php
                $vali = new Validator();
                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Edit Member</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-members.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/member.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="first_name">First Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="first_name" class="form-control" placeholder="Enter first name" autocomplete="off" name="first_name" value="<?php echo $MEMBER->firstName; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="last_name" class="form-control" placeholder="Enter last name" autocomplete="off" name="last_name" value="<?php echo $MEMBER->lastName; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="email" id="email" class="form-control" placeholder="Enter email" autocomplete="off" name="email" disabled value="<?php echo $MEMBER->email; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="phone_number">Phone Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="phone_number" class="form-control" placeholder="Enter phone number" autocomplete="off" name="phone_number" value="<?php echo $MEMBER->phoneNumber; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="district">District</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <!--<input type="text" id="district" class="form-control" placeholder="Enter district" autocomplete="off" name="district" value="<?php echo $MEMBER->district; ?>" />-->
                                                    <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete">
                                                    <input type="hidden" name="district" id="district"  value="<?php echo $MEMBER->district; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="phone_number">City</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <!--<input type="text" id="city" class="form-control" placeholder="Enter city" autocomplete="off" name="city" value="<?php echo $MEMBER->city; ?>" />-->
                                                    <input type="text" id="autocomplete2" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete">
                                                    <input type="hidden" name="city" id="city"  value="<?php echo $MEMBER->city; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="address" class="form-control" placeholder="Enter address" autocomplete="off" name="address" value="<?php echo $MEMBER->address; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="dob">Date of Birth</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="dob" class="form-control" placeholder="Enter date of birth" autocomplete="off" name="dob" value="<?php echo $MEMBER->dob; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="occupation">Occupation</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="occupation" class="form-control" placeholder="Enter occupation" autocomplete="off" name="occupation" value="<?php echo $MEMBER->occupation; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="gender">Gender</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <input type="radio" class="gender" name="gender" value="female" <?php
                                                if ($MEMBER->gender == 'female') {
                                                    echo 'checked';
                                                }
                                                ?> > Female <br />
                                                <input type="radio" class="gender" name="gender" value="male" <?php
                                                if ($MEMBER->gender == 'male') {
                                                    echo 'checked';
                                                }
                                                ?> > Male
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="civil_status">Civil Status</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="radio" class="civil_status" name="civil_status" value="married" <?php
                                                    if ($MEMBER->civilStatus == 'married') {
                                                        echo 'checked';
                                                    }
                                                    ?> > Married <br />
                                                    <input type="radio" class="civil_status" name="civil_status" value="not_married" <?php
                                                    if ($MEMBER->civilStatus == 'not_married') {
                                                        echo 'checked';
                                                    }
                                                    ?> > Single
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="short_description">Short Description</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="description" name="short_description"><?php echo $MEMBER->aboutMe; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <label class="form-label">Profile Picture</label>
                                                <div class="form-line">
                                                    <?php
                                                    if ($MEMBER->profilePicture) {
                                                        ?>
                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" id="image" class="img-responsive img-thumbnail" width="150" alt="profile picture">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="../upload/member/member.png" id="image" class="img-responsive img-thumbnail" alt="profile picture">
                                                        <?php
                                                    }
                                                    ?>
                                                    <input type="file" id="profile" class="form-control" name="profile_picture">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <label class="form-label">Cover Picture</label>
                                                <div class="form-line">
                                                    <?php
                                                    if ($MEMBER->profilePicture) {
                                                        ?>
                                                    <img src="../upload/member/cover-picture/<?php echo $MEMBER->coverPicture; ?>" class="img-responsive img-thumbnail" height="150" alt="cover picture">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="../upload/member/cover-picture/cover.jpg" class="img-responsive img-thumbnail" alt="cover picture">
                                                        <?php
                                                    }
                                                    ?>

                                                    <input type="file" id="cover" class="form-control" name="cover_picture">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="row clearfix">
                                                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                                <label for="category">Category</label>
                                                                            </div>
                                                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                                <div class="form-group">
                                                                                    <div class="form-line">
                                                                                        <select name="category" class="form-control">
                                                                                            <option value="">-- Please Select --</option>
                                    <?php
                                    foreach (BusinessCategory::all() as $category) {
                                        if ($category['id'] == $MEMBER->category) {
                                            ?>
                                                                                                                                                                                                    <option value="<?php echo $category['id']; ?>" selected><?php echo $category['name']; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                                                                                                                                                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row clearfix">
                                                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                                                <label for="sub_category">Sub Category</label>
                                                                            </div>
                                                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                                                <div class="form-group">
                                                                                    <div class="form-line">
                                                                                        <select name="category" class="form-control">
                                                                                            <option value="">-- Please Select --</option>
                                    <?php
                                    foreach (BusinessSubCategory::all() as $subcategory) {
                                        if ($subcategory['id'] == $MEMBER->subCategory) {
                                            ?>
                                                                                                                                                                                                    <option value="<?php echo $subcategory['id']; ?>" selected><?php echo $subcategory['name']; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                                                                                                                                                                                    <option value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <input type="hidden" name="oldProfileImageName" value="<?php echo $MEMBER->profilePicture; ?>" />
                                            <input type="hidden" name="oldCoverImageName" value="<?php echo $MEMBER->coverPicture; ?>" />
                                            <input type="hidden" name="id" value="<?php echo $MEMBER->id; ?>" />
                                            <input type="submit" name="update" class="btn btn-primary m-t-15 waves-effect" value="Save Changes"/>
                                        </div>
                                    </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map" ></div>
        </section>
        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
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