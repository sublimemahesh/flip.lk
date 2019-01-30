<div class="container">
    <div class="row">
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="ui-block">
                <div class="top-header">
                    <div class="top-header-thumb">
                        <img src="../upload/member/cover-picture/<?php echo $MEM->coverPicture; ?>" alt="nature">
                    </div>
                    <div class="profile-section">
                        <div class="row">
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
                                    </ul>
                                </div>
                                <div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <a href="#">Photos</a>
                                        </li>
                                        <li>
                                            <a href="#">Videos</a>
                                        </li>
                                        <li>
                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <ul class="more-dropdown more-with-triangle">
                                                    <li>
                                                        <a href="#">Report Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Block Profile</a>
                                                    </li>
                                                </ul>
                                            </div>
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

                                    </ul>
                                </div>
                                <div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <a href="advertisement.php">My Advertisement</a>
                                        </li>
                                        <li>
                                            <a href="#">Videos</a>
                                        </li>
                                        <li>
                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <ul class="more-dropdown more-with-triangle">
                                                    <li>
                                                        <a href="#">Report Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Block Profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="control-block-button">
                            <a href="35-YourAccount-FriendsRequests.html" class="btn btn-control bg-blue">
                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                            </a>

                            <a href="#" class="btn btn-control bg-purple">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                            </a>

                            <div class="btn btn-control bg-primary more">
                                <svg class="olymp-settings-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>

                                <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#update-profile-photo">Update Profile Picture</a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#update-cover-photo">Update Cover Picture</a>
                                    </li>
                                    <li>
                                        <a href="personal-information.php">Account Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="top-header-author">
                        <a href="profile.php" class="author-thumb main-profile-pic">
                            <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="profile picture">
                        </a>
                        <div class="author-content">
                            <a href="profile.php" class="h4 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                            <!--<div class="country"><?php echo $MEM->city . ' ' . $MEM->district; ?></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>