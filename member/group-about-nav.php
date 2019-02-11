<?php
$no_of_request = GroupAndMemberRequest::getCountOfMemberRequestsByGroup($GROUP->id);
?>

<div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-2 col-md-6 col-sm-12 col-12">
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
                    <span class="title">Address:</span>
                    <span class="text"><?php echo $GROUP->address; ?>.
                    </span>
                </li>
                <li>
                    <span class="title">Favourites:</span>
                    <a href="#" class="text">5630 </a>
                </li>
            </ul>

            <!-- ... end W-Personal-Info -->
        </div>
    </div>
    <?php
    if (GroupMember::checkMemberIsAnAdmin($MEMBER->id, $GROUP->id)) {
        ?>
        <div class="ui-block">
            <div class="ui-block-title">
                <h6 class="title">Admin Activity</h6>
                <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
            </div>
            <div class="ui-block-content">

                <!-- W-Personal-Info -->

                <ul class="widget w-personal-info item-block">
                    <li>
                        <a href="member-requests.php?id=<?php echo $GROUP->id; ?>"<span class="title">Member Requests:</span><span class="request-label-avatar bg-blue"><?php echo $no_of_request['count']; ?></span></a>
                    </li>
                    <li>
                        <a href="group-settings.php?id=<?php echo $GROUP->id; ?>"<span class="title">Group Settings</span></a>
                    </li>
                </ul>

                <!-- ... end W-Personal-Info -->
            </div>
        </div>
        <?php
    }
    ?>

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