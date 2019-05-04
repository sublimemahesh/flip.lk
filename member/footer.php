<?php
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$ABOUT = new Page(1);
$CONTACTUS = New Page(7);
$PHONE_NUMBER1 = New Page(8);
$PHONE_NUMBER2 = New Page(9);
$EMAIL = New Page(10);
$LOCATION = New Page(11);
?> 

<footer>
    <section class="footer-top-wrap">
        <div class="container footer-container">
            <div class="row">
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-logo">
                            <a href="./"><img src="img/logo/logo.jpg" class="img-fluid" alt="footer-logo"></a>
                        </div>
                        <div class="footer-about">
                            <p><?php echo substr($ABOUT->description,0,250); ?></p>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a><i class="fab fa-facebook-f"></i></a></li>
                                <li><a><i class="fab fa-twitter"></i></a></li>
                                <li><a><i class="fab fa-tripadvisor"></i></a></li>
                                <li><a><i class="fab fa-google-plus"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>QUICK LINKS</h3>
                        </div>
                        <div class="widget_nav_menu">
                            <ul>
                                <li><i class="fa fa-angle-double-right "></i><a href="../">Home</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../all-advertisement.php">Advertisement</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../groups.php">Groups</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="./">Newsfeed</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../terms-and-conditions.php">Terms & Conditions</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="./about-us.php">About Us</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../contact-us.php">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>ADS BY CITIES</h3>
                        </div>
                        <div class="widget_nav_menu">
                            <ul>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJA3B6D9FT4joRjYPTMk0uCzI">Colombo</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJ4_wyabtz4ToRA0zG-QO5NUo">Galle</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJ06yYZCZm4zoRNTzgoRg4GkE">Kandy</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJpWrme_1T_joREvW6A5IN2sc">Jaffna</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJWeFgk_n0_DoRDs9tvJ7-EcE">Anuradhapura</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJx1QVTkOA4zoRnH2TTEAIFik">Nuwara Eliya</a></li>
                                <li><i class="fa fa-angle-double-right "></i><a href="../advertisements.php?location=ChIJ5VeV5R434joRUXuKDoS6hos">Kalutara</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>GET IN TOUCH</h3>
                        </div>
                        <div class="footer-contact-info">
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i> <span class="contact-info-title">Address:</span>
                                    <?php echo $LOCATION->description; ?>
                                </li>
                                <li><i class="fas fa-phone"></i><span class="contact-info-title">Phone Numbers:</span><?php echo $PHONE_NUMBER1->description . ' ' . $PHONE_NUMBER2->description;  ?></li>
                                <li><i class="far fa-envelope"></i><span class="contact-info-title">Email:</span><?php echo $EMAIL->description;  ?></li>
                            </ul>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-bottom-wrap">
        <div class="">
            <div class="copyright">2019 Copyright © flip.lk. Designed by Synotec Holdings (Pvt) Ltd.</div>
        </div>
    </section>
</footer>