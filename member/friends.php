<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEM = '';
$MEMBER = new Member($_SESSION['id']);
if (isset($_GET['id'])) {
    $MEM = new Member($_GET['id']);
} else {
    $MEM = new Member($_SESSION['id']);
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About || Profile || Flip.lk</title>

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

        <div class="header-spacer"></div>
        <!-- Top Header-Profile -->
        <?php
        include './profile-header.php';
        ?>
        <!-- ... end Top Header-Profile -->
        <div class="container">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="ui-block responsive-flex">
                        <div class="ui-block-title">
                            <div class="h6 title">James’s Friends (86)</div>
                            <form class="w-search">
                                <div class="form-group with-button">
                                    <input class="form-control" type="text" placeholder="Search Friends...">
                                    <button>
                                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                    </button>
                                </div>
                            </form>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Friends -->

        <div class="container">
            <div class="row">
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend1.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar1.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Nicholas Grissom</a>
                                        <div class="country">San Francisco, CA</div>
                                    </div>
                                </div>

                                <div class="swiper-container" data-slide="fade">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">52</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">240</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">16</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend2.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar2.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Marina Valentine</a>
                                        <div class="country">Long Island, NY</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">52</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">240</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">16</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend3.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar3.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Nicholas Grissom</a>
                                        <div class="country">Los Angeles, CA</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">49</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">132</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">5</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend4.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">
                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar4.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Chris Greyson</a>
                                        <div class="country">Austin, TX</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">65</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">104</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">12</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>

                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend5.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar5.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Elaine Dreifuss</a>
                                        <div class="country">New York, NY</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">82</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">204</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">27</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend6.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar6.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Bruce Peterson</a>
                                        <div class="country">Austin, TX</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">73</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">360</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">11</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend7.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar7.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Carol Summers</a>
                                        <div class="country">Los Angeles, CA</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">49</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">132</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">5</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block">

                        <!-- Friend Item -->

                        <div class="friend-item">
                            <div class="friend-header-thumb">
                                <img src="img/friend8.jpg" alt="friend">
                            </div>

                            <div class="friend-item-content">
                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Report Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Block Profile</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="friend-avatar">
                                    <div class="author-thumb">
                                        <img src="img/avatar8.jpg" alt="author">
                                    </div>
                                    <div class="author-content">
                                        <a href="#" class="h5 author-name">Michael Maximoff</a>
                                        <div class="country">Portland, OR</div>
                                    </div>
                                </div>

                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="friend-count" data-swiper-parallax="-500">
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">58</div>
                                                    <div class="title">Friends</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">304</div>
                                                    <div class="title">Photos</div>
                                                </a>
                                                <a href="#" class="friend-count-item">
                                                    <div class="h6">19</div>
                                                    <div class="title">Videos</div>
                                                </a>
                                            </div>
                                            <div class="control-block-button" data-swiper-parallax="-100">
                                                <a href="#" class="btn btn-control bg-blue">
                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                </a>

                                                <a href="#" class="btn btn-control bg-purple">
                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                </a>

                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <p class="friend-about" data-swiper-parallax="-500">
                                                Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
                                            </p>

                                            <div class="friend-since" data-swiper-parallax="-100">
                                                <span>Friends Since:</span>
                                                <div class="h6">December 2014</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>

                        <!-- ... end Friend Item -->			</div>
                </div>
            </div>
        </div>

        <!-- ... end Friends -->

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
