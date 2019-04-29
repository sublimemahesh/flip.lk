<!-- Window-popup Update Profile Photo -->
<div class="modal fade" id="update-profile-photo" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Update Profile Picture</h6>
            </div>

            <div class="modal-body">
                <a href="#" class="upload-photo-item upload-profile-pic">
                    <svg class="olymp-computer-icon upload-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                    <?php
                    if (empty($MEMBER->profilePicture)) {
                        ?>
                        <img src="../upload/member/member.png" class="img img-responsive img-thumbnail pro-pic" id="profile_pic"/>
                        <?php
                    } else {
                        ?>
                        <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" class="img img-responsive img-thumbnail pro-pic" id="profile_pic"/>
                        <?php
                    }
                    ?>
<!--<img src="../upload/member/-172185548_191030955358_1546515218_n.jpg" class="pro-pic" alt=""/>-->
                    <form id="edit-profile-picture-form">
                        <h6>Upload Photo</h6>
                        <span>Browse your computer.</span>
                        <input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">
                        <input type="hidden" name="update-profile" id="update-profile" value="TRUE">
                        <input type="hidden" name="member" id="member" value="<?php echo $MEMBER->id; ?>">
                        <input type="hidden" name="sort" id="sort" value="1">
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup Update Profile Photo -->

<!-- Window-popup Update Cover Photo -->
<div class="modal fade" id="update-cover-photo" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Update Cover Picture</h6>
            </div>

            <div class="modal-body">
                <a href="#" class="upload-photo-item upload-cover-pic">
                    <!--<svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>-->

                    <?php
                    if (empty($MEMBER->coverPicture)) {
                        ?>
                        <img src="image/cover.jpg" class="img img-responsive img-thumbnail cover-pic" id="cover_pic"/>
                        <?php
                    } else {
                        ?>
                        <img src="../upload/member/cover-picture/thumb/<?php echo $MEMBER->coverPicture; ?>" class="img img-responsive img-thumbnail cover-pic" id="cover_pic"/>
                        <?php
                    }
                    ?>
<!--<img src="../upload/member/-172185548_191030955358_1546515218_n.jpg" class="pro-pic" alt=""/>-->
                    <form id="edit-cover-picture-form">
                        <h6>Upload Photo</h6>
                        <span>Browse your computer.</span>
                        <input type="file" name="cover-picture" id="cover-picture" class="cover-picture" sort="1" value="">
                        <input type="hidden" name="update-cover" id="update-cover" value="TRUE">
                        <input type="hidden" name="member" id="member" value="<?php echo $MEMBER->id; ?>">
                        <input type="hidden" name="sort" id="sort" value="1">
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup Update Cover Photo -->

<!-- Window-popup Add Member -->
<div class="modal fade" id="add-member" tabindex="-1" role="dialog" aria-labelledby="add-member" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Add Members</h6>
            </div>

            <div class="modal-body">

                <input type="text" name="" id="member-name" class="member-name" member-id="<?php echo $MEMBER->id; ?>" placeholder="Enter name" />
                <div class="" id="member-name-list-append"></div>
                <input type="hidden" name="member" value="" id="mem-id"  />

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-blue btn-md-2 add-members" id="" group-id="<?php echo $GROUP->id; ?>" member-id="<?php echo $MEMBER->id; ?>">Add<div class="ripple-container"></div></a>

            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup Add Member -->

<!-- Window-popup Add Member -->
<div class="modal fade" id="add-member-success-msg" tabindex="-1" role="dialog" aria-labelledby="add-member-success-msg" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">New Member</h6>
            </div>

            <div class="modal-body">
                <h5><span id="new-member-name"></span> has been invited to the group.</h5>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-blue btn-md-2 done-btn" id="" group-id="<?php echo $GROUP->id; ?>" member-id="<?php echo $MEMBER->id; ?>">Done<div class="ripple-container"></div></a>

            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup already-a-member -->
