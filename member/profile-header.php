<div class="container">
    <div class="row">
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="ui-block">
                <div class="top-header">
                    <div class="top-header-thumb">
                        <?php
                        if ($MEM->coverPicture) {
                            ?>
                            <img src="../upload/member/cover-picture/<?php echo $MEM->coverPicture; ?>" alt="cover" id="cover_pic">
                            <?php
                        } else {
                            ?>
                            <img src="../upload/member/cover-picture/cover.jpg" alt="cover" id="cover_pic">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="profile-section">
                        <div class="row hidden-xs">
                            <?php
                            $url = explode("/", $_SERVER['REQUEST_URI']);
                            $result = explode(".", $url[3]); //localhost
                            //$result = explode(".", $url[2]); //online
                            
                            if (isset($_GET['id']) && $result[0] != 'member-message') {
                                ?>
                                <div class="col col-lg-5 col-md-5 col-sm-6 col-12">
                                    <ul class="profile-menu">

                                        <li>
                                            <a href="profile.php?id=<?php echo $MEM->id; ?>" class="active">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="about.php?id=<?php echo $MEM->id; ?>">About</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col col-lg-5 ml-auto col-md-5 col-sm-6 col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <a href="friends.php?id=<?php echo $MEM->id; ?>">Followers</a>
                                        </li>
                                        <li>
                                            <?php
                                            if ($MEM->id == $_SESSION['id']) {
                                                ?>
                                                <a href="member-message.php">Messages</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="member-message.php?member=<?php echo $MEM->id; ?>">Messages</a>
                                                <?php
                                            }
                                            ?>
                                        </li>

                                    </ul>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col col-lg-5 col-md-5 col-sm-6 col-12">
                                    <ul class="profile-menu">

                                        <li>
                                            <a href="profile.php" class="active">Timeline</a>
                                        </li>

                                        <li>
                                            <a href="about.php">About</a>
                                        </li>
                                        <li>
                                            <a href="friends.php">Followers</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col col-lg-5 ml-auto col-md-5 col-sm-6 col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <a href="advertisement.php">My Advertisements</a>
                                        </li>
                                        <li>
                                            <a href="member-message.php">Messages</a>
                                        </li>

                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row hidden-lg hidden-md hidden-sm ">
                            <?php
                            if (isset($_GET['id'])) {
                                ?>
                                <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                                    <ul class="profile-menu">

                                        <li>
                                            <a href="profile.php?id=<?php echo $MEM->id; ?>" class="active">Timeline</a>
                                        </li>
                                        <li>
                                            <a href="about.php?id=<?php echo $MEM->id; ?>">About</a>
                                        </li>
                                        <li>
                                            <a href="friends.php?id=<?php echo $MEM->id; ?>">Followers</a>
                                        </li>
                                        <li>
                                            <a href="member-message.php">Messages</a>
                                        </li>

                                    </ul>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                                    <ul class="profile-menu">

                                        <li>
                                            <a href="profile.php" class="active">Timeline</a>
                                        </li>

                                        <li>
                                            <a href="about.php">About</a>
                                        </li>
                                        <li>
                                            <a href="friends.php">Followers</a>
                                        </li>
                                        <li>
                                            <a href="advertisement.php">Advertisements</a>
                                        </li>
                                        <li>
                                            <a href="member-message.php">Messages</a>
                                        </li>

                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                        if ($MEM->id === $_SESSION['id']) {
                            ?>
                            <div class="control-block-button">
                                <div class="btn btn-control bg-primary more">
                                    <svg class="olymp-settings-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>

                                    <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                        <li>
                                            <a data-toggle="modal" data-target="#update-profile-photo">Update Profile Picture</a>
                                        </li>
                                        <li>
                                            <a data-toggle="modal" data-target="#update-cover-photo">Update Cover Picture</a>
                                        </li>
                                        <li>
                                            <a href="personal-information.php">Account Settings</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="top-header-author">
                        <a href="profile.php" class="author-thumb main-profile-pic">
                            <?php
                            if ($MEM->profilePicture) {

                                if ($MEM->facebookID && substr($MEM->profilePicture, 0, 5) === "https") {
                                    ?>
                                    <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>" id="profile_pic1">
                                    <?php
                                } elseif ($MEM->googleID && substr($MEM->profilePicture, 0, 5) === "https") {
                                    ?>
                                    <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>" id="profile_pic1">
                                    <?php
                                } else {
                                    ?>
                                    <img alt="profile picture" src="../upload/member/<?php echo $MEM->profilePicture; ?>" id="profile_pic1">
                                    <?php
                                }
                            } else {
                                ?>
                                <img src="../upload/member/member.png" alt="profile picture" id="profile_pic1">
                                <?php
                            }
                            ?>
                        </a>
                        <div class="author-content">
                            <a href="profile.php" class="h4 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                            <div class="country"><?php echo $MEM->cityString . ', ' . $MEM->districtString; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>