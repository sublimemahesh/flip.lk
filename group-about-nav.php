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
    if(isset($_SESSION['id'])) {
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
    }
    ?>

    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Group Members (<?php echo count(GroupMember::getAllMembersByGroup($GROUP->id)); ?>)</h6>
            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
        </div>
        <div class="ui-block-content">

            <!-- W-Faved-Page -->

            <ul class="widget w-faved-page">
                <?php
                foreach (GroupMember::getAllMembersByGroup($GROUP->id) as $key => $member) {
                    if ($key < 13) {
                        $MEM3 = new Member($member['member']);
                    
                    ?>
                    <li>
                        <a href="#" title="<?php echo $MEM3->firstName . ' ' . $MEM3->lastName; ?>">
                            <img src="upload/member/<?php echo $MEM3->profilePicture; ?>" class="friend-list-img" alt="author">
                        </a>
                    </li>
                    <?php
                }
                }
                if (count(GroupMember::getAllMembersByGroup($GROUP->id)) > 13) {
                    ?>
                    <li class="all-users">
                        <a href="#">+<?php echo count(GroupMember::getAllMembersByGroup($GROUP->id)) - 13; ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <!-- ... end W-Faved-Page -->
        </div>
    </div>
</div>