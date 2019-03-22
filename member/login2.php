<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$img = '';
$cover = '';
$c = '';
$MEMBER = new Member($_SESSION['id']);
if (isset($_SESSION['image'])) {
    $img = $_SESSION['image'];
}
if (isset($_SESSION['cover'])) {
    $cover = $_SESSION['cover'];
}
if (isset($_GET['c'])) {
    $c = 'c';
}

$back_url = '';
if (isset($_SESSION["back_url"])) {
    $back_url = $_SESSION["back_url"];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Landing Page</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Main Font -->
        <script src="js/webfontloader.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:300,400,500,700:latin']
                }
            });
        </script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="landing-page">
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <div class="container index-container body-content">

            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="form">
                    <div class="tab-content">
                        <div id="profile-pic-upload">   
                            <h1>Upload Profile Picture</h1>
                            <div class="top-bott20 m-l-25 m-r-15">
                                <?php
                                if (isset($_GET['message'])) {

                                    $MESSAGE = New Message($_GET['message']);
                                    ?>
                                    <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                        <?php echo $MESSAGE->description; ?>
                                    </div>
                                    <?php
                                }

                                $vali = new Validator();

                                $vali->show_message();
                                ?>
                            </div>
                            <form class="content" id="form-profile-picture">
                                <div class="row upload-pro-pic">
                                        <!--<img src="image/driver.png" alt=""/>-->
                                    <div class="uploadphotobx" id="uploadphotobx"> 


                                        <div class="proimg">
                                            <?php
                                            if (isset($_SESSION['image'])) {
                                                ?>
                                                <img src="../upload/member/<?php echo $img; ?>" class="profile-default-image pro-pic" alt=""/>
                                                <?php
                                            } else {
                                                ?>
                                                <img src="image/profile.png" class="profile-default-image" alt=""/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <label class="uploadBox">
                                            <!--<input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">-->
                                            <input type="hidden" name="upload-profile" id="upload-profile" value="TRUE">
                                            <input type="hidden" name="sort" id="sort" value="1">
                                        </label>


                                    </div>
                                    <span class="upload-span" id="upload-span">
                                        <i class="fa fa-camera fa-2x"></i><br />
                                        Click here to Upload photo
                                        <input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">
                                    </span>

                                </div>
                                <input type="hidden" id="pro" name="profile" value="<?php echo $img; ?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" />
                                <a class="button button-block" id="upload-pro-pic" name="upload-pro-pic"/>Upload</a>

                            </form>
                        </div>
                        <div id="cover-pic-upload">   
                            <h1>Upload Cover Picture</h1>
                            <div class="top-bott20 m-l-25 m-r-15">
                                <?php
                                if (isset($_GET['message'])) {

                                    $MESSAGE = New Message($_GET['message']);
                                    ?>
                                    <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                        <?php echo $MESSAGE->description; ?>
                                    </div>
                                    <?php
                                }

                                $vali = new Validator();

                                $vali->show_message();
                                ?>
                            </div>
                            <form class="content" id="form-cover-picture">
                                <div class="row upload-cover-pic">
                                        <!--<img src="image/driver.png" alt=""/>-->
                                    <div class="uploadphotobx2" id="uploadphotobx2"> 


                                        <div class="coverimg">
                                            <?php
                                            if (isset($_SESSION['cover'])) {
                                                ?>
                                                <img src="../upload/member/cover-picture/thumb/<?php echo $cover; ?>" class="cover-default-image cover-pic" alt=""/>
                                                <?php
                                            } else {
                                                ?>
                                                <img src="image/cover.jpg" class="cover-default-image" alt=""/>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <label class="uploadBox2">
                                            <!--<input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">-->
                                            <input type="hidden" name="upload-cover" id="upload-cover" value="TRUE">
                                            <input type="hidden" name="sort" id="sort" value="1">
                                        </label>


                                    </div>
                                    <span class="upload-span2" id="upload-span2">
                                        <i class="fa fa-camera fa-2x"></i><br />
                                        Click here to Upload photo
                                        <input type="file" name="cover-picture" id="cover-picture" class="cover-picture" sort="1" value="">
                                    </span>

                                </div>
                                <input type="hidden" id="cover" name="cover" value="<?php echo $cover; ?>" />
                                <input type="hidden" id="c" name="c" value="<?php echo $c; ?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" />
                                <input type="hidden" class="form-control"  name="back_url" value="<?php echo $back_url; ?>">
                                <a class="button button-block" id="upload-cover-pic" name="upload-pro-pic"/>Upload</a>

                            </form>
                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->
            </div>
        </div>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <!--custom js-->
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/add-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-cover-picture.js" type="text/javascript"></script>
    </body>
</html>