<!-- Window-popup Add Member -->
<div class="modal fade close-modal" id="already-a-member" tabindex="-1" role="dialog" aria-labelledby="already-a-member" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Already a Member</h6>
            </div>

            <div class="modal-body">
                <h5>The person you just tried to add is already a member of this group.</h5>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-blue btn-md-2 close-btn" id="" >Close<div class="ripple-container"></div></a>

            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup already-a-member -->

<!-- Window-popup already invited -->
<div class="modal fade close-modal" id="already-invited" tabindex="-1" role="dialog" aria-labelledby="already-invited" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Person Already Invited</h6>
            </div>

            <div class="modal-body">
                <h5>The person you are trying to invite was already invited to this group.</h5>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-blue btn-md-2 close-btn">Close<div class="ripple-container"></div></a>

            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup already invited -->

<!-- Window-popup Edit Post -->
<div class="modal fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="edit-post" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Edit Post</h6>
            </div>

            <div class="modal-body">
                <?php
                $POST = new Post(1);
                ?>
                <div class="" id="edit-post-section"></div>
            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup Edit Post -->

<!-- Window-popup Share Ad -->
<div class="modal fade" id="share-ad" tabindex="-1" role="dialog" aria-labelledby="share-ad" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">

        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Share this advertisement</h6>
            </div>

            <div class="modal-body">
                <div class="news-feed-form">
                    <div class="author-thumb">
                        <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                    </div>
                    <div class="form-group with-icon label-floating is-empty">
                        <label class="control-label">Share what you are thinking here...</label>
                        <textarea class="form-control" placeholder="" name="description" id="description"></textarea>
                    </div>
                    <article class="hentry post has-post-thumbnail shared-photo">
                        <div class="post-thumb">
                            <div id="gallery1"></div>   
                        </div>
                        <ul class="children single-children" id="shared-ad-details"></ul>
                        <button id="share-post" class="btn btn-md-2 btn-primary share-post" ad="" member="<?php echo $MEMBER->id; ?>">Share Ad</button>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ... end  Window-popup Share Ad -->

<!-- Window-popup Published Ad -->
<div class="modal fade" id="view-ad" tabindex="-1" role="dialog" aria-labelledby="view-ad" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">

        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">View Advertisement</h6>
            </div>

            <div class="modal-body">
                <div class="news-feed-form">
                    <article class="hentry post has-post-thumbnail shared-photo">
                        <div class="post-thumb">
                            <div id="gallery2"></div>   
                        </div>
                        <ul class="children single-children" id="view-ad-details"></ul>
                        <span class="view-ad-btn"></span>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ... end  Window-popup Share Ad -->

<!-- Window-popup Boost Post -->
<div class="modal fade" id="boost-ad" tabindex="-1" role="dialog" aria-labelledby="boost-ad" aria-hidden="true">
    <div class="modal-dialog window-popup update-header-photo" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="modal-header">
                <h6 class="title">Boost Your Advertisement</h6>
            </div>

            <div class="modal-body">
                <div class="ui-block-content">
                    <div class="row">

                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group date-time-picker label-floating is-empty">
                                <label class="control-label">Boost From</label>
                                <input name="datetimepicker" id="boostFrom" placeholder="" value="" />
                                <span class="input-group-addon">
                                    <svg class="olymp-month-calendar-icon icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-month-calendar-icon"></use></svg>
                                </span>
                            </div>
                            <div class="form-group date-time-picker label-floating is-empty">
                                <label class="control-label">Boost To</label>
                                <input name="datetimepicker" id="boostTo" placeholder="" value="" />
                                <span class="input-group-addon">
                                    <svg class="olymp-month-calendar-icon icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-month-calendar-icon"></use></svg>
                                </span>
                            </div>
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <input type="submit" name="send-boost-email" id="send-boost-email" adid="" class="btn btn-primary btn-lg full-width" value="Send Enquiry" />
                        </div>

                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- ... end Window-popup Edit Post -->