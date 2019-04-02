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
           * {
  box-sizing: border-box;
}

body {
  margin: 0px;
  font-family: 'segoe ui';
}

.nav {
  height: 50px;
  width: 100%;
  background-color: #4d4d4d;
  position: relative;
}

.nav > .nav-header {
  display: inline;
}

.nav > .nav-header > .nav-title {
  display: inline-block;
  font-size: 22px;
  color: #fff;
  padding: 10px 10px 10px 10px;
}

.nav > .nav-btn {
  display: none;
}

.nav > .nav-links {
  display: inline;
  float: right;
  font-size: 18px;
}

.nav > .nav-links > a {
  display: inline-block;
  padding: 13px 10px 13px 10px;
  text-decoration: none;
  color: #efefef;
}

.nav > .nav-links > a:hover {
  background-color: rgba(0, 0, 0, 0.3);
}

.nav > #nav-check {
  display: none;
}

@media (max-width:600px) {
  .nav > .nav-btn {
    display: inline-block;
    position: absolute;
    right: 0px;
    top: 0px;
  }
  .nav > .nav-btn > label {
    display: inline-block;
    width: 50px;
    height: 50px;
    padding: 13px;
  }
  .nav > .nav-btn > label:hover {
    background-color: rgba(0, 0, 0, 0.3);
  }
  .nav > .nav-btn > label > span {
    display: block;
    width: 25px;
    height: 10px;
    border-top: 2px solid #eee;
  }
  .nav > .nav-links {
    position: absolute;
    display: block;
    width: 100%;
    background-color: #333;
    height: 0px;
    transition: all 0.3s ease-in;
    overflow-y: hidden;
    top: 50px;
    left: 0px;
  }
  .nav > .nav-links > a {
    display: block;
    width: 100%;
  }
  .nav > #nav-check:not(:checked) + .nav-links {
    height: 0px;
  }
  .nav > #nav-check:checked + .nav-links {
    height: calc(100vh - 50px);
    overflow-y: auto;
  }
}
        </style>

    </head>
    <body>
        <div class="nav">
            <div class="nav-header">
                <div class="nav-title logo">
                    <img src="img/logo/logo.jpg" alt=""/>
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <input type="checkbox" id="nav-check">
            <div class="nav-links">
                <a href="../"><img src="img/icon/header-icon/home.png" alt=""/>Home</a>
                <a href="../all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />Advertisements</a>
                <a href="../groups.php"><img src="img/icon/header-icon/group.png" alt=""  />Groups</a>
                <a href="./"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>
                <a href="friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests</a>
                <a href="member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>

                <?php
                if (isset($_SESSION['id'])) {
                    ?>
                    <a href="profile.php">
                        <?php
                        if ($MEMBER->profilePicture) {
                            ?>
                            <img alt="author" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        } else {
                            ?>
                            <img alt="author" src="../upload/member/member.png" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        }
                        ?>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="login.php">
                        <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                        Sign In
                    </a>
                    <?php
                }
                ?>
                 <a href="create-advertisement.php?back=ad">
                    <button class="btn-post">
                        <i class="icon fa fa-thumbtack"></i>
                        Post Your Ad
                    </button>
                </a>
            </div>
        </div>
    </body>
</html>
