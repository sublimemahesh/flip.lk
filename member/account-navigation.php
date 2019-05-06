<div class="col col-xl-3 order-xl-1 col-lg-3 order-lg-1 col-md-12 order-md-2 col-sm-12  responsive-display-none">
    <div class="ui-block">
        <!-- Your Profile  -->

        <div class="your-profile">
            <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Your PROFILE</h6>
            </div>

            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h6 class="mb-0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Profile Settings
                                <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                            </a>
                        </h6>
                    </div>

                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                        <ul class="your-profile-menu">
                            <li>
                                <a href="personal-information.php">Personal Information</a>
                            </li>
                            <li>
                                <a>Account Settings</a>
                            </li>
                            <li>
                                <a href="change-password.php">Change Password</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="ui-block-title">
                <a href="notifications.php" class="h6 title">Notifications</a>
                <a class="items-round-little bg-blue"><?php echo $countnotifications; ?></a>
            </div>
            <div class="ui-block-title">
                <a href="member-message.php" class="h6 title">Chat / Messages</a>
                <a class="items-round-little bg-blue"><?php echo $countmsg; ?></a>
            </div>
            <div class="ui-block-title">
                <a href="friend-requests.php" class="h6 title">Follow Requests</a>
                <a class="items-round-little bg-blue"><?php echo $countu['count']; ?></a>
            </div>
            <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Groups</h6>
            </div>
            <div class="ui-block-title">
                <a href="create-group.php" class="h6 title">Create Group</a>
            </div>
            <div class="ui-block-title">
                <a href="manage-groups.php" class="h6 title">Manage Groups</a>
            </div>
        </div>
        <!-- ... end Your Profile  -->
    </div>
</div>
<!--Responsive-->
<div class="profile-settings-responsive">
    <a class="js-profile-settings-open profile-settings-open">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </a>
    <div class="mCustomScrollbar" data-mcs-theme="dark">
        <div class="ui-block">
            <div class="your-profile">
                <div class="ui-block-title ui-block-title-small">
                    <h6 class="title">Your PROFILE</h6>
                </div>
                <div id="accordion1" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne-1">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-1" aria-expanded="true" aria-controls="collapseOne">
                                    Profile Settings
                                    <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                </a>
                            </h6>
                        </div>

                        <div id="collapseOne-1" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                            <ul class="your-profile-menu">
                                <li>
                                    <a href="personal-information.php">Personal Information</a>
                                </li>
                                <li>
                                    <a>Account Settings</a>
                                </li>
                                <li>
                                    <a href="change-password.php">Change Password</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="ui-block-title">
                    <a class="h6 title">Notifications</a>
                    <a class="items-round-little bg-primary"></a>
                </div>
                <div class="ui-block-title">
                    <a class="h6 title">Chat / Messages</a>
                </div>
                <div class="ui-block-title">
                    <a class="h6 title">Friend Requests</a>
                    <a class="items-round-little bg-blue"></a>
                </div>
                <div class="ui-block-title ui-block-title-small">
                    <h6 class="title">FAVOURITE PAGE</h6>
                </div>
                <div class="ui-block-title">
                    <a href="create-group.php" class="h6 title">Create Group</a>
                </div>
                <div class="ui-block-title">
                    <a href="manage-groups.php" class="h6 title">Manage Groups</a>
                </div>
            </div>
        </div>
    </div>
</div>