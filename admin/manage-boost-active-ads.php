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
                                    Manage Boost Active Advertisements
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
                                            <th>Ad ID</th>
                                            <th>Active Date</th> 
                                            <th>Title</th> 
                                            <th>Member</th> 
                                            <th>Contact No</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $ADVERTISEMENT = Advertisement::getBoostActiveAds();
                                        $i = 1;
                                        if (count($ADVERTISEMENT) > 0) {
                                            foreach ($ADVERTISEMENT as $key => $advertisement) {
                                                $MEM = new Member($advertisement['member']);
                                                ?>
                                                <tr id="row_<?php echo $advertisement['id']; ?>">
                                                    <td><?php echo $i; ?></td> 
                                                    <td><?php echo $advertisement['id']; ?></td> 
                                                    <td><?php echo substr($advertisement['boost_activated_date'], 0, 10); ?></td>
                                                    <td><?php echo $advertisement['title']; ?></td>
                                                    <td><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></td>
                                                    <td><?php echo $MEM->phoneNumber; ?></td>
                                                    <td> 
                                                        <a href="https://www.flip.lk/view-advertisement.php?id=<?php echo $advertisement['id']; ?>" target="_blank" class="op-link btn btn-sm btn-info"  title="View Ad">
                                                            <i class="glyphicon glyphicon-eye-open" data-type="cancel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
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
                                            <th>Ad ID</th>
                                            <th>Requested Date</th> 
                                            <th>Title</th> 
                                            <th>Member</th> 
                                            <th>Contact No</th>
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