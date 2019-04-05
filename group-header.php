<?php
$CATEGORY = new BusinessCategory($GROUP->category);
$SUBCATEGORY = new BusinessSubCategory($GROUP->subCategory);
?>
<div class="container">
    <div class="row">
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="ui-block first-block">
                <div class="top-header top-header-favorit">
                    <div class="top-header-thumb">
                        <?php
                        if (isset($GROUP->coverPicture)) {
                            ?>
                            <img src="upload/group/cover-picture/<?php echo $GROUP->coverPicture; ?>" alt="nature">
                            <?php
                        } else {
                            ?>
                            <img src="upload/group/cover-picture/Cover.jpg" alt="nature">
                            <?php
                        }
                        ?>

                        <div class="top-header-author">
                            <div class="author-thumb">
                                <?php
                                if (isset($GROUP->profilePicture)) {
                                    ?>
                                    <img src="upload/group/<?php echo $GROUP->coverPicture; ?>" alt="Cover Picture">
                                    <?php
                                } else {
                                    ?>
                                    <img src="upload/group/member.png" alt="PRofile picture">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="author-content">
                                <a href="#" class="h3 author-name"><?php echo $GROUP->name; ?></a>
                                <div class="country"><?php echo $CATEGORY->name; ?> |  <?php echo $SUBCATEGORY->name; ?></div>
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
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>