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
        include './header.php';
        ?>
        
        <div class="header-spacer"></div>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
        <!-- Top Header-Profile -->
        <?php
        include './profile-header.php';
        ?>
        <!-- ... end Top Header-Profile -->
        <div class="container">
            <div class="row">
                <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Hobbies and Interests</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">Hobbies:</span>
                                            <span class="text">I like to ride the bike to work, swimming, and working out. I also like
                                                reading design magazines, go to museums, and binge watching a good tv show while it’s raining outside.
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Favourite TV Shows:</span>
                                            <span class="text">Breaking Good, RedDevil, People of Interest, The Running Dead, Found,  American Guy.</span>
                                        </li>
                                        <li>
                                            <span class="title">Favourite Movies:</span>
                                            <span class="text">Idiocratic, The Scarred Wizard and the Fire Crown,  Crime Squad, Ferrum Man. </span>
                                        </li>
                                        <li>
                                            <span class="title">Favourite Games:</span>
                                            <span class="text">The First of Us, Assassin’s Squad, Dark Assylum, NMAK16, Last Cause 4, Grand Snatch Auto. </span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">Favourite Music Bands / Artists:</span>
                                            <span class="text">Iron Maid, DC/AC, Megablow, The Ill, Kung Fighters, System of a Revenge.</span>
                                        </li>
                                        <li>
                                            <span class="title">Favourite Books:</span>
                                            <span class="text">The Crime of the Century, Egiptian Mythology 101, The Scarred Wizard, Lord of the Wings, Amongst Gods, The Oracle, A Tale of Air and Water.</span>
                                        </li>
                                        <li>
                                            <span class="title">Favourite Writers:</span>
                                            <span class="text">Martin T. Georgeston, Jhonathan R. Token, Ivana Rowle, Alexandria Platt, Marcus Roth. </span>
                                        </li>
                                        <li>
                                            <span class="title">Other Interests:</span>
                                            <span class="text">Swimming, Surfing, Scuba Diving, Anime, Photography, Tattoos, Street Art.</span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Education and Employement</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">The New College of Design</span>
                                            <span class="date">2001 - 2006</span>
                                            <span class="text">Breaking Good, RedDevil, People of Interest, The Running Dead, Found,  American Guy.</span>
                                        </li>
                                        <li>
                                            <span class="title">Rembrandt Institute</span>
                                            <span class="date">2008</span>
                                            <span class="text">Five months Digital Illustration course. Professor: Leonardo Stagg.</span>
                                        </li>
                                        <li>
                                            <span class="title">The Digital College </span>
                                            <span class="date">2010</span>
                                            <span class="text">6 months intensive Motion Graphics course. After Effects and Premire. Professor: Donatello Urtle. </span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->

                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info item-block">
                                        <li>
                                            <span class="title">Digital Design Intern</span>
                                            <span class="date">2006-2008</span>
                                            <span class="text">Digital Design Intern for the “Multimedz” agency. Was in charge of the communication with the clients.</span>
                                        </li>
                                        <li>
                                            <span class="title">UI/UX Designer</span>
                                            <span class="date">2008-2013</span>
                                            <span class="text">UI/UX Designer for the “Daydreams” agency. </span>
                                        </li>
                                        <li>
                                            <span class="title">Senior UI/UX Designer</span>
                                            <span class="date">2013-Now</span>
                                            <span class="text">Senior UI/UX Designer for the “Daydreams” agency. I’m in charge of a ten person group, overseeing all the proyects and talking to potential clients.</span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 order-md-2 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Personal Info</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                        <div class="ui-block-content">


                            <!-- W-Personal-Info -->

                            <ul class="widget w-personal-info">
                                <li>
                                    <span class="title">About Me:</span>
                                    <span class="text"><?php echo $MEM->aboutMe; ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="title">Birthday:</span>
                                    <span class="text"><?php echo date_format(date_create($MEM->dob),"F dS, Y"); ?></span>
                                </li>
                                <li>
                                    <span class="title">Lives in:</span>
                                    <span class="text"><?php echo $MEM->address; ?></span>
                                </li>
                                <li>
                                    <span class="title">Occupation:</span>
                                    <span class="text"><?php echo $MEM->occupation; ?></span>
                                </li>
                                <li>
                                    <span class="title">Joined:</span>
                                    <span class="text"><?php echo date_format(date_create(substr($MEM->createdAt, 0, 10)),"F dS, Y"); ?></span>
                                </li>
                                <li>
                                    <span class="title">Gender:</span>
                                    <span class="text"><?php echo ucfirst($MEM->gender); ?></span>
                                </li>
                                <li>
                                    <span class="title">Status:</span>
                                    <span class="text"><?php if($MEM->civilStatus == 'not_married' ) { echo 'Not Married'; } else { echo 'Married'; }; ?></span>
                                </li>
                                <li>
                                    <span class="title">Email:</span>
                                    <a href="#" class="text"><?php echo $MEM->email; ?></a>
                                </li>
                                <li>
                                    <span class="title">Phone Number:</span>
                                    <span class="text"><?php echo $MEM->phoneNumber; ?></span>
                                </li>
                            </ul>

                            <!-- ... end W-Personal-Info -->
                            <!-- W-Socials -->

                            <div class="widget w-socials">
                                <h6 class="title">Other Social Networks:</h6>
                                <a href="#" class="social-item bg-facebook">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    Facebook
                                </a>
                                <a href="#" class="social-item bg-twitter">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                    Twitter
                                </a>
                                <a href="#" class="social-item bg-dribbble">
                                    <i class="fab fa-dribbble" aria-hidden="true"></i>
                                    Dribbble
                                </a>
                            </div>


                            <!-- ... end W-Socials -->
                        </div>
                    </div>
                </div>
            </div>
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
    </body>
</html>
