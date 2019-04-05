<section class="main-banner-wrap-layout1 bg-common overlay-dark-30 bg--gradient-top-30" data-bg-image="img/site-main-figure1.jpg" style="background-image: url(&quot;img/banner.jpg&quot;);">
    <div class="container">
        <div class="main-banner-box-layout1">
            <p class="item-sub-title">Browse &amp; connect with great places around the world</p>
            <h1 class="item-title">Let’s Browse </h1>
            <!--Search Box-->
            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="s002">
                    <form action="advertisements.php" method="get">
                        <div class="inner-form">
<!--                            <div class="input-field fouth-wrap">
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
                                <select data-trigger="" name="category">
                                    <option value="">Category</option>
                                    <?php
//                                    foreach (BusinessCategory::all() as $key => $category) {
                                        ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php
//                                    }
                                    ?>
                                </select>
                            </div>-->
                            <div class="input-field second-wrap">
                                <div class="icon-wrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="autocomplete" placeholder="Location" onFocus="geolocate()">
                                    <input type="hidden" name="location" id="city"  value=""/>
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
            </div>
            <!-- End Search Box-->
        </div>
    </div>
</section>