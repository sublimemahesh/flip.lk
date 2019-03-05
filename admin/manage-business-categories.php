<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>Manage Business Categories || Sublime Web Manager</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon" >

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" >

        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet" >

        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" >

        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet">

        <!-- JQuery DataTable Css -->
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet"  >
        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet" >

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="css/themes/all-themes.css" rel="stylesheet"  >
    </head>
    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid">
                <?php
                $vali = new Validator();
                $vali->show_message();
                ?>
                <!-- Manage tour -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Business Categories
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-business-category.php">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <!-- <div class="table-responsive">-->
                                <div class="row clearfix">
                                    <?php
                                    $categories = BusinessCategory::all();
                                    if (count($categories) > 0) {
                                        foreach ($categories as $key => $category) {
                                            ?>
                                            <div class="col-md-3"  id="div_<?php echo $category['id']; ?>">
                                                <div class="photo-img-container icon-img">   
                                                    <img src="../upload/business-category/<?php echo $category['image_name']; ?>" class="img-responsive ">
                                                </div>
                                                <div class="img-caption">       
                                                    <p class="maxlinetitle "><?php echo $category['name']; ?></p>
                                                    <div class="d">
                                                        <a href="edit-business-category.php?id=<?php echo $category['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a>
                                                        <a href="#" class="delete-business-category" data-id="<?php echo $category['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
                                                        <a href="arrange-business-categories.php?id=<?php echo $category['id']; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>
                                                        <a href="manage-business-sub-categories.php?id=<?php echo $category['id']; ?>">  <button class="glyphicon glyphicon-tasks sub-category-btn"></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?> 
                                        <b style="padding-left: 15px;">No business categories  in the database.</b> 
                                        <?php
                                    }
                                    ?> 
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Manage District -->

        </section>
        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/business-category.js" type="text/javascript"></script>
    </body>

</html>

