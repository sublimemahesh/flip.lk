<?php
include_once(dirname(__FILE__) . '/../class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = new Member(1);
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <style>
            *, *:before, *:after {
                box-sizing: border-box;
            }

            html {
                overflow-y: scroll; 
            }

            body {
                height: 100%;
                /*background-image: url('../img/banner.jpg');*/
                background: 
                    /* top, transparent red, faked with gradient */ 
                    linear-gradient(
                    rgba(0, 1, 2, 0.26), 
                    rgba(0, 1, 2, 0.77) 
                    ),
                    url('../img/banner.jpg');
                height: 100%;
                font-family: 'Titillium Web', sans-serif;
            }

            a {
                text-decoration:none;
                color:#003263;
                transition:.5s ease;
                &:hover {
                    color:darken(#1ab188,5%);
                }
            }

            .form {
                background:#ffffffb3;
                padding: 40px;
                max-width:600px;
                margin:6% auto;
                border-radius:4px;
                box-shadow:0 4px 10px 4px rgba(#13232f,.3);
            }

            .tab-group {
                list-style:none;
                padding:0;
                margin:0 0 25px 0;
                &:after {
                    content: "";
                    display: table;
                    clear: both;
                }
                li a {
                    display:block;
                    text-decoration:none;
                    padding:15px;
                    background:rgba(#a0b3b0,.25);
                    color:#a0b3b0;
                    font-size:20px;
                    float:left;
                    width:50%;
                    text-align:center;
                    cursor:pointer;
                    transition:.5s ease;
                    &:hover {
                        background:darken(#1ab188,5%);
                        color:#ffffff;
                    }
                }
                .active a {
                    background:#1ab188;
                    color:#ffffff;
                }
            }

            .tab-content > div:last-child {
                display:none;
            }


            h1 {
                text-align:center;
                color: #003263;
                font-weight: 600;
                margin: 0 0 25px;
                font-size: 25px;
            }

            label {
                position:absolute;
                transform:translateY(6px);
                left:13px;
                color:#00326380;
                transition:all 0.25s ease;
                -webkit-backface-visibility: hidden;
                pointer-events: none;
                font-size:16px;
                .req {
                    margin:2px;
                    color:#1ab188;
                }
            }

            label.active {
                transform:translateY(37px);
                left:2px;
                font-size:14px;
                .req {
                    opacity:0;
                }
            }

            label.highlight {
                color:#ffffff;
            }

            input, textarea {
                font-size:16px;
                display:block;
                width:100%;
                height:100%;
                padding:5px 10px;
                background:none;
                background-image:none;
                border:1px solid #00326380;
                color:#00326380;
                border-radius:0;
                transition:border-color .25s ease, box-shadow .25s ease;
                &:focus {
                    outline:0;
                    border-color:#1ab188;
                }
            }

            textarea {
                border:2px solid #a0b3b0;
                resize: vertical;
            }

            .field-wrap {
                position:relative;
                margin-bottom:40px;
            }

            .top-row::after {

                content: "";
                display: table;
                clear: both;

            }

            .button {
                border:0;
                outline:none;
                border-radius:0;
                padding:10px 0;
                font-size:20px;
                font-weight:600;
                text-transform:uppercase;
                letter-spacing:.1em;
                background:#003263;
                color:#ffffff;
                transition:all.5s ease;
                -webkit-appearance: none;
                &:hover, &:focus {
                    background:darken(#1ab188,5%);
                }
            }
            #btnRegister {
                text-align: center;
                color: #fff;
                cursor: pointer;
            }

            .button-block {
                display:block;
                width:100%;
            }

            .forgot {
                margin-top:0px;
                text-align:right;
            }
            .tab-group .active a {

                background: #003263;
                color: #ffffff;

            }
            .tab-group li a {

                display: block;
                text-decoration: none;
                padding: 10px 15px;
                background: rgb(228, 228, 228);
                color: #003263;
                font-size: 20px;
                float: left;
                width: 50%;
                text-align: center;
                cursor: pointer;
                transition: .5s ease;

            }
            .tab-group {

                list-style: none;
                padding: 0;
                margin: 0 0 25px 0;

            }
            .tab-group::after {

                content: "";
                display: table;
                clear: both;

            }
            body {

                font-family: 'Titillium Web', sans-serif;

            }
            .top-row > div {

                float: left;
                width: 48%;
                margin-right: 4%;

            }
            .field-wrap {

                position: relative;
                margin-bottom: 25px;

            }
            .top-row > div:last-child {

                margin: 0;

            }

            .or {
                position: relative;
                width: 100%;
                height: 1px;
                margin: 1rem 0 1.4rem;
                background-color: #fff;
            }
            .or::after {
                content: 'OR';
                display: block;
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);
                background-color: #c0beb8;
                padding: 0 25px;
                font-size: 10px;
                z-index: 5;
                color: #fff;
            }
            .svg-inline--fa.fa-w-9 {

                width: .5625em;

            }
            .svg-inline--fa {

                display: inline-block;
                font-size: inherit;
                height: 1em;
                overflow: visible;
                vertical-align: -.125em;

            }
            .btn-group-lg > .btn, .btn-lg {
                padding: 0.7rem 2rem;
            }



            .tab-content > div#forgot-password {
                display: block;
            }
            #forgot-password p {
                margin-bottom: 0;
                padding: 20px 25px 0px;
                color: #3a5c7b;
            }




            .upload-pro-pic {

                text-align: center;
                margin: 30px auto;
                width: 243px;

            }
            .upload-span {

                height: 243px;
                width: 243px;
                padding-top: 7%;
            }
        </style>

    </head>
    <body>
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
                                <a class="button button-block" id="upload-pro-pic" name="upload-pro-pic"/>Upload Profile Picture</a>

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
                            <form class="content" id="form-profile-picture">
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

                                <a class="button button-block" id="upload-cover-pic" name="upload-pro-pic"/>Upload Cover Picture</a>

                            </form>
                        </div>
                    </div><!-- tab-content -->
                </div> <!-- /form -->
            </div>
        </div>
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/js/add-member.js" type="text/javascript"></script>
        <script src="js/js/add-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-cover-picture.js" type="text/javascript"></script>
        <script>
            $('.form').find('input, textarea').on('keyup blur focus', function (e) {
                var $this = $(this),
                        label = $this.prev('label');
                if (e.type === 'keyup') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.addClass('active highlight');
                    }
                } else if (e.type === 'blur') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.removeClass('highlight');
                    }
                } else if (e.type === 'focus') {
                    if ($this.val() === '') {
                        label.removeClass('highlight');
                    } else if ($this.val() !== '') {
                        label.addClass('highlight');
                    }
                }
            });
            $('.tab a').on('click', function (e) {
                e.preventDefault();
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
                target = $(this).attr('href');
                $('.tab-content > div').not(target).hide();
                $(target).fadeIn(600);
            });
        </script>
    </body>
</html>
