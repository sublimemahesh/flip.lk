<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . './auth.php');
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ADVERTISEMENT = new Advertisement($id);
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Advertisement || Flip.lk</title>
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
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
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
                                <h2>Edit Advertisement</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-advertisements.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/advertisement.php" id="form-edit-ad" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="group">Group</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="group" class="form-control">
                                                        <option value="">-- Please Select --</option>
                                                        <?php
                                                        foreach (Group::all() as $group) {
                                                            ?>
                                                            <option value="<?php echo $group['id']; ?>" <?php
                                                            if ($group['id'] == $ADVERTISEMENT->groupId) {
                                                                echo 'selected';
                                                            }
                                                            ?>><?php echo $group['name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="title">Title</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="title" class="form-control" placeholder="Enter title" autocomplete="off" name="title" required="TRUE" value="<?php echo $ADVERTISEMENT->title; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="description">Description</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea id="description" class="form-control"name="description"><?php echo $ADVERTISEMENT->description; ?></textarea>
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
                                                    <input type="text" id="address" class="form-control" placeholder="Enter address" autocomplete="off" name="address" required="TRUE" value="<?php echo $ADVERTISEMENT->address; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="city">City</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="autocomplete" class="form-control" placeholder="" onFocus="geolocate()" name="autocomplete">
                                                    <input type="hidden" name="city" id="city"  value="<?php echo $ADVERTISEMENT->city; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="website">Website</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="website" class="form-control" placeholder="Enter website" autocomplete="off" name="website" required="TRUE" value="<?php echo $ADVERTISEMENT->website; ?>">
                                                </div>
                                            </div>
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
                                                                    <input multiple="" name="upload-other-images" title="Choose a file to upload" data-testid="add-more-photos" display="inline-block" type="file" class="_uploadinput _outlinenone" id="add-more-photos">
                                                                    <input multiple="" name="upload-ad-image" type="hidden">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </span>
                                                    <span class="_uploadloaderbox hidden">
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
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <input type="hidden" id="id" name="id" value="<?php echo $ADVERTISEMENT->id; ?>"/>
                                            <input type="submit" name="update" class="btn btn-primary m-t-15 waves-effect" value="Save Changes"/>
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <script src="tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/ad-images.js" type="text/javascript"></script>
        <script src="js/edit-ad-slider.js" type="text/javascript"></script>
        <script>
                                                        tinymce.init({
                                                            selector: "#description",
                                                            // ===========================================
                                                            // INCLUDE THE PLUGIN
                                                            // ===========================================

                                                            plugins: [
                                                                "advlist autolink lists link image charmap print preview anchor",
                                                                "searchreplace visualblocks code fullscreen",
                                                                "insertdatetime media table contextmenu paste"
                                                            ],
                                                            // ===========================================
                                                            // PUT PLUGIN'S BUTTON on the toolbar
                                                            // ===========================================

                                                            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                                                            // ===========================================
                                                            // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                                                            // ===========================================

                                                            relative_urls: false
                                                        });
        </script>
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

                autocomplete = new google.maps.places.Autocomplete(input, options);

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();

                $('#city').val(place.place_id);
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
                            $('#autocomplete').val(place.name);
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