<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Groups || Flip.lk</title>

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
        include './sidebar-left.php';
        ?>
        <?php
        include './header.php';
        ?>

        <div class="header-spacer header-spacer-small"></div>
        <!-- Main Header Groups -->
        <div class="main-header">
            <div class="content-bg-wrap bg-group"></div>
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
                        <div class="main-header-content">
                            <h1>Manage your Friend Groups</h1>
                            <p>Welcome to your friends groups! Do you wanna know what your close friends have been up to? Groups
                                will let you easily manage your friends and put the into categories so when you enter you’ll only
                                see a newsfeed of those friends that you placed inside the group. Just click on the plus button below and start now!</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="img-bottom" src="img/group-bottom.png" alt="friends">
        </div>
        <!-- ... end Main Header Groups -->
        <!-- Main Content Groups -->
        <div class="container">
            
            <div class="ui-block">
                <div class="ui-block-title">
                    <h6 class="title">Groups You Manage</h6>
                </div>
                <div class="ui-block-content">
                    <div class="row">

                        <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                            <!-- Friend Item -->
                            <div class="friend-item friend-groups create-group" data-mh="friend-groups-item">
                                <a href="create-group.php" class="full-block"></a>
                                <div class="content">
                                    <a href="create-group.php" class="  btn btn-control bg-blue">
                                        <svg class="olymp-plus-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-plus-icon"></use></svg>
                                    </a>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Create Group</a>
                                        <!--<div class="country">6 Friends in the Group</div>-->
                                    </div>
                                </div>
                            </div>
                            <!-- ... end Friend Item -->		
                        </div>
                        <?php
                        foreach (Group::getGroupsOfAdmin($MEMBER->id) as $key => $group) {
                            ?>
                            <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="ui-block" data-mh="friend-groups-item">
                                    <!-- Friend Item -->
                                    <div class="friend-item friend-groups">
                                        <div class="friend-item-content">
                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a href="edit-group.php?id=<?php echo $group['id']; ?>">Edit Group</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Leave Group</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Edit Notification Settings</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="friend-avatar">
                                                <div class="author-thumb">
                                                    <img src="../upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                </div>
                                                <div class="author-content">
                                                    <a href="group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                    <div class="country">6 Friends in the Group</div>
                                                </div>
                                            </div>

                                            <ul class="friends-harmonic">
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic5.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic10.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic7.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic8.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic2.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/avatar30-sm.jpg" alt="author">
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="control-block-button">
                                                <a href="#" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">
                                                    <svg class="olymp-happy-faces-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-faces-icon"></use></svg>
                                                </a>
                                                <a href="#" class="btn btn-control btn-grey-lighter">
                                                    <svg class="olymp-settings-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ... end Friend Item -->			
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="ui-block">
                <div class="ui-block-title">
                    <h6 class="title">Your Groups</h6>
                </div>
                <div class="ui-block-content">
                    <div class="row">
                        <?php
                        if(count(Group::getGroupsByMember($MEMBER->id)) > 0) {
                        foreach (Group::getGroupsByMember($MEMBER->id) as $key => $group) {
                            ?>
                            <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="ui-block" data-mh="friend-groups-item">
                                    <!-- Friend Item -->
                                    <div class="friend-item friend-groups">
                                        <div class="friend-item-content">
                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a href="#">Leave Group</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Edit Notification Settings</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="friend-avatar">
                                                <div class="author-thumb">
                                                    <img src="../upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                </div>
                                                <div class="author-content">
                                                    <a href="group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                    <div class="country">6 Friends in the Group</div>
                                                </div>
                                            </div>

                                            <ul class="friends-harmonic">
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic5.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic10.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic7.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic8.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic2.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/avatar30-sm.jpg" alt="author">
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="control-block-button">
                                                <a href="#" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">
                                                    <svg class="olymp-happy-faces-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-faces-icon"></use></svg>
                                                </a>
                                                <a href="#" class="btn btn-control btn-grey-lighter">
                                                    <svg class="olymp-settings-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ... end Friend Item -->			
                                </div>
                            </div>
                            <?php
                        }
                        } else {
                            echo 'You are not joined any groups.';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- ... end Main Content Groups -->

        <!-- Window-popup Create Friends Group -->
        <div class="modal fade" id="create-friend-group-1" tabindex="-1" role="dialog" aria-labelledby="create-friend-group-1" aria-hidden="true">
            <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>
                    <div class="modal-header">
                        <h6 class="title">Create Friend Group</h6>
                    </div>

                    <div class="modal-body">
                        <form class="form-group label-floating">
                            <label class="control-label">Group Name</label>
                            <input class="form-control" placeholder="" value="Highschool Friends" type="text">
                        </form>

                        <form class="form-group with-button">
                            <input class="form-control" placeholder="" value="Group Avatar (120x120px min)" type="text">

                            <button class="bg-grey">
                                <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                            </button>

                        </form>

                        <form class="form-group label-floating is-select">
                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>

                            <select class="selectpicker form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
                                <option title="Green Goo Rock" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar52-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Green Goo Rock</div>

                                        </div>'>Green Goo Rock
                                </option>

                                <option title="Mathilda Brinker" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar74-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Mathilda Brinker</div>
                                        </div>'>Mathilda Brinker
                                </option>

                                <option title="Marina Valentine" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar48-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Marina Valentine</div>
                                        </div>'>Marina Valentine
                                </option>

                                <option title="Dave Marinara" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar75-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Dave Marinara</div>
                                        </div>'>Dave Marinara
                                </option>

                                <option title="Rachel Howlett" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar76-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Rachel Howlett</div>
                                        </div>'>Rachel Howlett
                                </option>

                            </select>
                        </form>

                        <a href="#" class="btn btn-blue btn-lg full-width">Create Group</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ... end Window-popup Create Friends Group -->

        <!-- Window-popup Create Friends Group Add Friends -->

        <div class="modal fade" id="create-friend-group-add-friends" tabindex="-1" role="dialog" aria-labelledby="create-friend-group-add-friends" aria-hidden="true">
            <div class="modal-dialog window-popup create-friend-group create-friend-group-add-friends" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 class="title">Add Friends to “Freelance Clients” Group</h6>
                    </div>

                    <div class="modal-body">
                        <form class="form-group label-floating is-select">

                            <select class="selectpicker form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true">
                                <option title="Green Goo Rock" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar52-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Green Goo Rock</div>

                                        </div>'>Green Goo Rock
                                </option>

                                <option title="Mathilda Brinker" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar74-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Mathilda Brinker</div>
                                        </div>'>Mathilda Brinker
                                </option>

                                <option title="Marina Valentine" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar48-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Marina Valentine</div>
                                        </div>'>Marina Valentine
                                </option>

                                <option title="Dave Marinara" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar75-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Dave Marinara</div>
                                        </div>'>Dave Marinara
                                </option>

                                <option title="Rachel Howlett" data-content='<div class="inline-items">
                                        <div class="author-thumb">
                                        <img src="img/avatar76-sm.jpg" alt="author">
                                        </div>
                                        <div class="h6 author-title">Rachel Howlett</div>
                                        </div>'>Rachel Howlett
                                </option>

                            </select>
                        </form>

                        <a href="#" class="btn btn-blue btn-lg full-width">Save Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ... end Window-popup Create Friends Group Add Friends -->
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

    </body>
</html>