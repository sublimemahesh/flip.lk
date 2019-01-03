<div class="container">
    <div class="row">
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="ui-block">
                <div class="top-header top-header-favorit">
                    <div class="top-header-thumb">
                        <img src="../upload/group/cover-picture/<?php echo $GROUP->coverPicture; ?>" alt="nature">
                        <div class="top-header-author">
                            <div class="author-thumb">
                                <img src="../upload/group/<?php echo $GROUP->profilePicture; ?>" alt="author">
                            </div>
                            <div class="author-content">
                                <a href="#" class="h3 author-name"><?php echo $GROUP->name; ?></a>
                                <div class="country">Rock Band  |  San Francisco, CA</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-section">
                        <div class="row">
                            <div class="col col-xl-8 m-auto col-lg-8 col-md-12">
                                <ul class="profile-menu">
                                    <li>
                                        <a href="group.php?id=<?php echo $GROUP->id; ?>" class="active">Timeline</a>
                                    </li>
                                    <li>
                                        <a href="members.php?id=<?php echo $GROUP->id; ?>">Members</a>
                                    </li>
                                    <li>
                                        <a href="#">Photos</a>
                                    </li>
                                    <li>
                                        <a href="#">Videos</a>
                                    </li>
                                    <li>
                                        <a href="#">Events</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="control-block-button">
                            <a href="#" class="btn btn-control bg-primary">
                                <svg class="olymp-star-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>
                            </a>

                            <a href="#" class="btn btn-control bg-purple">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>