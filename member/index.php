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
    </head>
    <body>
        <?php
        include './sidebar-left.php';
        ?>
        <?php
        include './header.php';
        ?>


        <div class="header-spacer"></div>
        <div class="container">
            <div class="row">
                <!-- Main Content -->

                <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                    <div class="ui-block">
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
                                            <textarea class="form-control" placeholder="" name="description"></textarea>
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
                                            <input type="submit" name="save-post" class="btn btn-primary btn-md-2 share-post" value="Share" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ... end News Feed Form  -->
                    </div>

                    <div id="newsfeed-items-grid">

                        <?php
                        include './calculate-time.php';
                        $ads = Advertisement::getAdsInAnyGroupsByMember($MEMBER->id);
                        if (count($ads) > 0) {
                            foreach ($ads as $key => $ad) {
                                $MEM = new Member($ad['member']);
                                $GROUP = new Group($ad['group_id']);
                                $result = getTime($ad['created_at']);
                                ?>

                                <div class="ui-block">
                                    <!-- Post -->

                                    <article class="hentry post has-post-thumbnail shared-photo ad_<?php echo $ad['id']; ?>" id="ad-id" id-id="<?php echo $id['id']; ?>">

                                        <div class="post__author author vcard inline-items">
                                            <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">

                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $MEM->firstName; ?>"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> <i class="fa fa-caret-right"></i> <a class="h6 post__author-name fn" href="group.php?id=<?php echo $GROUP->id; ?>"><?php echo $GROUP->name; ?></a> 
                                                <div class="post__date">
                                                    <time class="published">
                                                        <?php echo $result; ?>
                                                    </time>
                                                </div>
                                            </div>

                                            <div class="more">
                                                <svg class="olymp-three-dots-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                </svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a href="#">Turn Off Notifications</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Select as Featured</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <h5><b><?php echo $ad['title']; ?></b></h5>
                                        <?php echo $ad['description']; ?>

                                        <div class="post-thumb">
                                            <div id="gallery-<?php echo $ad['id']; ?>"></div>
                                        </div>
                                        <div class=" content">

                                        </div>



                                        <div class="post-additional-info inline-items">

                                            <a href="#" class="post-add-icon inline-items">
                                                <svg class="olymp-heart-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                                </svg>
                                                <span>15</span>
                                            </a>

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
                                            </ul>

                                            <div class="names-people-likes">
                                                <a href="#">Diana</a>, <a href="#">Nicholas</a> and
                                                <br>13 more liked this
                                            </div>

                                            <div class="comments-shared">
                                                <a href="#" class="post-add-icon inline-items">
                                                    <svg class="olymp-speech-balloon-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                    </svg>
                                                    <span>0</span>
                                                </a>

                                                <a href="#" class="post-add-icon inline-items">
                                                    <svg class="olymp-share-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                    </svg>
                                                    <span>16</span>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="control-block-button post-control-button">

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-like-post-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                                </svg>
                                            </a>

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-comments-post-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                                </svg>
                                            </a>

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-share-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                </svg>
                                            </a>

                                        </div>


                                    </article>

                                    <!-- .. end Post -->				</div>
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

                    <a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                </main>

                <!-- ... end Main Content -->


                <!-- Left Sidebar -->

                <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                    <div class="ui-block">

                        <!-- W-Weather -->

                        <div class="widget w-wethear">
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                            <div class="wethear-now inline-items">
                                <div class="temperature-sensor">64°</div>
                                <div class="max-min-temperature">
                                    <span>58°</span>
                                    <span>76°</span>
                                </div>

                                <svg class="olymp-weather-partly-sunny-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-partly-sunny-icon"></use></svg>
                            </div>

                            <div class="wethear-now-description">
                                <div class="climate">Partly Sunny</div>
                                <span>Real Feel: <span>67°</span></span>
                                <span>Chance of Rain: <span>49%</span></span>
                            </div>

                            <ul class="weekly-forecast">

                                <li>
                                    <div class="day">sun</div>
                                    <svg class="olymp-weather-sunny-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-sunny-icon"></use></svg>

                                    <div class="temperature-sensor-day">60°</div>
                                </li>

                                <li>
                                    <div class="day">mon</div>
                                    <svg class="olymp-weather-partly-sunny-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-partly-sunny-icon"></use></svg>
                                    <div class="temperature-sensor-day">58°</div>
                                </li>

                                <li>
                                    <div class="day">tue</div>
                                    <svg class="olymp-weather-cloudy-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-cloudy-icon"></use></svg>

                                    <div class="temperature-sensor-day">67°</div>
                                </li>

                                <li>
                                    <div class="day">wed</div>
                                    <svg class="olymp-weather-rain-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-rain-icon"></use></svg>

                                    <div class="temperature-sensor-day">70°</div>
                                </li>

                                <li>
                                    <div class="day">thu</div>
                                    <svg class="olymp-weather-storm-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-storm-icon"></use></svg>

                                    <div class="temperature-sensor-day">58°</div>
                                </li>

                                <li>
                                    <div class="day">fri</div>
                                    <svg class="olymp-weather-snow-icon"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-snow-icon"></use></svg>

                                    <div class="temperature-sensor-day">68°</div>
                                </li>

                                <li>
                                    <div class="day">sat</div>

                                    <svg class="olymp-weather-wind-icon-header"><use xlink:href="svg-icons/sprites/icons-weather.svg#olymp-weather-wind-icon-header"></use></svg>

                                    <div class="temperature-sensor-day">65°</div>
                                </li>

                            </ul>

                            <div class="date-and-place">
                                <h5 class="date">Saturday, March 26th</h5>
                                <div class="place">San Francisco, CA</div>
                            </div>

                        </div>

                        <!-- W-Weather -->			</div>

                    <div class="ui-block">

                        <!-- W-Calendar -->

                        <div class="w-calendar calendar-container">
                            <div class="calendar">
                                <header>
                                    <h6 class="month">March 2017</h6>
                                    <a class="calendar-btn-prev fas fa-angle-left" href="#"></a>
                                    <a class="calendar-btn-next fas fa-angle-right" href="#"></a>
                                </header>
                                <table>
                                    <thead>
                                        <tr><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td><td>San</td></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-month="12" data-day="1">1</td>
                                            <td data-month="12" data-day="2" class="event-uncomplited event-complited">
                                                2
                                            </td>
                                            <td data-month="12" data-day="3">3</td>
                                            <td data-month="12" data-day="4">4</td>
                                            <td data-month="12" data-day="5">5</td>
                                            <td data-month="12" data-day="6">6</td>
                                            <td data-month="12" data-day="7">7</td>
                                        </tr>
                                        <tr>
                                            <td data-month="12" data-day="8">8</td>
                                            <td data-month="12" data-day="9">9</td>
                                            <td data-month="12" data-day="10" class="event-complited">10</td>
                                            <td data-month="12" data-day="11">11</td>
                                            <td data-month="12" data-day="12">12</td>
                                            <td data-month="12" data-day="13">13</td>
                                            <td data-month="12" data-day="14">14</td>
                                        </tr>
                                        <tr>
                                            <td data-month="12" data-day="15" class="event-complited-2">15</td>
                                            <td data-month="12" data-day="16">16</td>
                                            <td data-month="12" data-day="17">17</td>
                                            <td data-month="12" data-day="18">18</td>
                                            <td data-month="12" data-day="19">19</td>
                                            <td data-month="12" data-day="20">20</td>
                                            <td data-month="12" data-day="21">21</td>
                                        </tr>
                                        <tr>
                                            <td data-month="12" data-day="22">22</td>
                                            <td data-month="12" data-day="23">23</td>
                                            <td data-month="12" data-day="24">24</td>
                                            <td data-month="12" data-day="25">25</td>
                                            <td data-month="12" data-day="26">26</td>
                                            <td data-month="12" data-day="27">27</td>
                                            <td data-month="12" data-day="28" class="event-uncomplited">28</td>
                                        </tr>
                                        <tr>
                                            <td data-month="12" data-day="29">29</td>
                                            <td data-month="12" data-day="30">30</td>
                                            <td data-month="12" data-day="31">31</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="list">

                                    <div id="accordion-1" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="2">
                                        <div class="ui-block-title ui-block-title-small">
                                            <h6 class="title">TODAY’S EVENTS</h6>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne-1">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">9:00am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-1" aria-expanded="true" aria-controls="collapseOne-1">
                                                        Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne-1" class="collapse" role="tabpanel" >
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>
                                                <div class="place inline-items">
                                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                    <span>Daydreamz Agency</span>
                                                </div>

                                                <ul class="friends-harmonic inline-items">
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
                                                    <li class="with-text">
                                                        Will Assist
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingTwo-1">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">9:00am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-1" aria-expanded="true" aria-controls="collapseTwo-1">
                                                        Send the new “Olympus” project files to the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseTwo-1" class="collapse" role="tabpanel">
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>
                                            </div>

                                        </div>

                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingThree-1">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">6:30am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false">
                                                        Take Querty to the Veterinarian
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="place inline-items">
                                                <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                <span>Daydreamz Agency</span>
                                            </div>
                                        </div>

                                        <a href="#" class="check-all">Check all your Events</a>
                                    </div>

                                    <div id="accordion-2" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="10">
                                        <div class="ui-block-title ui-block-title-small">
                                            <h6 class="title">TODAY’S EVENTS</h6>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne-2">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">9:00am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-2" aria-expanded="true" aria-controls="collapseOne-2">
                                                        Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne-2" class="collapse" role="tabpanel">
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>
                                                <div class="place inline-items">
                                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                    <span>Daydreamz Agency</span>
                                                </div>

                                                <ul class="friends-harmonic inline-items">
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
                                                    <li class="with-text">
                                                        Will Assist
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <a href="#" class="check-all">Check all your Events</a>
                                    </div>

                                    <div id="accordion-3" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="15">
                                        <div class="ui-block-title ui-block-title-small">
                                            <h6 class="title">TODAY’S EVENTS</h6>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne-3">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">9:00am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-3" aria-expanded="true" aria-controls="collapseOne-3">
                                                        Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne-3" class="collapse" role="tabpanel">
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>

                                                <div class="place inline-items">
                                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                    <span>Daydreamz Agency</span>
                                                </div>

                                                <ul class="friends-harmonic inline-items">
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
                                                    <li class="with-text">
                                                        Will Assist
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingTwo-3">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">12:00pm</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-3" aria-expanded="true" aria-controls="collapseTwo-3">
                                                        Send the new “Olympus” project files to the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseTwo-3" class="collapse" role="tabpanel" >
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>
                                            </div>

                                        </div>

                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingThree-3">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">6:30pm</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false">
                                                        Take Querty to the Veterinarian
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="place inline-items">
                                                <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                <span>Daydreamz Agency</span>
                                            </div>
                                        </div>

                                        <a href="#" class="check-all">Check all your Events</a>
                                    </div>

                                    <div id="accordion-4" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="28">
                                        <div class="ui-block-title ui-block-title-small">
                                            <h6 class="title">TODAY’S EVENTS</h6>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne-4">
                                                <div class="event-time">
                                                    <span class="circle"></span>
                                                    <time datetime="2004-07-24T18:18">9:00am</time>
                                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                                                </div>
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-4" aria-expanded="true" aria-controls="collapseOne-4">
                                                        Breakfast at the Agency<svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne-4" class="collapse" role="tabpanel" aria-labelledby="headingOne-4">
                                                <div class="card-body">
                                                    Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the new design project we have been working on. Cheers!
                                                </div>
                                                <div class="place inline-items">
                                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                                    <span>Daydreamz Agency</span>
                                                </div>

                                                <ul class="friends-harmonic inline-items">
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
                                                    <li class="with-text">
                                                        Will Assist
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <a href="#" class="check-all">Check all your Events</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- ... end W-Calendar -->
                    </div>
                </aside>

                <!-- ... end Left Sidebar -->


                <!-- Right Sidebar -->

                <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">

                    <div class="ui-block">


                        <!-- W-Action -->

                        <div class="widget w-action">

                            <img src="img/logo.png" alt="Olympus">
                            <div class="content">
                                <h4 class="title">OLYMPUS</h4>
                                <span>THE BEST SOCIAL NETWORK THEME IS HERE!</span>
                                <a href="01-LandingPage.html" class="btn btn-bg-secondary btn-md">Register Now!</a>
                            </div>
                        </div>

                        <!-- ... end W-Action -->
                    </div>

                </aside>

                <!-- ... end Right Sidebar -->

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
    </body>
</html>