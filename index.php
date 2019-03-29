<?php
include_once(dirname(__FILE__) . '/class/include.php');
//include_once(dirname(__FILE__) . '/active-nav.php');

if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/flaticon.css" rel="stylesheet" type="text/css"/>
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
        <?php
        include './banner.php';
        ?>
        <div class="">


            <div class="row">
                <!-- Main Content -->
                <main class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                    <section class="ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h2>Flip.lk</h2>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum
                                        </p>
                                    </div>
                                    <div class="col-xl-6 background-image">
                                        <img src="img/shopper.jpg" alt=""/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                    <section class="category-wrap-layout1 padding-top-100 padding-bottom-100 overlay-dark-70 parallaxie bg--dark" data-bg-image="img/figure/figure2.jpg" style="background-image: url(&quot;https://radiustheme.com/demo/html/listygo/listygo/img/figure/figure2.jpg&quot;); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center -112.842px;">
                        <div class="container index-container">
                            <div class="section-heading heading-light heading-center">
                                <div class="item-sub-title">Explore some of the best place by categories</div>
                                <h2 class="item-title">What are you interested in?</h2>
                            </div>
                            <div class="row">
                                <?php
                                foreach (BusinessCategory::all() as $key => $category) {
                                    $count = Advertisement::countAdsByCategory($category['id']);

                                    if ($key < 12) {
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-4 ">
                                            <div class="category-box-layout1">
                                                <div class="item-icon">
                                                    <img src="upload/business-category/<?php echo $category['image_name']; ?>" alt=""/>
                                                </div>
                                                <h3 class="item-title"><a href="advertisements.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></h3>
                                                <div class="listing-number">
                                                    <?php
                                                    if ($count == 1) {
                                                        echo number_format($count) . ' Advertisement';
                                                    } else {
                                                        echo number_format($count) . ' Advertisements';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                    <!--Advertisement Section-->
                    <div class="ui-block ui-ad-block ad-container listing-dire">
                        <div class="hot-items carousel-wrapper container index-container ">
                            <div class="section-heading heading-dark heading-center">
                                <div class="item-sub-title">Discover our latest listing around the world</div>
                                <h2 class="item-title">New Listings in Our Directory</h2>
                            </div>

                            <div id="ad-slider" class="owl-carousel owl-theme">

                                <?php
                                foreach (Advertisement::all() as $key => $ad) {

                                    $images = AdvertisementImage::getPhotosByAdId($ad['id']);
                                    $MEM = new Member($ad['member']);
                                    $CAT = new BusinessCategory($ad['category']);
                                    $result = getTime($ad['created_at']);
                                    ?>
                                    <div class="item" style="">
                                        <div class="listing-box-grid">
                                            <div class="product-box border-box">
                                                <div class="item-img bg--gradient-50">
                                                    <div class="item-status status-open active">
                                                        <?php
                                                        if ($ad['price']) {
                                                            echo 'Rs. ' . number_format($ad['price']);
                                                        } else {
                                                            echo 'Negotiable';
                                                        }
                                                        ?>
                                                    </div>
                                                    <!--<div class="item-status status-save">Save 15%</div>-->
                                                    <?php
                                                    if (count($images) > 0) {
                                                        foreach ($images as $key1 => $image) {
                                                            if ($key1 == 0) {
                                                                ?>
                                                                <img src="upload/advertisement/thumb3/<?php echo $image['image_name']; ?>"  alt="Listing" class="img-fluid grid-view-img" />
                                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <img src="upload/advertisement/thumb3/advertising.jpg"  alt="Listing" class="img-fluid grid-view-img" />
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="item-logo" title="<?php echo $CAT->name; ?>"><img src="upload/business-category/<?php echo $CAT->image_name; ?>" alt="Logo"></div>
                                                </div>
                                                <div class="item-content">
                                                    <h3 class="item-title">
                                                        <a href="view-advertisement.php?id=<?php echo $ad['id']; ?>">
                                                            <?php
                                                            if (strlen($ad['title']) > 22) {
                                                                echo substr($ad['title'], 0, 21) . '...';
                                                            } else {
                                                                echo $ad['title'];
                                                            }
                                                            ?>
                                                        </a>
                                                    </h3>
                                                    <!--<span class="item-paragraph">-->
                                                    <?php
//                                                        if (strlen($ad['description']) > 50) {
//                                                            echo substr($ad['description'], 0, 45) . '...';
//                                                        } else {
//                                                            echo $ad['description'];
//                                                        }
                                                    ?>
                                                    <!--</span>-->
                                                    <ul class="contact-info">
                                                        <li><i class="fas fa-map-marker-alt"></i><?php echo $ad['address']; ?></li>
                                                        <li><i class="fas fa-phone"></i>
                                                            <?php
                                                            if ($ad['phone_number']) {
                                                                echo $ad['phone_number'];
                                                            } elseif ($MEM->phoneNumber) {
                                                                echo $MEM->phoneNumber;
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </li>
                                                        <li class="globe-icon"><i class="fas fa-globe"></i>
                                                            <?php
                                                            if ($ad['website']) {
                                                                echo $ad['website'];
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                    <ul class="meta-item">
                                                        <li class="ctg-name">
                                                            <a><img src="upload/member/<?php echo $MEM->profilePicture; ?>" class="img-responsive img-circle" alt=""/> <?php echo $MEM->firstName . ' ' . $MEM->lastName; ?>
                                                                <div class="ad-time ad-time1"><i class="fa fa-clock"></i> <?php echo $result; ?></div>
                                                            </a>

                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--End Advertisement Section-->
                </main>
                <!-- ... end Main Content -->
            </div>
        </div>
        <!--footers-->
        <?php
        include './footer.php';
        ?>
        <!--end footer-->
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
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="js/js/post-images.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/index-ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
        <script src="js/js/shared-ad.js" type="text/javascript"></script>
        <script src="js/js/edit-post.js" type="text/javascript"></script>
        <script src="js/js/delete-post.js" type="text/javascript"></script>
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