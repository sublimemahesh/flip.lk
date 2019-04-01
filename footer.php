<?php
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
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
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                        </div>

                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>Top Highlights</h3>
                        </div>
                        <div class="widget_nav_menu">
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><a href="all-advertisement.php">Advertisement</a></li>
                                <li><a href="member/">Newsfeed</a></li>
                                <li><a href="member/manage-groups.php">Groups</a></li>
                                <li><a href="member/login.php">Sign In</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>Support</h3>
                        </div>
                        <div class="widget_nav_menu">
                            <ul>
                                <li><a href="about-us.html">Live Chat</a></li>
                                <li><a href="about-us.html">FAQ</a></li>
                                <li><a href="faq.html">Stay safe</a></li>
                                <li><a href="appointment.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="single-item col-lg-3 col-md-3 col-12 col-sm-3">
                    <div class="footer-box">
                        <div class="footer-header">
                            <h3>Follow Us On</h3>
                        </div>
                        <div class="footer-contact-info">
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i>
                                    32,ABC Road,USA .
                                    <?php // echo $LOCATION->description; ?>
                                </li>
                                <li><i class="fas fa-phone"></i>0098 7898569  <?php // echo $PHONE_NUMBER1->description; ?></li>
                                <li><i class="far fa-envelope"></i> info@flip.com<?php // echo $EMAIL->description; ?></li>
                            </ul>
                        </div>

                        <div class="footer-social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fab fa-skype"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-bottom-wrap">
        <div class="container">
            <div class="copyright">2019 Copyright © flip.lk. Designed by Synotec Holdings (Pvt) Ltd.</div>
        </div>
    </section>
</footer>