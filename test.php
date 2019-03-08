<?php
include_once(dirname(__FILE__) . '/class/include.php');
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <link href="css/flaticon.css" rel="stylesheet" type="text/css"/>
        <style>
            .bg--dark {

                background-color: #111111;

            }
            .padding-bottom-7 {

                padding-bottom: 7rem;

            }
            .padding-top-9p6 {

                padding-top: 9.6rem;

            }
            .overlay-dark-70 {

                position: relative;

            }
            .overlay-dark-70::before {

                content: "";
                position: absolute;
                top: 0;
                left: 0;
                z-index: 1;
                height: 100%;
                width: 100%;
                background-color: rgba(0, 0, 0, 0.7);

            }
            .overlay-dark-70 > div {

                position: relative;
                z-index: 7;

            }
            .category-box-layout1 {

                border-radius: 4px;
                background-color: #ffffff;
                padding: 30px;
                text-align: center;
                margin-bottom: 30px;

            }
            .category-box-layout1 .item-icon {

                order: 1;
                background-color: #ff4a52;
                border-radius: 50%;
                height: 80px;
                width: 80px;
                color: #ffffff;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                font-size: 42px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;

            }
            .category-box-layout1 .item-icon i {

                font-size: 42px;

            }
            .category-box-layout1 .item-icon i::before {
                font-size: 42px;
            }
            [class^="flaticon-"]::before, [class*=" flaticon-"]::before, [class^="flaticon-"]::after, [class*=" flaticon-"]::after {
                margin-left: 0;
            }
            .category-box-layout1 .item-title {
                font-size: 20px;
                font-weight: 600;
                color: #111111;
                margin-bottom: 10px;
                display: inline-block;
            }
            .category-box-layout1 .item-title a {
                color: #111111;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .category-box-layout1:hover .item-icon {
                -webkit-box-shadow: 0px 10px 12px 0px #b6b6b6;
                -moz-box-shadow: 0px 10px 12px 0px #b6b6b6;
                box-shadow: 0 10px 12px 0px #b6b6b6;
            }



            /*********************************/



            .no-equal-item   {
                position: absolute;
                left: 0px;
                top: 561px;
            }
            .product-box.border-box {
                box-shadow: none;
            }
            .product-box {
                border-radius: 4px;
                margin-bottom: 3rem;
                background-color: #ffffff;
                -webkit-box-shadow: 0px 1px 0px 0px #d7d7d7;
                -moz-box-shadow: 0px 1px 0px 0px #d7d7d7;
                box-shadow: 0 1px 0px 0px #d7d7d7;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .listing-box-grid .product-box .item-img {
                border-radius: 4px 4px 0 0;
            }
            .product-box .item-img {
                position: relative;
            }
            .product-box .item-img .item-status.active {
                display: block;
            }
            .product-box .item-img .status-open {
                padding: 5px 20px 14px 35px;
                background-image: url("img/icon/save.png");
                right: -9px;
                top: 20px;
            }
            .product-box .item-img .item-status {
                display: none;
                color: #ffffff;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: absolute;
                z-index: 2;
            }
            .product-box .item-img .status-save {
                padding: 7px 15px 14px 30px;
                background-image: url("img/icon/save.png");
                right: -9px;
                top: 70px;
            }
            .product-box .item-img .item-status {
                display: none;
                color: #ffffff;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: absolute;
                z-index: 2;
            }
            .listing-box-grid .product-box .item-img .grid-view-img {
                display: block;
            }
            .listing-box-grid .product-box .item-img img {
                border-radius: 4px 4px 0 0;
            }
            .img-fluid {
                max-width: 100%;
                height: auto;

            }
            .listing-box-grid .product-box .item-img .item-rating {
                left: inherit;
                right: 15px;
                bottom: 15px;
            }
            .product-box .item-img .item-rating {
                position: absolute;
                z-index: 5;
            }
            ul {
                list-style: outside none none;
                margin: 0;
                padding: 0;
            }
            .product-box .item-img .item-rating li {
                display: inline-block;
            }
            .product-box .item-img .item-rating li > i {
                font-size: 14px;
                color: #ffb300;
            }
            .listing-box-grid .product-box .item-img .item-logo {
                bottom: -30px;
                left: 30px;
            }
            .product-box .item-img .item-logo {
                position: absolute;
                z-index: 5;
            }
            .product-box .item-img .item-logo img {
                width: 60px;
            }
            .listing-box-grid .product-box .item-img img {
                border-radius: 4px 4px 0 0;
            }
            .bg--gradient-50::after {
                opacity: 0.5;
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#111), to(transparent));
                background-image: -webkit-linear-gradient(transparent, #111);
                background-image: -moz-linear-gradient(transparent, #111), -moz-linear-gradient(transparent, #111);
                background-image: -o-linear-gradient(transparent, #111), -o-linear-gradient(transparent, #111);
                background-image: linear-gradient(transparent, #111), linear-gradient(transparent, #111);
                content: "";
                height: 50%;
                bottom: 0;
                left: 0;
                right: 0;
                position: absolute;
                width: 100%;
                z-index: 1;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .listing-box-grid .product-box .item-content {
                padding: 50px 30px 30px;
                border-radius: 0 0 4px 4px;
            }
            .product-box.border-box .item-content {
                border-right: 1px solid #d7d7d7;
                border-bottom: 1px solid #d7d7d7;
                border-left: 1px solid #d7d7d7;
            }
            .product-box .item-content {
                -webkit-box-flex: 1;
                -ms-flex: 1;
                flex: 1;
                position: relative;
            }
            .product-box .item-content .item-title {
                font-weight: 600;
                margin-bottom: 10px;
            }
            .product-box .item-content .item-title a {
                color: #111111;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .item-paragraph {
                margin: 0 0 20px 0;
                font-size: 16px;
            }
            .product-box .item-content .contact-info {
                margin-bottom: 20px;
            }
            .product-box .item-content .contact-info li {
                margin-bottom: 10px;
                position: relative;
                padding-left: 30px;
            }
            .product-box .item-content .contact-info li i {
                margin-right: 10px;
                color: #ff4a52;
                position: absolute;
                left: 0;
                top: 3px;
                line-height: 1;
            }
            .product-box .item-content .contact-info li i::before {
                font-size: 18px;
            }
            .product-box .item-content .meta-item {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }
            .product-box .item-content .meta-item li.ctg-name {
                margin-bottom: 5px;
                margin-top: 5px;
            }
            .product-box .item-content .meta-item li.ctg-name a {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                color: #111111;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .product-box .item-content .meta-item li.ctg-name a i {
                margin-right: 10px;
                border: 1px solid #ff4a52;
                color: #ff4a52;
                border-radius: 50%;
                height: 40px;
                width: 40px;
                text-align: center;
                line-height: 36px;
                font-size: 16px;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .product-box .item-content .meta-item li.ctg-name a i::before {
                font-size: 20px;
            }
            [class^="flaticon-"]::before, [class*=" flaticon-"]::before, [class^="flaticon-"]::after, [class*=" flaticon-"]::after {
                margin-left: 0;
            }
            .product-box .item-content .meta-item li.entry-meta {
                margin-top: 5px;
                margin-bottom: 5px;
            }
            .product-box .item-content .meta-item li.entry-meta ul {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: end;
                -ms-flex-pack: end;
                justify-content: flex-end;
            }
            .product-box .item-content .meta-item li.entry-meta ul li {
                margin-right: 10px;
            }
            .product-box .item-content .meta-item li.entry-meta ul li a {
                display: block;
                border: 1px solid #ff4a52;
                border-radius: 50%;
                height: 40px;
                width: 40px;
                text-align: center;
                line-height: 40px;
                color: #ff4a52;
                font-size: 16px;
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }
            .product-box .item-content .meta-item li.entry-meta ul li:last-child {
                margin-right: 0;
            }
        </style>
    </head>
    <body>
        <section class="category-wrap-layout1 padding-top-9p6 padding-bottom-7 overlay-dark-70 parallaxie bg--dark" data-bg-image="img/figure/figure2.jpg" style="background-image: url(&quot;https://radiustheme.com/demo/html/listygo/listygo/img/figure/figure2.jpg&quot;); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center -112.842px;">
            <div class="container">
                <div class="section-heading heading-light heading-center">
                    <div class="item-sub-title">Explore some of the best place by categories</div>
                    <h2 class="item-title">What are you interested in?</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <img src="upload/business-category/car.png" alt=""/>
                            </div>
                            <h3 class="item-title"><a href="#">Destination</a></h3>
                            <div class="listing-number">40 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <img src="upload/business-category/comfortable.png" alt=""/>
                            </div>
                            <h3 class="item-title"><a href="#">Shopping</a></h3>
                            <div class="listing-number">25 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-chef"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Restaurants</a></h3>
                            <div class="listing-number">30 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-musical-note"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Nightlife</a></h3>
                            <div class="listing-number">09 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-coffee-cup"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Bar &amp; Cafe</a></h3>
                            <div class="listing-number">15 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-bed"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Hotel</a></h3>
                            <div class="listing-number">20 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-spa"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Beauty &amp; Spa</a></h3>
                            <div class="listing-number">06 Listings</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="category-box-layout1">
                            <div class="item-icon">
                                <i class="flaticon-dish"></i>
                            </div>
                            <h3 class="item-title"><a href="#">Food &amp; Drink</a></h3>
                            <div class="listing-number">11 Listings</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="category-wrap-layout1 padding-top-9p6 padding-bottom-7 overlay-dark-70 parallaxie bg--dark" data-bg-image="img/figure/figure2.jpg" style="">
            <div class="col-xl-4 col-lg-6 col-md-6 col-12 no-equal-item" style="position: absolute; left: 0px; top: 561px;">
                <div class="listing-box-grid">
                    <div class="product-box border-box">
                        <div class="item-img bg--gradient-50">
                            <div class="item-status status-open active">Open</div>
                            <div class="item-status status-save">Save 15%</div>
                            <img src="upload/business-category/car.png" alt="Listing" class="img-fluid grid-view-img">
                            <!--<img src="upload/business-category/car.png" alt="Listing" class="img-fluid list-view-img">-->
                            <ul class="item-rating">
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><span>8.4<span> / 10</span></span> </li>
                            </ul>
                            <div class="item-logo"><img src="upload/business-category/car.png" alt="Logo"></div>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title"><a href="#">Westfield Restaurant</a></h3>
                            <p class="item-paragraph">Mountain Refuge Resort is the most ... </p>
                            <ul class="contact-info">
                                <li><i class="fas fa-map-marker-alt"></i>59 Street, Mk tower, Brooklyn</li>
                                <li><i class="flaticon-phone-call"></i>+ 132 899 6330</li>
                                <li><i class="fas fa-globe"></i>www.restauant.com</li>
                            </ul>
                            <ul class="meta-item">
                                <li class="item-btn"><a href="#" class="btn-fill">Details</a></li>
                                <li class="ctg-name"><a href="#"><i class="flaticon-supermarket"></i>Shopping</a></li>
                                <li class="entry-meta">
                                    <ul>
                                        <li class="tooltip-item ctg-icon" data-tips="Shopping"><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                        <li class="tooltip-item" data-tips="My Favourite"><a href="#"><i class="fas fa-heart"></i></a></li>
                                        <li class="tooltip-item" data-tips="Gallery"><a href="#"><i class="far fa-image"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>










    </body>
</html>