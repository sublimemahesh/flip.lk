<div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">About Group</h6>
            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
        </div>
        <div class="ui-block-content">

            <!-- W-Personal-Info -->

            <ul class="widget w-personal-info item-block">
                <li>
                    <span class="text"><?php echo $GROUP->description; ?></span>
                </li>
                <li>
                    <span class="title">Created:</span>
                    <span class="text"><?php echo date_format(date_create(substr($GROUP->createdAt, 0, 10)), "F dS, Y"); ?></span>
                </li>
                <li>
                    <span class="title">Based in:</span>
                    <span class="text" id="city"></span><span class="text" id="district"></span>
                    <input type="hidden" id="autocomplete" value="<?php echo $GROUP->city; ?>" />
                    <input type="hidden" id="autocomplete2" value="<?php echo $GROUP->district; ?>" />
                </li>
                <li>
                    <span class="title">Email:</span>
                    <a href="#" class="text"><?php echo $GROUP->email; ?></a>
                </li>
                <li>
                    <span class="title">Phone Number:</span>
                    <a href="#" class="text"><?php echo $GROUP->phoneNumber; ?></a>
                </li>
                <li>
                    <span class="title">Favourites:</span>
                    <a href="#" class="text">5630 </a>
                </li>
            </ul>

            <!-- ... end W-Personal-Info -->
        </div>
    </div>

    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Location</h6>
            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
        </div>


        <!-- Contacts -->

        <div class="widget w-contacts">
            <!-- Google map -->

            <div class="section">
                <div id="map"></div>
                <script>
                    var map;

                    function initMap() {

                        var myLatLng = {lat: -25.363, lng: 131.044};

                        map = new google.maps.Map(document.getElementById('map'), {
                            center: myLatLng,
                            zoom: 14,
                            scrollwheel: false//set to true to enable mouse scrolling while inside the map area
                        });

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            icon: {
                                url: "img/marker-google.png",
                                scaledSize: new google.maps.Size(50, 50)
                            }

                        });
                    }


                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBESxStZOWN9aMvTdR3Nov66v6TXxpRZMM&amp;callback=initMap"
                async defer></script>
            </div>

            <!-- End Google map -->

            <ul>
                <li>
                    <span class="title">Address:</span>
                    <span class="text"><?php echo $GROUP->address; ?>.
                    </span>
                </li>
                <li>
                    <span class="title">Working Hours:</span>
                    <span class="text">Mon-Fri 9:00am to 6:00pm
                        Weekends 10:00am to 8:00pm
                    </span>
                </li>
            </ul>
        </div>

        <!-- ... end Contacts -->
    </div>

    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Faved this Page</h6>
            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
        </div>
        <div class="ui-block-content">

            <!-- W-Faved-Page -->

            <ul class="widget w-faved-page">
                <li>
                    <a href="#">
                        <img src="img/faved-page1.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page2.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page3.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page4.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page5.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page6.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page7.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page8.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page9.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page7.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page10.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page11.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page7.jpg" alt="user">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="img/faved-page12.jpg" alt="user">
                    </a>
                </li>
                <li class="all-users">
                    <a href="#">+5k</a>
                </li>
            </ul>

            <!-- ... end W-Faved-Page -->
        </div>
    </div>
</div>