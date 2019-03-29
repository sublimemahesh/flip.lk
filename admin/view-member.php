<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$GROUP = new Group($id);
$MEMBER = new Member($GROUP->member);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>View Group Member || Sublime Web Manager</title>
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
                                    View Member
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="manage-group-members.php?id=<?php echo $id; ?>">
                                            <i class="material-icons">list</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class ="col-sm-7 ">
                                        <table class="table table-bordered table-striped table-hover viewbookingtable">

                                            <tr>
                                                <th>Name</th>
                                                <td>  <?php echo $MEMBER->firstName . ' ' . $MEMBER->lastName; ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Email </th>
                                                <td> <?php echo $MEMBER->email; ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number</th>
                                                <td><?php echo $MEMBER->phoneNumber; ?></td>
                                            </tr>
                                            <tr>
                                                <th>District</th>
                                                <td id="district"></td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td id="city"></td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td> <?php echo $MEMBER->address; ?> </td>
                                            </tr>
                                            <tr>
                                                <th>DOB</th>
                                                <td> <?php echo $MEMBER->dob; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Occcupation</th>
                                                <td> <?php echo $MEMBER->occupation; ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td> <?php echo ucwords($MEMBER->gender); ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Civil Status</th>
                                                <td> <?php
                                                    if ($MEMBER->civilStatus == 'married') {
                                                        echo 'Married';
                                                    } else {
                                                        echo 'Not Married';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td> <?php echo $MEMBER->aboutMe; ?> </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td> <?php
                                                    if ($MEMBER->status == '1') {
                                                        echo 'Active';
                                                    } else {
                                                        echo 'Inactive';
                                                    }
                                                    ?> </td>
                                            </tr>
                                        </table>
                                        <a href="manage-group-members.php?id=<?php echo $id; ?>" class="btn btn-info">Back</a>
                                    </div>

                                    <div class ="col-sm-5 ">
                                        <table class="table profil-cover-img-table">

                                            <tr>
                                                <th>Profile Picture</th>
                                                <td> 
                                                    <img class="img-circle img-responsive pro-pic" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt=""/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Cover Picture </th>
                                                <td>
                                                    <img class="img-responsive cover-pic" src="../upload/member/cover-picture/thumb/<?php echo $MEMBER->coverPicture; ?>" alt=""/>
                                                </td>
                                            </tr>
                                        </table>


                                    </div>


                                    <input type="hidden" id="autocomplete" value="<?php echo $MEMBER->district; ?>">
                                    <input type="hidden" id="autocomplete2" value="<?php echo $MEMBER->city; ?>">
                                    <div id="map"></div>
                                </div>
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
    <script src="delete/js/business-sub-category.js" type="text/javascript"></script>
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
    <script>
        // Retrieve Details from Place_ID
        function initMap() {
            setTimeout(function () {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.866, lng: 151.196},
                    zoom: 15
                });

                var infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                var place_id = $('#autocomplete').val();
                var place_id2 = $('#autocomplete2').val();

                service.getDetails({
                    placeId: place_id
                }, function (place, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        $('#district').html(place.name);
                    }
                });
                service.getDetails({
                    placeId: place_id2
                }, function (place2, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                        $('#city').html(place2.name);
                    }
                });
            }, 1000);
        }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initMap"
    async defer></script>
</body>

</html>