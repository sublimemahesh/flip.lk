<?php
include_once(dirname(__FILE__) . '/class/include.php');
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <link href="css/flaticon.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.2.1.js"></script>
        <style>
            .sidebar {
                float: left;
                margin-right: -100%;
                max-width: 413px;
                position: relative;
                width: 29.4118%;
                background-color: #fff;
            }
            .secondary {
                background-color: transparent;
                box-shadow: none;
                display: block;
                margin: 0;
                padding: 0;
            }
            .main-navigation {
                font-size: 1.6rem;
                margin: 0 20% 20%;
                line-height: 1.5;
            }
            nav {
                display: block;
            }
            .main-navigation ul {
                border-top: 1px solid rgba(51, 51, 51, 0.1);
                border-bottom: 1px solid rgba(51, 51, 51, 0.1);
            }
            .main-navigation ul {
                list-style: none;
                margin: 0;
            }
            .main-navigation .nav-menu > ul > li:first-child, .main-navigation .nav-menu > li:first-child {
                border-top: 0;
            }
            .main-navigation li {
                position: relative;
            }
            #menu-feature {
                font-weight: bold;
            }
            button {
                color: #222;
                font-family: "Open Sans", serif;
                font-size: 15px;
                font-size: 1.5rem;
                line-height: 1.6;
            }
            .main-navigation ul ul {
                margin-left: 1em;
            }
            .main-navigation ul ul {
                border-top: 0;
                border-bottom: 0;
            }
            .main-navigation ul {
                list-style: none;
                margin: 0;
                margin-left: 0px;
            }
            ul {
                border: 0;
                border-top-color: currentcolor;
                border-top-style: none;
                border-top-width: 0px;
                border-bottom-color: currentcolor;
                border-bottom-style: none;
                border-bottom-width: 0px;
                font-family: inherit;
                font-size: 100%;
                font-style: inherit;
                font-weight: inherit;
                margin: 0;
                outline: 0;
                padding: 0;
                vertical-align: baseline;
            }
            .main-navigation li {
                border-top: 1px solid #eaeaea;
                border-top: 1px solid rgba(51, 51, 51, 0.1);
                position: relative;
                display: block;
                padding: 5px 0;
                position: relative;
                text-decoration: none;
            }
            #menu-feature {
                font-size: 16px;
            }
            #menu-feature .category a {
                font-size: 16px;
                font-weight: 600;
                color: #003263;
            }
            .cat-dropdown {
                z-index: 9999;
                position: relative;
                right: 0px;
                float: right;
            }
            .hidden {
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="sidebar" class="sidebar" style="position: fixed;">


            <div id="secondary" class="secondary">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <div class="menu-feature-container">
                        Category
                        <ul id="menu-feature" class="nav-menu">
                            <li id="menu-item-1"  class="menu-item category collapsible"><a href="#">Layout</a>
                                <i class="icon-1 fa fa-angle-down cat-dropdown" id1="menu-item-1" times="0"></i>
                                <ul class="sub-menu menu-item-1 hidden">
                                    <li id="sub-category-" class="menu-item "><a href="#">Grid</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#" aria-current="page">Pinterest</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Masonry</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Timeline</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">One and others</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Collapsible list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Scrollable list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Glossary list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#" target="_blank">Multiple Views on page</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Multiple post types on View</a></li>
                                </ul>
                            </li>
                            <li id="menu-item-2" class="menu-item category collapsible"><a href="#">Layout2</a>
                                <i class="fa fa-angle-down cat-dropdown" id1="menu-item-2"></i>
                                <ul  class="sub-menu menu-item-2 hidden">
                                    <li id="sub-category-" class="menu-item "><a href="#">Grid</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#" aria-current="page">Pinterest</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Masonry</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Timeline</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">One and others</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Collapsible list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Scrollable list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Glossary list</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#" target="_blank">Multiple Views on page</a></li>
                                    <li id="sub-category-" class="menu-item"><a href="#">Multiple post types on View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav><!-- .main-navigation -->
            </div><!-- .secondary -->
        </div>
        <script>
            $(document).ready(function () {
                $(".cat-dropdown").click(function () {
                    var attr = $(this).attr("id1");
                    var times = $(this).attr("times");

                    if (times == 0) {
                        $("." + attr).removeClass("hidden");
                        $(this).attr("times", "1");
                        $(".icon-1").removeClass("fa-angle-down");
                        $(".icon-1").addClass("fa-angle-up");

                    } else {
                        $("." + attr).addClass("hidden");
                        $(this).attr("times", "0");
                        $(".icon-1").removeClass("fa-angle-up");
                        $(".icon-1").addClass("fa-angle-down");
                    }



                });
            });

        </script>
    </body>
</html>