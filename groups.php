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
if (isset($_GET['location'])) {
    $location = $_GET['location'];
}
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

$groups = Group::searchGroups($category1, $subcategory, $location, $keyword, $pageLimit, $setLimit);
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
                        <div class="ad-breadcrumbs col-sm-12">
                            <div class="ad-breadcrumbs">
                                <?php
                                if ($category1 !== "" && $location !== "") {
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
                                            <a href="groups.php?category=<?php echo $BUSCAT->id; ?>subcategory=<?php echo $BUSSUBCAT->id; ?>" ><?php echo $BUSSUBCAT->name; ?></a>
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
                                            <a href="groups.php?category=<?php echo $BUSCAT->id; ?>" ><?php echo $BUSCAT->name; ?></a>
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
                                } else if ($location == "" && $category1 == "") {
                                    ?>
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item">All Groups</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col col-xl-12 col-xl-offset-2 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            
                            

                                <div class="group-search s002">
                                    <form action="groups.php" method="get">
                                        <div class="inner-form">
                                            <div class="input-field fouth-wrap">
                                                <div class="icon-wrap">

                                                    <svg height="24" viewBox="0 -52 512 512" width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="m0 0h113.292969v113.292969h-113.292969zm0 0"/>
                                                    <path d="m149.296875 0h362.703125v113.292969h-362.703125zm0 0"/>
                                                    <path d="m0 147.007812h113.292969v113.292969h-113.292969zm0 0"/>
                                                    <path d="m149.296875 147.007812h362.703125v113.292969h-362.703125zm0 0"/>
                                                    <path d="m0 294.011719h113.292969v113.296875h-113.292969zm0 0"/>
                                                    <path d="m149.296875 294.011719h362.703125v113.296875h-362.703125zm0 0"/>
                                                    </svg>
                                                </div>
                                                <select class="category-select-box" name="category">
                                                    <option value="">Category</option>
                                                    <?php
                                                    foreach (BusinessCategory::all() as $key => $category) {
                                                        ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-field first-wrap">
                                                <div class="icon-wrap">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                                <input id="search" type="text" name="keyword" placeholder="What are you looking for?" />
                                            </div>
                                            <div class="input-field fifth-wrap">
                                                <button class="btn-search" type="submit">SEARCH</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            <div id="newsfeed-items-grid">

                                <div class="">
                                    <?php
                                    if (count($groups) > 0) {
                                        foreach ($groups as $key => $group) {
                                            $result = getTime($group['created_at']);
                                            $CATEGORY = new BusinessCategory($group['category']);
                                            $members = GroupMember::getAllMembersByGroup($group['id']);
                                            $member_count = count($members);
                                            ?>
                                            <div class="col col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-12 col-12">
                                                <div class="ui-block members-in-group" data-mh="friend-groups-item">
                                                    <!-- Friend Item -->
                                                    <div class="friend-item friend-groups">
                                                        <div class="friend-item-content">
                                                            <div class="friend-avatar">
                                                                <div class="author-thumb">
                                                                    <a href="view-group.php?id=<?php echo $group['id']; ?>"><img src="upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus"></a>
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
                                                                    <div class="country">
                                                                        <?php echo 'Category: ' . $CATEGORY->name; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <ul class="friends-harmonic">
                                                                <?php
                                                                foreach (GroupMember::getAllMembersByGroup($group['id']) as $key => $member) {
                                                                    if ($key < 6) {
                                                                        $MEMB = new Member($member['member']);
                                                                        ?>
                                                                        <li>
                                                                            <a href="view-group.php?id=<?php echo $group['id']; ?>" title="<?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?>">
                                                                                <?php
                                                                                if ($MEMB->profilePicture) {
                                                                                    if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                        <?php
                                                                                    } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="upload/member/<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                        <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <img alt="author" src="upload/member/member.png" class="friend-list-img" alt="profile">
                                                                                    <?php
                                                                                }
                                                                                ?>


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
                                            <h5>There is no any groups.</h5>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>

                            <div class="row col-xl-12">
                                <?php Group::showPaginationOfSearchedGroups($category1, $subcategory, $location, $keyword, $setLimit, $page); ?>
                            </div>
                        </div>

                        <!-- ... end Main Content -->
                        <!-- Left Sidebar -->
                        <!--                        <div class="sidebar col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 col-sm-12 col-12 hidden-sm">
                        
                                                    <div id="secondary" class="secondary">
                                                        <nav id="site-navigation" class="main-navigation" role="navigation">
                                                            <div class="menu-feature-container">
                                                                <p>Categories</p>
                                                                <ul id="menu-feature" class="nav-menu">
                        <?php
                        foreach (BusinessCategory::all() as $category) {
                            $count = Group::countGroupsByCategory($category['id']);
                            ?>
                                                                        <li id="menu-item-<?php echo $category['id']; ?>"  class="menu-item category collapsible collapsible1"> <a href="groups.php?category=<?php echo $category['id']; ?>"><img src="upload/business-category/<?php echo $category['image_name']; ?>"><?php echo $category['name'] . ' (' . number_format($count) . ')'; ?></a>
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
                                                        </nav> .main-navigation 
                                                    </div> .secondary 
                        
                                                </div>-->
                        <!-- ... end Left Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="autocomplete2" placeholder="Location" value="<?php echo $location; ?>">
        <div id="map"></div>
        <?php
        include './footer.php';
        ?>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/all-ad-slider.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
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