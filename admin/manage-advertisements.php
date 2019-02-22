<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ADVERTISEMENT = new Advertisement($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>Manage Advertisements || Sublime Web Manager</title>
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
                                    Manage Advertisements
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-advertisement.php">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Created At</th> 
                                            <th>Title</th> 
                                            <th>Member</th> 
                                            <th>Group</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $ADVERTISEMENT = Advertisement::all();
                                        if (count($ADVERTISEMENT) > 0) {
                                            foreach ($ADVERTISEMENT as $key => $advertisement) {
                                                $MEM = new Member($advertisement['member']);
                                                $GROUP = new Group($advertisement['group_id']);
                                                ?>
                                                <tr id="row_<?php echo $advertisement['id']; ?>">
                                                    <td><?php echo $advertisement['id']; ?></td> 

                                                    <td><?php echo substr($advertisement['created_at'],0,10); ?></td>
                                                    <td><?php echo $advertisement['title']; ?></td>
                                                    <td><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></td>
                                                    <td><?php echo $GROUP->name; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($advertisement['status'] == 1) {
                                                            ?>
                                                            <i class="glyphicon glyphicon-check op-link btn btn-sm btn-info" title="Publish"></i>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <i class="glyphicon glyphicon-unchecked op-link btn btn-sm btn-info" title="Unpublish"></i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td> 
                                                        <a href="edit-advertisement.php?id=<?php echo $advertisement['id']; ?>" class="op-link btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i>
                                                        </a>

                                                        <?php
                                                        if ($advertisement['is_suspend'] == 0) {
                                                            ?>
                                                        <a href="#" class="suspend-advertisement btn btn-sm btn-warning" data-id="<?php echo $advertisement['id']; ?>" title="Active">
                                                            <i class="material-icons">stop</i>
                                                        </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" class="remove-ad-suspend btn btn-sm btn-warning" data-id="<?php echo $advertisement['id']; ?>"  title="Suspended">
                                                            <i class="material-icons">play_circle_outline</i>
                                                        </a>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($advertisement['status'] == 0) {
                                                            ?>
                                                            <a href="#" class="publish-advertisement btn btn-sm btn-info" data-id="<?php echo $advertisement['id']; ?>"  title="Unpublished">
                                                            <i class="glyphicon glyphicon-eye-close" data-type="cancel"></i>
                                                        </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" class="unpublish-advertisement btn btn-sm btn-info" data-id="<?php echo $advertisement['id']; ?>"  title="Published">
                                                            <i class="glyphicon glyphicon-eye-open" data-type="cancel"></i>
                                                        </a>
                                                            <?php
                                                        }
                                                        ?>

                                                        <a href="#" class="delete-advertisement btn btn-sm btn-danger" data-id="<?php echo $advertisement['id']; ?>">
                                                            <i class="glyphicon glyphicon-trash" data-type="cancel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?> 
                                            <tr>
                                                <td colspan="3"><b style="padding-left: 15px;">No advertisements in the database.</b> </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Created At</th> 
                                            <th>Title</th> 
                                            <th>Member</th> 
                                            <th>Group</th>
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
        <script src="delete/js/advertisement.js" type="text/javascript"></script>
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
        <script src="js/suspend-advertisement.js" type="text/javascript"></script>
        <script src="js/publish-advertisement.js" type="text/javascript"></script>
    </body>
</html>