<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Flip.lk</title>

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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <style>
            .comment-item1 {
                display: none;
            }
            .comment-reply-item {
                display: none;
            }
        </style>
    </head>
    <body>

        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <div class="container index-container">
            <!--Search Box-->
            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="s002">
                    <form>
                        <div class="inner-form">
                            <div class="input-field first-wrap">
                                <div class="icon-wrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                    </svg>
                                </div>
                                <input id="search" type="text" placeholder="What are you looking for?" />
                            </div>
                            <div class="input-field fouth-wrap">
                                <div class="icon-wrap">
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                    </svg>-->
                                    <svg height="24" viewBox="0 -52 512 512" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m0 0h113.292969v113.292969h-113.292969zm0 0"/>
                                    <path d="m149.296875 0h362.703125v113.292969h-362.703125zm0 0"/>
                                    <path d="m0 147.007812h113.292969v113.292969h-113.292969zm0 0"/>
                                    <path d="m149.296875 147.007812h362.703125v113.292969h-362.703125zm0 0"/>
                                    <path d="m0 294.011719h113.292969v113.296875h-113.292969zm0 0"/>
                                    <path d="m149.296875 294.011719h362.703125v113.296875h-362.703125zm0 0"/>
                                    </svg>
                                </div>
                                <select data-trigger="" name="choices-single-defaul">
                                    <option>Category</option>

                                    <?php
                                    foreach (BusinessCategory::all() as $key => $category) {
                                        ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-field second-wrap">
                                <div class="icon-wrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="autocomplete" placeholder="Location" onFocus="geolocate()" name="autocomplete">
                                <input type="hidden" name="city" id="city"  value=""/>
                            </div>

                            <div class="input-field fifth-wrap">
                                <button class="btn-search" type="button">SEARCH</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Search Box-->
            <div class="row">
                <!-- Main Content -->
                <main class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                    <!--Category Section-->
                    <div class="ui-block ad-container">
                        <div class="hot-items carousel-wrapper">
                            <header class="content-title">
                                <div class="title-bg">
                                    <h2 class="title1">Categories</h2>
                                </div>
                                <p class="title-desc">Only with us you can get a new model with a discount.</p>
                            </header>
                            <div class="category-list row container">
                                <?php
                                foreach (BusinessCategory::all() as $category) {
                                    ?>
                                    <div class="col-xl-2 category-item-box">
                                        <div class="cat-img">
                                            <img src="../upload/business-category/<?php echo $category['image_name']; ?>" alt=""/>
                                        </div>
                                        <div class="cat-title">
                                            <h4><?php echo $category['name']; ?></h4>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- End Category Section-->

                    <!--Advertisement Section-->
                    <div class="ui-block ad-container">
                        <div class="hot-items carousel-wrapper">
                            <header class="content-title">
                                <div class="title-bg">
                                    <h2 class="title1">Advertisements</h2>
                                </div>
                                <p class="title-desc">Only with us you can get a new model with a discount.</p>
                            </header>
                            <div class="carousel-controls">
                                <div id="hot-items-slider-prev" class="carousel-btn carousel-btn-prev">
                                </div>
                                <div id="hot-items-slider-next" class="carousel-btn carousel-btn-next carousel-space"></div>
                            </div>
                            <div id="ad-slider" class="owl-carousel">
                                <?php
                                foreach (Advertisement::all() as $key => $ad) {
                                    $images = AdvertisementImage::getPhotosByAdId($ad['id']);
                                    $MEM = new Member($ad['member']);
                                    $CAT = new BusinessCategory($ad['category']);
                                    ?>
                                    <div class="item">
                                        <div class="slider-img-section">
                                            <?php
                                            if (count($images) > 0) {
                                                foreach ($images as $key1 => $image) {
                                                    if ($key1 == 0) {
                                                        ?>
                                                        <img src="../upload/advertisement/thumb/<?php echo $image['image_name']; ?>" alt=""/>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <img src="../upload/advertisement/thumb/advertising.jpg" alt=""/>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="slider-details-section">
                                            <div class="title">
                                                <h5><?php echo $ad['title']; ?></h5>
                                            </div>
                                            <div class="created-date">
                                                <?php echo substr($ad['created_at'], 0, 10); ?>
                                            </div>
                                            <div class="description">
                                                <?php
                                                if (strlen($ad['description']) > 100) {
                                                    echo substr($ad['description'], 0, 98) . '...';
                                                } else {
                                                    echo $ad['description'];
                                                }
                                                ?>
                                            </div>
                                            <hr />
                                            <div class="slider-item-footer row">
                                                <div class="col-xs-8 col-xl-8 member-details row">
                                                    <div class="col-xl-3 order-1 col-xs-3 ">
                                                        <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" class="img-responsive img-circle" alt=""/>
                                                    </div>
                                                    <div class="col-xl-9 order-2 col-xs-9 mem-name">
                                                        <h6 class="" title="<?php echo $MEM->firstName . ' ' . $MEM->lastName; ?>">
                                                            <?php
                                                            if (strlen($MEM->firstName . ' ' . $MEM->lastName) > 14) {
                                                                echo substr($MEM->firstName . ' ' . $MEM->lastName, 0, 13) . '...';
                                                            } else {
                                                                echo $MEM->firstName . ' ' . $MEM->lastName;
                                                            }
                                                            ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-xl-4 category">
                                                    <h6><i class="fa fa-list"></i> <?php echo $CAT->name; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!--                                <div class="item">
                                                                    <div class="slider-img-section">
                                                                        <img src="../upload/advertisement/thumb/-151981300_191051159606_1550131986_n.jpg" alt=""/>
                                                                    </div>
                                                                    <div class="slider-details-section">
                                                                        <div class="title">
                                                                            <h5>Advertisement TItle</h5>
                                                                        </div>
                                                                        <div class="created-date">
                                                                            2019-02-12
                                                                        </div>
                                                                        <div class="description">
                                                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,</p>
                                                                        </div>
                                                                        <hr />
                                                                        <div class="slider-item-footer row">
                                                                            <div class="col-xs-8 col-xl-8 member-details row">
                                                                                <div class="col-xl-3 order-1 col-xs-3 ">
                                                                                    <img src="../upload/member/-105556340_191097584566_1550730247_n.jpg" class="img-responsive img-circle" alt=""/>
                                                                                </div>
                                                                                <div class="col-xl-9 order-2 col-xs-9 mem-name">
                                                                                    <h6 class="">Kavini Nisansala</h6>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-4 col-xl-4 category">
                                                                                <h6><i class="fa fa-list"></i> Lands</h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </div>
                        </div>
                    </div>
                    <!--End Advertisement Section-->
                </main>
                <!-- ... end Main Content -->
            </div>
        </div>
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
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/post-images.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/index-ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
        <!--<script src="js/js/ad-comment.js" type="text/javascript"></script>-->
        <!--<script src="js/js/ad-reply.js" type="text/javascript"></script>-->
        <script src="js/js/shared-ad.js" type="text/javascript"></script>
        <script src="js/js/edit-post.js" type="text/javascript"></script>
        <script src="js/js/delete-post.js" type="text/javascript"></script>
        <!--<script src="js/js/post-comment.js" type="text/javascript"></script>-->
        <!--<script src="js/js/post-reply.js" type="text/javascript"></script>-->
        <script src="js/js/index-post-comment.js" type="text/javascript"></script>
        <script src="js/js/index-post-reply.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/heartcode-canvasloader.js" type="text/javascript"></script>
        <script src="js/image-preloader.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="plugins/OwlCarousel/dist/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>