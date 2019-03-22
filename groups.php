<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}

if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 15;
$pageLimit = ($page * $setLimit) - $setLimit;

$category1 = '';
$subcategory = '';
$location = '';
$keyword = '';

if (isset($_GET['category'])) {
    $category1 = $_GET['category'];
    $BUSCAT = new BusinessCategory($_GET['category']);
}
if (isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];
    $BUSSUBCAT = new BusinessSubCategory($_GET['subcategory']);
}

$groups = Group::searchGroups($category1, $subcategory, $pageLimit, $setLimit);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Groups || Flip.lk</title>
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
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <?php
        include './banner.php';
        ?>
        <div class="container index-container body-content">

            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <!-- Top Header-Profile -->

                <!-- ... end Top Header-Profile -->
                <div class="container">
                    <div class="row">

                        <!-- Main Content -->

                        <div class="col col-xl-8 col-xl-offset-2 order-xl-2 col-lg-8 order-lg-1 col-md-12 col-sm-12 col-12">

                            <div id="newsfeed-items-grid">
                                <div class="ad-breadcrumbs">
                                    <?php
                                    if ($category1 !== "") {
                                        if (empty($subcategory)) {
                                            ?>
                                            <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                            <span class="breadcrumb-item">
                                                <a href="groups.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a></span>
                                            <span class="breadcrumb-item location"></span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                            <span class="breadcrumb-item">
                                                <a href="groups.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a>
                                            </span>
                                            <span class="breadcrumb-item">
                                                <a href="groups.php?category=<?php echo $BUSCAT->id; ?>&subcategory=<?php echo $BUSSUBCAT->id; ?>" ><?php echo $BUSSUBCAT->name; ?></a>
                                            </span>
                                            <span class="breadcrumb-item location"></span>
                                            <?php
                                        }
                                    } else  {
                                        ?>
                                        <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item">All Groups</span>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <div class="ui-block">
                                    <?php
                                    if (count($groups) > 0) {
                                        foreach ($groups as $key => $group) {
                                            $result = getTime($group['created_at']);
                                            $CATEGORY = new BusinessCategory($group['category']);
                                            $members = GroupMember::getAllMembersByGroup($group['id']);
                                            $member_count = count($members);
                                            ?>
                                            <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                                <div class="ui-block members-in-group" data-mh="friend-groups-item">
                                                    <!-- Friend Item -->
                                                    <div class="friend-item friend-groups">
                                                        <div class="friend-item-content">
                                                            <div class="friend-avatar">
                                                                <div class="author-thumb">
                                                                    <img src="upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                                </div>
                                                                <div class="author-content">
                                                                    <a href="view-group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                                    <div class="country">
                                                                        <?php
                                                                        if ($member_count == 1) {
                                                                            $s = '';
                                                                        } else {
                                                                            $s = 's';
                                                                        }
                                                                        echo $member_count;
                                                                        ?> Member<?php echo $s; ?> in the Group</div>
                                                                </div>
                                                            </div>

                                                            <ul class="friends-harmonic">
                                                                <?php
                                                                foreach (GroupMember::getAllMembersByGroup($group['id']) as $key => $member) {
                                                                    if ($key < 6) {
                                                                        $MEMB = new Member($member['member']);
                                                                        ?>
                                                                        <li>
                                                                            <a href="#" title="<?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?>">
                                                                                <img src="upload/member/<?php echo $MEMB->profilePicture; ?>" class="friend-list-img" alt="author">
                                                                            </a>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- ... end Friend Item -->			
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="ui-block no-post">
                                            <h5>There is no any advertisements.</h5>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                            <?php Group::showPaginationOfSearchedGroups($category1, $subcategory, $setLimit, $page); ?>
                            </div>
                        </div>
                        <!-- ... end Main Content -->
                        <!-- Left Sidebar -->
                        <div class="sidebar col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 col-sm-12 col-12 hidden-sm">

                            <div id="secondary" class="secondary">
                                <nav id="site-navigation" class="main-navigation" role="navigation">
                                    <div class="menu-feature-container">
                                        <p>Categories</p>
                                        <ul id="menu-feature" class="nav-menu">
                                            <?php
                                            foreach (BusinessCategory::all() as $category) {
                                                $count = Group::countGroupsByCategory($category['id']);
                                                ?>
                                                <li id="menu-item-<?php echo $category['id']; ?>"  class="menu-item category collapsible collapsible1"> <img src="upload/business-category/<?php echo $category['image_name']; ?>"><?php echo $category['name'] . ' (' . number_format($count) . ')'; ?>
                                                    <i class="icon-<?php echo $category['id']; ?> fa fa-angle-down cat-dropdown" id1="<?php echo $category['id']; ?>" times="0"></i>
                                                    <ul class="sub-menu menu-item-<?php echo $category['id']; ?> hidden">
                                                        <?php
                                                        foreach (BusinessSubCategory::getSubCategoriesByCategory($category['id']) as $subcategory) {
                                                            $countsubcat = Group::countGroupsBySubCategory($subcategory['id']);
                                                            ?>

                                                            <li id="sub-category-" class="menu-item ">
                                                                <a href="groups.php?category=<?php echo $category['id']; ?>&subcategory=<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name'] . ' (' . number_format($countsubcat) . ')'; ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>


                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </nav><!-- .main-navigation -->
                            </div><!-- .secondary -->

                        </div>
                        <!-- ... end Left Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="autocomplete2" placeholder="Location" value="<?php echo $_GET['location']; ?>">
        <div id="map"></div>
        <?php
        include './footer.php';
        ?>
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- Window-popup -->


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
        <script src="js/sticky-sidebar.js"></script>
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/all-ad-slider.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script>
            var placeSearch, autocomplete;
            $('#city').val($('#autocomplete2').val());
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

                            $('.location').text(place.name);
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
        <script>
            $(document).ready(function () {

//                $(".cat-dropdown").click(function () {
                $(".category").on('click', '.cat-dropdown', function () {
                    var attr = $(this).attr("id1");
                    var times = $(this).attr("times");
                    if (times == 0) {
                        $(".menu-item-" + attr).removeClass("hidden");
                        $(this).attr("times", "1");
                        $(".icon-" + attr).removeClass("fa-angle-down");
                        $(".icon-" + attr).addClass("fa-angle-up");

                    } else {
                        $(".menu-item-" + attr).addClass("hidden");
                        $(this).attr("times", "0");
                        $(".icon-" + attr).removeClass("fa-angle-up");
                        $(".icon-" + attr).addClass("fa-angle-down");
                    }
                });
            });

        </script>
    </body>
</html>