<div class="col col-xl-4 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Profile Intro</h6>
        </div>
        <div class="ui-block-content">
            <!-- W-Personal-Info -->
            <ul class="widget w-personal-info item-block">
                <li>
                    <span class="title">About Me:</span>
                    <span class="text"><?php echo $MEM->aboutMe; ?></span>
                </li>
            </ul>
            <!-- .. end W-Personal-Info -->
        </div>
    </div>

    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Friends (<?php echo count(Friend::getAllFriendsByMember($MEM->id)); ?>)</h6>
        </div>
        <div class="ui-block-content">

            <!-- W-Faved-Page -->

            <ul class="widget w-faved-page js-zoom-gallery">
                <?php
                foreach (Friend::getAllFriendsByMember($MEM->id) as $key => $friend) {
                    if ($key < 13) {
                        if ($friend['member'] == $MEM->id) {
                            $FRIEND = new Member($friend['friend']);
                        } else {
                            $FRIEND = new Member($friend['member']);
                        }
                        ?>
                        <li>
                            <a href="#" title="<?php echo $FRIEND->firstName . ' ' . $FRIEND->lastName; ?>">
                                <?php
                                if ($FRIEND->profilePicture) {
                                    if ($FRIEND->facebookID && substr($FRIEND->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $FRIEND->profilePicture; ?>" class="friend-list-img" >
                                        <?php
                                    } elseif ($FRIEND->googleID && substr($FRIEND->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $FRIEND->profilePicture; ?>" class="friend-list-img">
                                        <?php
                                    } else {
                                        ?>
                                        <img alt="profile picture" src="../upload/member/<?php echo $FRIEND->profilePicture; ?>" class="friend-list-img">
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <img alt="profile picture" src="../upload/member/member.png" class="friend-list-img">
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                if (count(Friend::getAllFriendsByMember($MEM->id)) > 13) {
                    ?>
                    <li class="all-users">
                        <a href="#">+<?php echo count(Friend::getAllFriendsByMember($MEM->id)) - 13; ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <!-- .. end W-Faved-Page -->
        </div>
    </div>
</div>