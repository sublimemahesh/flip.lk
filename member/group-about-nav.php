<?php
$no_of_request = GroupAndMemberRequest::getCountOfMemberRequestsByGroup($GROUP->id);
$countAds = Advertisement::countAdsByGroup($GROUP->id);
?>

<div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-2 col-md-6 col-sm-12 col-12">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">About Group</h6>
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
                    <span class="text"><?php echo $GROUP->cityString . ', ' . $GROUP->districtString; ?></span>
                </li>
                <li>
                    <span class="title">Email:</span>
                    <a class="text"><?php echo $GROUP->email; ?></a>
                </li>
                <li>
                    <span class="title">Phone Number:</span>
                    <a class="text"><?php echo $GROUP->phoneNumber; ?></a>
                </li>
                <li>
                    <span class="title">Address:</span>
                    <span class="text"><?php echo $GROUP->address; ?>.
                    </span>
                </li>
                <li>
                    <span class="title">No of Ads:</span>
                    <a class="text"><?php echo $countAds; ?> </a>
                </li>
            </ul>

            <!-- ... end W-Personal-Info -->
        </div>
    </div>


    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Group Members (<?php echo count(GroupMember::getAllMembersByGroup($GROUP->id)); ?>)</h6>
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
                            <a title="<?php echo $MEM3->firstName . ' ' . $MEM3->lastName; ?>">
                                <?php
                                if ($MEM3->profilePicture) {

                                    if ($MEM3->facebookID && substr($MEM3->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $MEM3->profilePicture; ?>" class="friend-list-img">
                                        <?php
                                    } elseif ($MEM3->googleID && substr($MEM3->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $MEM3->profilePicture; ?>" class="friend-list-img">
                                        <?php
                                    } else {
                                        ?>
                                        <img alt="profile picture" src="../upload/member/<?php echo $MEM3->profilePicture; ?>" class="friend-list-img">
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <img src="../upload/member/member.png" class="friend-list-img" alt="profile">
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                if (count(GroupMember::getAllMembersByGroup($GROUP->id)) > 13) {
                    ?>
                    <li class="all-users">
                        <a>+<?php echo count(GroupMember::getAllMembersByGroup($GROUP->id)) - 13; ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <!-- ... end W-Faved-Page -->
        </div>
    </div>
</div>