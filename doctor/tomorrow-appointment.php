<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ma Clinique | Tomorrow's Appointments</title>
    
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css assets/css/app.min.css -->
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
    <section class="app-content">
        <div class="row">
            <!-- DOM dataTable -->
            <div class="col-md-12">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title" style="color: #9C27B0;">
                            <i class="fa fa-clock-o"></i> Tomorrow's Appointments - <?php echo date('F d, Y', strtotime('+1 day')); ?>
                        </h4>
                    </header><!-- .widget-header -->
                    <hr class="widget-separator">
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment Number</th>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Appointment Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $docid = $_SESSION['damsid'];
                                    $tomorrow = date('Y-m-d', strtotime('+1 day'));
                                    $sql = "SELECT * FROM tblappointment WHERE Doctor=:docid AND DATE(AppointmentDate)=:tomorrow AND Status='Approved' ORDER BY AppointmentTime ASC";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':docid', $docid, PDO::PARAM_STR);
                                    $query->bindParam(':tomorrow', $tomorrow, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if($query->rowCount() > 0) {
                                        foreach($results as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row->AppointmentNumber); ?></td>
                                        <td><?php echo htmlentities($row->Name); ?></td>
                                        <td><?php echo htmlentities($row->MobileNumber); ?></td>
                                        <td><?php echo htmlentities($row->Email); ?></td>
                                        <td>
                                            <span class="badge badge-purple">
                                                <?php echo htmlentities(date('h:i A', strtotime($row->AppointmentTime))); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="view-appointment-detail.php?editid=<?php echo htmlentities($row->ID);?>" 
                                               class="btn btn-primary btn-xs" title="View Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="chat-dashboard.php?appointment_id=<?php echo htmlentities($row->ID);?>" 
                                               class="btn btn-success btn-xs" title="Start Chat">
                                                <i class="fa fa-comments"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        $cnt++;
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-warning">
                                                <i class="fa fa-info-circle"></i> No appointments scheduled for tomorrow
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .widget-body -->
                </div><!-- .widget -->
            </div><!-- END column -->
        </div><!-- .row -->
    </section><!-- .app-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

<!-- APP CUSTOMIZER -->
<?php include_once('includes/customizer.php');?>

<!-- build:js assets/js/core.min.js -->
<script src="libs/bower/jquery/dist/jquery.js"></script>
<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js assets/js/app.min.js -->
<script src="assets/js/library.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/app.js"></script>
<!-- endbuild -->

<!-- Data table -->
<script src="libs/bower/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="libs/bower/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#default-datatable').DataTable({
        "order": [[ 5, "asc" ]], // Sort by appointment time
        "pageLength": 25
    });
});
</script>

<style>
.badge-purple {
    background-color: #9C27B0;
    color: white;
    padding: 0.4em 0.6em;
    border-radius: 12px;
    font-size: 0.85em;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
    padding: 0.4em 0.6em;
    border-radius: 12px;
    font-size: 0.85em;
}

.btn-xs {
    padding: 0.25rem 0.4rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
    margin-right: 5px;
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
    padding: 20px;
    margin: 20px 0;
    border-radius: 5px;
}

.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
    padding: 20px;
    margin: 20px 0;
    border-radius: 5px;
}
</style>

</body>
</html>
<?php } ?>