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
$setLimit = 20;
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
if (isset($_GET['location'])) {
    $location = $_GET['location'];
}
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

$advertisements = Advertisement::searchAdvertisements($category1, $subcategory, $location, $keyword, $pageLimit, $setLimit);
$boostadvertisements = Advertisement::searchBoostAdvertisements($category1, $subcategory, $location, $keyword, $pageLimit, $setLimit);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Advertisements || Flip.lk</title>
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
                        <div class="ad-breadcrumbs col-sm-12">
                            <?php
                            if ($category1 !== "" && $location !== "") {
                                if (empty($subcategory)) {
                                    ?>
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                    <span class="breadcrumb-item">
                                        <a href="advertisements.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a></span>
                                    <span class="breadcrumb-item location"></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                    <span class="breadcrumb-item">
                                        <a href="advertisements.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a>
                                    </span>
                                    <span class="breadcrumb-item">
                                        <a href="advertisements.php?category=<?php echo $BUSCAT->id; ?>subcategory=<?php echo $BUSSUBCAT->id; ?>" ><?php echo $BUSSUBCAT->name; ?></a>
                                    </span>
                                    <span class="breadcrumb-item location"></span>
                                    <?php
                                }
                            } else if ($category1 !== "" && $location == "") {
                                if (empty($subcategory)) {
                                    ?>
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item"><?php echo $BUSCAT->name; ?></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                    <span class="breadcrumb-item">
                                        <a href="advertisements.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a>
                                    </span>
                                    <span class="breadcrumb-item">
                                        <?php echo $BUSSUBCAT->name; ?>
                                    </span>
                                    <?php
                                }
                            } else if ($location !== "" && $category1 == "") {
                                ?>
                                <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item location"></span>
                                <?php
                            } else if ($keyword !== "" && $location == "" && $category1 == "") {
                                ?>
                                <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item">All advertisements in Sri Lanka</span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col col-xl-8 col-xl-offset-2 order-xl-2 col-lg-8 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">

                                <div class="ui-block">
                                    <?php
                                    if (count($boostadvertisements) > 0) {
                                        foreach ($boostadvertisements as $key => $ad) {
                                            $result = getTime($ad['created_at']);
                                            $MEMBER = new Member($ad['member']);
                                            $CATEGORY = new BusinessCategory($ad['category']);
                                            $SUBCATEGORY = new BusinessSubCategory($ad['sub_category']);
                                            $adimages = AdvertisementImage::getPhotosByAdId($ad['id']);
                                            ?>
                                            <div class="ad-item post">
                                                <a href="view-advertisement.php?id=<?php echo $ad['id']; ?>">
                                                    <div class="ad-item-box row">
                                                        <div class = "col-xl-4 col-xs-4 ad-item-image">
                                                            <?php
                                                            if (count($adimages) > 0) {
                                                                foreach ($adimages as $key => $img) {
                                                                    if ($key == 0) {
                                                                        ?>
                                                                        <img src="upload/advertisement/thumb3/<?php echo $img['image_name']; ?>" alt=""/>
                                                                        <?php
                                                                    }
                                                                }
                                                            } else {
                                                                ?>
                                                                <img src="upload/advertisement/thumb3/advertising.jpg" alt=""/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class = "col-xl-8 col-xs-8 ad-item-details">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <div class="ad-title">
                                                                        <?php
                                                                        if ($ad['title']) {
                                                                            if (strlen($ad['title']) > 25) {
                                                                                echo substr($ad['title'], 0, 25) . '...';
                                                                            } else {
                                                                                echo $ad['title'];
                                                                            }
                                                                        } else {
                                                                            echo 'Advertisement';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5 ad-price">
                                                                    <?php
                                                                    if ($ad['price'] == 0) {
                                                                        echo 'Negotiable';
                                                                    } else {
                                                                        echo 'Rs. ' . number_format($ad['price'], 2) . '/=';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="ad-category"><span class="title">Category : </span><?php echo $CATEGORY->name; ?></div>
                                                            <div class="ad-subcategory"><span class="title">Sub Category : </span><?php echo $SUBCATEGORY->name; ?></div>
                                                            <div class="ad-city"><span class="title">City : </span><?php echo $ad['city_string']; ?></div>
                                                            <div class="row boost-time col-sm-12">
                                                                <div class="ad-time col-sm-6"><i class="fa fa-clock"></i> <?php echo $result; ?></div>
                                                                <div class="boost-ad col-sm-6"><span><i class="fa fa-certificate "></i> Top Ad </span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }

                                    if (count($advertisements) > 0) {
                                        foreach ($advertisements as $key => $ad) {
                                            $result = getTime($ad['created_at']);
                                            $MEMBER = new Member($ad['member']);
                                            $CATEGORY = new BusinessCategory($ad['category']);
                                            $SUBCATEGORY = new BusinessSubCategory($ad['sub_category']);
                                            $adimages = AdvertisementImage::getPhotosByAdId($ad['id']);
                                            ?>
                                            <div class="ad-item post">
                                                <a href="view-advertisement.php?id=<?php echo $ad['id']; ?>">
                                                    <div class="ad-item-box row">
                                                        <div class = "col-xl-4 col-xs-4 ad-item-image">
                                                            <?php
                                                            if (count($adimages) > 0) {
                                                                foreach ($adimages as $key => $img) {
                                                                    if ($key == 0) {
                                                                        ?>
                                                                        <img src="upload/advertisement/thumb3/<?php echo $img['image_name']; ?>" alt=""/>
                                                                        <?php
                                                                    }
                                                                }
                                                            } else {
                                                                ?>
                                                                <img src="upload/advertisement/thumb3/advertising.jpg" alt=""/>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class = "col-xl-8 col-xs-8 ad-item-details">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <div class="ad-title">
                                                                        <?php
                                                                        if ($ad['title']) {
                                                                            if (strlen($ad['title']) > 25) {
                                                                                echo substr($ad['title'], 0, 25) . '...';
                                                                            } else {
                                                                                echo $ad['title'];
                                                                            }
                                                                        } else {
                                                                            echo 'Advertisement';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5 ad-price">
                                                                    <?php
                                                                    if ($ad['price'] == 0) {
                                                                        echo 'Negotiable';
                                                                    } else {
                                                                        echo 'Rs. ' . number_format($ad['price'], 2) . '/=';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="ad-category"><span class="title">Category : </span><?php echo $CATEGORY->name; ?></div>
                                                            <div class="ad-subcategory"><span class="title">Sub Category : </span><?php echo $SUBCATEGORY->name; ?></div>
                                                            <div class="ad-city"><span class="title">City : </span><?php echo $ad['city_string']; ?></div>
                                                            <div class="row boost-time col-sm-12">
                                                                <div class="ad-time col-sm-6"><i class="fa fa-clock"></i> <?php echo $result; ?></div>
                                                                <div class="view-details col-sm-6"><span>View Details</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
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
                                <?php Advertisement::showPaginationOfSearchedAdvertisement($category1, $subcategory, $location, $keyword, $setLimit, $page); ?>
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
                                                $count = Advertisement::countAdsByCategory($category['id']);
                                                ?>
                                                <li id="menu-item-<?php echo $category['id']; ?>"  class="menu-item category collapsible collapsible1"> <a href="advertisements.php?category=<?php echo $category['id']; ?>"><img src="upload/business-category/<?php echo $category['image_name']; ?>"><?php echo $category['name'] . ' (' . number_format($count) . ')'; ?></a>
                                                    <i class="icon-<?php echo $category['id']; ?> fa fa-angle-down cat-dropdown" id1="<?php echo $category['id']; ?>" times="0"></i>
                                                    <ul class="sub-menu menu-item-<?php echo $category['id']; ?> hidden">
                                                        <?php
                                                        foreach (BusinessSubCategory::getSubCategoriesByCategory($category['id']) as $subcategory) {
                                                            $countsubcat = Advertisement::countAdsBySubCategory($subcategory['id']);
                                                            ?>

                                                            <li id="sub-category-" class="menu-item ">
                                                                <a href="advertisements.php?category=<?php echo $category['id']; ?>&subcategory=<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name'] . ' (' . number_format($countsubcat) . ')'; ?></a>
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
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/base-init.js"></script>
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