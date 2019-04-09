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
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
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
            .comment-item1 {
                display: none;
            }
            .comment-reply-item {
                display: none;
            }
        </style>

    </head>
    <body>  
        <div class="container-fluid mtb-margin-top">
            <div class="row">
                <div class="col-md-12">
                    <div id="output"><?php include('post-and-get/ajax/get-ads-and-posts.php'); ?></div>
                    <div class="loader"><img src="loader.gif" /></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            $(window).scroll(function () {

                if ($(window).scrollTop() == ($(document).height() - $(window).height())) {

                    var total_pages = parseInt($("#total_pages").val());

                    var page = parseInt($("#page").val()) + 1;
                    if (page <= total_pages) {
                        load_more_data(page, total_pages);
                    }
                }
            });

            function load_more_data(page, total_pages) {
                $("#total_pages, #page").remove();
                $.ajax({
                    url: 'post-and-get/ajax/get-ads-and-posts.php',
                    type: "POST",
                    data: {page: page},
                    beforeSend: function () {
                        $(".loader").show();
                    },
                    complete: function () {

                        setTimeout(function () {
                            $('.loader').hide();
                            if (page == total_pages) {
                                $(".loader").html('... No more article! ...').show();
                            }
                        }, 3000);
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $("#output").append(data);
                        }, 3000);
                    },
                    error: function () {
                        $(".loader").html("No data found!");
                    }
                });
            }
        </script>
    </body>

</html>
