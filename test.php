<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Typed.js - Type your heart out</title>
        <script src="plugins/type-js/js/typed.min.js" type="text/javascript"></script>
        <script src="plugins/type-js/js/demos.js"></script>
        <!--<link href="plugins/type-js/css/demos.css" rel="stylesheet"/>-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>-->
        <script>hljs.initHighlightingOnLoad();</script>
    </head>
    <style>
       

        .nav {
            height: 50px;
            width: 100%;
            background-color: #003263;
            position: relative;
            border-bottom: 1px solid #fff;
        }

        .nav > .nav-header {
            display: inline;
        }

        .nav > .nav-header > .nav-title {
            display: inline-block;
            font-size: 22px;
            color: #fff;
            padding: 7px 10px 6px 10px;
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
            display: inline-flex;
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
        .nav-title.logo img {
            width: 150px;
        }
        .nav-links a img {
            width: 25px;
            margin-right: 15px;
        }
        .nav-links a span {
            font-weight: 600;
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
                border-bottom: 1px solid #fff;
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
                background-color: #003263;
                height: 0px;
                transition: all 0.3s ease-in;
                overflow-y: hidden;
                top: 50px;
                left: 0px;
            }
            .nav > .nav-links > a {
                display: inline-flex    ;
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

    <body>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                <a href="./"><img src="img/icon/header-icon/home.png" alt=""/>Home</a>
                <a href="all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />Advertisements</a>
                <a href="groups.php"><img src="img/icon/header-icon/group.png" alt=""  />Groups</a>
                <a href="member/"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>
                <a href="member/friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests</a>
                <a href="member/member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>

                <?php
                if (isset($_SESSION['id'])) {
                    ?>
                    <a href="member/profile.php">
                        <?php
                        if ($MEMBER->profilePicture) {
                            ?>
                            <img alt="author" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        } else {
                            ?>
                            <img alt="author" src="upload/member/member.png" class="avatar" id="profile_pic2">
                            Profile
                            <?php
                        }
                        ?>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="member/login.php">
                        <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                        Sign In
                    </a>
                    <?php
                }
                ?>
                 <a href="member/create-advertisement.php?back=ad">
                    <button class="btn-post">
                        <i class="icon fa fa-thumbtack"></i>
                        Post Your Ad
                    </button>
                </a>
            </div>
        </div>
    </body>

</html>
