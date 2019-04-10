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
            <div class="row">
                <!-- Main Content -->

                <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                    <div class="ui-block first-block">
                        <!-- News Feed Form  -->
                        <div class="news-feed-form">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

                                        <svg class="olymp-status-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-status-icon"></use></svg>

                                        <span>Status</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                    <form action="post-and-get/post.php" method="post" id="post-form">
                                        <div class="author-thumb">
                                            <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                        </div>
                                        <div class="form-group with-icon label-floating is-empty">
                                            <label class="control-label">Share what you are thinking here...</label>
                                            <textarea class="form-control post-description" placeholder="" name="description"></textarea>
                                            <div class="flipScrollableArea hidden" id="image-list" style="/*! height: 112px; */ /*! width: 100%; */">
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
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </span>
                                                            <span class="_uploadloaderbox abc">
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
                                        </div>

                                        <div class="add-options-message">

                                            <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                <div class="_upload">
                                                    <input  name="post-image" display="inline" role="button" tabindex="0" data-testid="media-tab" type="file" class="_uploadinput _outlinenone" id="upload_first_image">
                                                    <input type="hidden" id="upload-post-image" name="upload-post-image" >
                                                </div>

                                            </a>
                                            <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                            </a>

                                            <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                            </a>
                                            <input type="hidden" value ="<?php echo $_SESSION['id']; ?>" id="member" name="member" />
                                            <input type="submit" name="save-post" class="btn btn-primary btn-md-2 share-post" disabled="" value="Post" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ... end News Feed Form  -->
                    </div>

                    <div id="newsfeed-items-grid">
                        <div id="output"><?php include('post-and-get/ajax/get-ads-and-posts.php'); ?></div>
                        <div class="loader"><img src="img/loader/loading.gif" /></div>
                    </div>
                </main>
                <!-- ... end Main Content -->
                <!-- Left Sidebar -->
                <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12 hidden-sm hidden-xs">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Welcome, <?php echo $MEMBER->firstName; ?>!</h6>
                        </div>
                        <div class="ui-block-content">
                            <!-- W-Personal-Info -->
                            <ul class="widget w-personal-info item-block index-group-list">
                                <li>
                                    <span class="title">Shortcuts</span>
                                    <?php
                                    $groups = Group::getAllGroupsByMember($MEMBER->id);
                                    if (count($groups) > 0) {
                                        foreach ($groups as $group) {
                                            ?>
                                            <span class="text group-icon"><img src="img/icon/group.png" /><a href="group.php?id=<?php echo $group['id']; ?>" ><?php echo $group['name']; ?></a></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </li>
                            </ul>
                            <!-- .. end W-Personal-Info -->
                        </div>
                    </div>
                </aside>

                <!-- ... end Left Sidebar -->
                <!-- right Sidebar -->

                <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">

                </aside>

                <!-- ... end right Sidebar -->
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
        <script src="js/js/read-more-and-less.js" type="text/javascript"></script>
        <script src="js/js/scroll-loader.js" type="text/javascript"></script>
        <script type="text/javascript">

            
        </script>
    </body>
</html>