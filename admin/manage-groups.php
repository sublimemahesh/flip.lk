<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>Manage Groups || Sublime Web Manager</title>
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
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
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
                                    Manage Groups
                                </h2>
<!--                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-member.php">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </li>
                                </ul>-->
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Created At</th> 
                                            <th>Name</th> 
                                            <th>Member</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $GROUPS = Group::all();
                                        
                                        if (count($GROUPS) > 0) {
                                            
                                            foreach ($GROUPS as $key => $group) {
                                                
                                                $MEMBER = new Member($group['member']);
                                                $CATEGORY = new BusinessCategory($group['category']);
                                                
                                                ?>
                                                <tr id="row_<?php echo $group['id']; ?>">
                                                    <td><?php echo $group['id']; ?></td> 

                                                    <td><?php echo $group['created_at']; ?></td>
                                                    <td><?php echo $group['name']; ?></td>
                                                    <td><?php echo $MEMBER->firstName . ' ' . $MEMBER->lastName; ?></td>
                                                     <td><?php echo $CATEGORY->name; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($group['status'] == 1) {
                                                            ?>
                                                            <i class="glyphicon glyphicon-check op-link btn btn-sm btn-info" title="Active"></i>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <i class="glyphicon glyphicon-unchecked op-link btn btn-sm btn-info" title="Inactive"></i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td> 
                                                        <a href="edit-group.php?id=<?php echo $group['id']; ?>" class="op-link btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i>
                                                        </a>
                                                        <a href="manage-group-members.php?id=<?php echo $group['id']; ?>" class="op-link btn btn-sm btn-warning"><i class="glyphicon glyphicon-user"></i>
                                                        </a>
                                                        <?php
                                                        if ($group['is_suspend'] == 0) {
                                                            ?>
                                                        <a href="#" class="suspend-group btn btn-sm btn-warning" data-id="<?php echo $group['id']; ?>" title="Active">
                                                            <i class="material-icons">stop</i>
                                                        </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" class="remove-ad-suspend btn btn-sm btn-warning" data-id="<?php echo $group['id']; ?>"  title="Suspended">
                                                            <i class="material-icons">play_circle_outline</i>
                                                        </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($group['status'] == 0) {
                                                            ?>
                                                            <a href="#" class="publish-group btn btn-sm btn-info" data-id="<?php echo $group['id']; ?>"  title="Unpublished">
                                                            <i class="glyphicon glyphicon-eye-close" data-type="cancel"></i>
                                                        </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" class="unpublish-group btn btn-sm btn-info" data-id="<?php echo $group['id']; ?>"  title="Published">
                                                            <i class="glyphicon glyphicon-eye-open" data-type="cancel"></i>
                                                        </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <a href="#" class="delete-group btn btn-sm btn-danger" data-id="<?php echo $group['id']; ?>">
                                                            <i class="glyphicon glyphicon-trash" data-type="cancel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?> 
                                            <tr>
                                                <td colspan="3"><b style="padding-left: 15px;">No groups in the database.</b> </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Created At</th> 
                                            <th>Name</th> 
                                            <th>Member</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map"></div>
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
        <script src="delete/js/group.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/suspend-group.js" type="text/javascript"></script>
        <script src="js/publish-group.js" type="text/javascript"></script>
    </body>
</html>