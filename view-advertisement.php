<?php
include_once(dirname(__FILE__) . '/class/include.php');

$id = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ADVERTISEMENT = new Advertisement($id);
$ADIMAGES = AdvertisementImage::getPhotosByAdId($id);
$MEM = new Member($ADVERTISEMENT->member);
$CATEGORY = new BusinessCategory($ADVERTISEMENT->category);
$SUBCATEGORY = new BusinessSubCategory($ADVERTISEMENT->subCategory);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile || Flip.lk</title>
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
        <link href="plugins/OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
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
            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <!-- Top Header-Profile -->

                <!-- ... end Top Header-Profile -->
                <div class="container">
                    <div class="row">

                        <!-- Main Content -->

                        <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-12 col-sm-12 col-12">

                            <div id="newsfeed-items-grid">
                                <div class="ad-breadcrumbs">
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span>
                                    <span class="breadcrumb-item"><a href="all-advertisement.php" >All advertisements in Sri Lanka</a></span>
                                    <span class="breadcrumb-item"><a href="advertisements.php?category=<?php echo $ADVERTISEMENT->category; ?>"><?php echo $CATEGORY->name; ?></a></span>
                                    <span class="breadcrumb-item"><a href="advertisements.php?location=<?php echo $ADVERTISEMENT->city; ?>" id="breadcrumbs-city"></a></span>
                                    <span class="breadcrumb-item"><?php echo $ADVERTISEMENT->title; ?></span>
                                </div> 
                                <div class="ui-block post">
                                    <?php
                                    include './calculate-time.php';
                                    $result = getTime($ADVERTISEMENT->createdAt);
                                    ?>
                                    <div class="ad-main-title">
                                        <?php echo $ADVERTISEMENT->title; ?>
                                    </div>
                                    <div class="ad-sub-topic">
                                        Ad posted by <?php echo $MEM->firstName . ' ' . $MEM->lastName . ', ' . $result; ?> 
                                    </div>
                                    <?php
                                    if ($ADIMAGES) {
                                        ?>
                                        <div id="galleria">
                                            <?php
                                            foreach ($ADIMAGES as $img) {
                                                ?>
                                                <a href="upload/advertisement/<?php echo $img['image_name']; ?>">
                                                    <img 
                                                        src="upload/advertisement/thumb2/<?php echo $img['image_name']; ?>"
                                                        data-big="upload/advertisement/<?php echo $img['image_name']; ?>"
                                                        data-title="<?php echo $ADVERTISEMENT->title; ?>"
                                                        >
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div id="galleria" class="no-images" >

                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="ad-category-details row">
                                        <div class="col-md-7 category-details">
                                            <span  title="Category"><i class="fa fa-tag"></i> <?php echo $CATEGORY->name; ?></span> <span title="Sub Category"> <i class="fa fa-angle-double-right"></i> <?php echo $SUBCATEGORY->name; ?></span>
                                        </div>
                                        <div class="col-md-5 city-details" title="City">
                                            <i class="fa fa-map-marker"></i> <span id="city"></span>
                                        </div>
                                    </div>
                                    <div class="price-tag">
                                        <span  title="Price"> 
                                            <?php
                                            if ($ADVERTISEMENT->price == 0) {
                                                echo 'Price Negotiable';
                                            } else {
                                                echo 'Rs.' . number_format($ADVERTISEMENT->price) . '/=';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class="ad-description">
                                        <?php echo $ADVERTISEMENT->description; ?>
                                    </div>
                                    <div class="ad-comment">
                                        <?php
                                        $comments = AdvertisementComment::getCommentsByAdvertisementID($ADVERTISEMENT->id);
                                        if (count($comments) > 0) {
                                            ?>
                                            <ul class="comments-list" id="comment-list-<?php echo $ADVERTISEMENT->id; ?>" post-id="<?php echo $ADVERTISEMENT->id; ?>">
                                                <a href="#" class="see-more hidden" id="see-more-<?php echo $ADVERTISEMENT->id; ?>">Show all comments</a>
                                                <?php
                                                foreach ($comments as $key => $comment) {
                                                    $COMMENTMEMBER = New Member($comment['member']);
                                                    $commentedat = getTime($comment['commented_at']);
                                                    $replies = AdvertisementCommentReply::getRepliesByCommentID($comment['id']);
                                                    if (count($replies) < 0) {
                                                        ?>
                                                        <li class="comment-item comment-item1" id="li_<?php echo $comment['id']; ?>">
                                                            <div class="post__author author vcard inline-items">
                                                                <img src="upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" datetime="2017-03-24T18:18">
                                                                            <?php echo $commentedat; ?>
                                                                        </time>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if ($comment['member'] == $MEMBER->id) {
                                                                    ?>
                                                                    <div class="more">
                                                                        <svg class="olymp-three-dots-icon">
                                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                                        </svg>
                                                                        <ul class="more-dropdown">
                                                                            <li>
                                                                                <a class="edit-comment" id="<?php echo $comment['id']; ?>" type="<?php echo $ad['type']; ?>">Edit Comment</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="delete-comment" id="<?php echo $comment['id']; ?>">Delete Comment</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>

                                                            <p class="comment-p" id="comment-p-<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>

                                                        </li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="comment-item comment-item1 has-children" id="li_<?php echo $comment['id']; ?>">
                                                            <div class="post__author author vcard inline-items">
                                                                <img src="upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" datetime="2017-03-24T18:18">
                                                                            <?php echo $commentedat; ?>
                                                                        </time>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <p class="ad-comment-p" id="ad-comment-p-<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>

                                                            <ul class="children comment-reply-list" id="comment-reply-list-<?php echo $comment['id']; ?>" comment-id="<?php echo $comment['id']; ?>">
                                                                <a href="#" class="see-more-replies hidden" id="see-more-replies-<?php echo $comment['id']; ?>">View all replies</a>
                                                                <?php
                                                                foreach ($replies as $reply) {
                                                                    $REPLYMEMBER = New Member($reply['member']);
                                                                    $repliedat = getTime($reply['replied_at']);
                                                                    ?>
                                                                    <li class="comment-item comment-reply-item" id="li_r_<?php echo $reply['id']; ?>">
                                                                        <div class="post__author author vcard inline-items">
                                                                            <img src="upload/member/<?php echo $REPLYMEMBER->profilePicture; ?>" alt="author">

                                                                            <div class="author-date">
                                                                                <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $REPLYMEMBER->id; ?>"><?php echo $REPLYMEMBER->firstName . ' ' . $REPLYMEMBER->lastName; ?></a>
                                                                                <div class="post__date">
                                                                                    <time class="published" datetime="2017-03-24T18:18">
                                                                                        <?php echo $repliedat; ?>
                                                                                    </time>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <p class="reply-p" id="ad-reply-p-<?php echo $reply['id']; ?>"><?php echo $reply['reply']; ?></p>

                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </ul>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="ad-contact-details">
                                        <div class="col-xl-6 order-xl-1">
                                            <h5>Contact</h5>
                                            <ul>
                                                <li>
                                                    <img src="img/icon/phone.png"  alt=""/>
                                                    <span class="contact-details">
                                                        <?php
                                                        if (isset($ADVERTISEMENT->phoneNumber)) {
                                                            echo $ADVERTISEMENT->phoneNumber;
                                                        } elseif (isset($MEM->phoneNumber)) {
                                                            echo $MEM->phoneNumber;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <img src="img/icon/email.png" alt=""/>
                                                    <span class="contact-details">
                                                        <?php
                                                        if (isset($ADVERTISEMENT->email)) {
                                                            echo $ADVERTISEMENT->email;
                                                        } elseif (isset($MEM->email)) {
                                                            echo $MEM->email;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <img src="img/icon/location.png" alt=""/>
                                                    <span class="contact-details">
                                                        <?php
                                                        if (isset($ADVERTISEMENT->address)) {
                                                            echo $ADVERTISEMENT->address;
                                                        } elseif (isset($MEM->address)) {
                                                            echo $MEM->address;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <img src="img/icon/search.png" alt=""/>
                                                    <span class="contact-details">
                                                        <?php
                                                        if (isset($ADVERTISEMENT->website)) {
                                                            echo $ADVERTISEMENT->website;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block post more-ads-section">
                                    <header class="content-title">
                                        <div class="title-bg">
                                            <h2 class="title1">More Advertisements</h2>
                                        </div>
                                        <p class="title-desc">Find more relevant advertising.</p>
                                    </header>
                                    <div class="row">
                                        <div id="more-ads-slider" class="owl-carousel owl-theme">
                                            <?php
                                            $advertisements = Advertisement::getAdsByCategory($ADVERTISEMENT->category);
                                            $out = '';
                                            if (count($advertisements) > 0) {
                                                $i = 0;
                                                foreach ($advertisements as $key => $ad) {
                                                    $result = getTime($ad['created_at']);
                                                    $MEMBER = new Member($ad['member']);
                                                    $CATEGORY = new BusinessCategory($ad['category']);
                                                    $adimages = AdvertisementImage::getPhotosByAdId($ad['id']);

                                                    if (($i % 2) === 0) {
                                                        ?>
                                                        <div class="item">
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="col-md-12 aaa">
                                                            <div class="ad-item  post ">
                                                                <div class="ad-item-box row">
                                                                    <div class = "col-xl-4 col-sm-4 col-xs-4 ad-item-image">
                                                                        <?php
                                                                        if (count($adimages) > 0) {
                                                                            foreach ($adimages as $key => $img) {
                                                                                if ($key == 0) {
                                                                                    ?>
                                                                                    <img src="upload/advertisement/thumb2/<?php echo $img['image_name']; ?>" alt=""/>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <img src="upload/advertisement/thumb2/advertising.jpg" alt=""/>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class = "col-xl-8 col-sm-8 col-xs-8 more-ad ad-item-details">
                                                                        <div class="ad-title">
                                                                            <a href="view-advertisement.php?id=<?php echo $ad['id']; ?>" title="<?php echo $ad['title']; ?>">
                                                                                <?php
                                                                                if (strlen($ad['title']) > 25) {
                                                                                    echo strlen($ad['title'], 0, 22) . '...';
                                                                                } else {
                                                                                    echo $ad['title'];
                                                                                }
                                                                                ?>
                                                                            </a>
                                                                        </div>
                                                                        <div class="ad-category"><span class="title"><i class="fa fa-tag"></i> </span><?php echo $CATEGORY->name; ?></div>
                                                                        <div class=""><i class="fa fa-clock"></i> <?php echo $result; ?></div>
                                                                        <div class=""><i class="fa fa-dollar-sign"></i> <?php if($ad['price'] == 0) { echo 'Price Negotiable'; } else { echo 'Rs. ' . number_format($ad['price']);} ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if (($i + 1) % 2 === 0 || ($i + 1) === count($advertisements)) {
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ... end Main Content -->
                        <!-- Left Sidebar -->
                        <div class="col col-xl-2 order-xl-1 col-lg-2 order-lg-1 col-md-12 col-sm-12 col-12">

                        </div>
                        <!-- ... end Left Sidebar -->
                        <!-- Right Sidebar -->
                        <div class="col col-xl-2 order-xl-3 col-lg-2 order-lg-3 col-md-12 col-sm-12 col-12">

                        </div>
                        <!-- ... end Left Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="autocomplete" placeholder="Location" value="<?php echo $ADVERTISEMENT->city; ?>">
        <div id="map"></div>
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
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/all-ad-slider.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="plugins/galleria/galleria-1.5.7.min.js" type="text/javascript"></script>
        <script src="plugins/OwlCarousel/dist/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script>
            $(function () {
                // Load the classic theme
                Galleria.loadTheme('plugins/galleria/themes/classic/galleria.classic.min.js');

                // Initialize Galleria
                Galleria.run('#galleria');
            });
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
                    var place_id = $('#autocomplete').val();

                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {

                            $('#city').text(place.name);
                            $('#breadcrumbs-city').text(place.name);
                        }
                    });

                }, 1000);
            }

            $(document).ready(function () {
                initMap();
            });


        </script>
        <script>
            $(function () {
                $(".comments-list").each(function (index) {

                    if ($(this).children(".comment-item").length > 3) {
                        var post = $(this).attr('post-id');
                        $("#see-more-" + post).removeClass('hidden');
                    }
                    $(this).children(".comment-item").slice(-3).show();
                });

                $(".see-more").click(function (e) {
                    e.preventDefault();
                    var $link = $(this);
                    var $div = $link.closest('.comments-list');

                    if ($link.hasClass('visible')) {
                        $link.text('Show all comments');
                        $div.children(".comment-item").slice(0, -3).slideUp()
                    } else {
                        $link.text('Show less comments');
                        $div.children(".comment-item").slideDown();
                    }

                    $link.toggleClass('visible');
                });
            });
            $(function () {
                $(".comment-reply-list").each(function (index) {

                    if ($(this).children(".comment-reply-item").length > 1) {

                        var comment = $(this).attr('comment-id');
                        $("#see-more-replies-" + comment).removeClass('hidden');
                    }
                    $(this).children(".comment-reply-item").slice(-1).show();
                });

                $(".see-more-replies").click(function (e) {
                    e.preventDefault();
                    var $link = $(this);
                    var $div = $link.closest('.comment-reply-list');

                    if ($link.hasClass('visible')) {
                        $link.text('Show all replies');
                        $div.children(".comment-reply-item").slice(0, -1).slideUp()
                    } else {
                        $link.text('Show less replies');
                        $div.children(".comment-reply-item").slideDown();
                    }

                    $link.toggleClass('visible');
                });
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initMap"
        async defer></script>
    </body>
</html>