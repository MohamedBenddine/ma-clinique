<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['damsid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Ma Clinique- Dashboard</title>
    
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
            
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <?php 
                         $docid=$_SESSION['damsid'];;
$sql ="SELECT * from  tblappointment where Status is null && Doctor=:docid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':docid', $docid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totnewapt=$query->rowCount();
?>
                        <div class="pull-left">
                            <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($totnewapt);?></span></h3>
                            <small class="text-color">Total New Appointment</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
                    </div>
                    <footer class="widget-footer bg-warning">
                        <a href="new-appointment.php"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <?php 
                         $docid=$_SESSION['damsid'];;
$sql ="SELECT * from  tblappointment where Status='Approved' && Doctor=:docid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':docid', $docid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totappapt=$query->rowCount();
?>
                        <div class="pull-left">
                            <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($totappapt);?></span></h3>
                            <small class="text-color">Total Approved</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-ban"></i></span>
                    </div>
                    <footer class="widget-footer bg-success">
                        <a href="approved-appointment.php"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <div class="pull-left">
                            <?php 
                         $docid=$_SESSION['damsid'];;
$sql ="SELECT * from  tblappointment where Status='Cancelled' && Doctor=:docid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':docid', $docid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totncanapt=$query->rowCount();
?>
                            <h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($totncanapt);?></span></h3>
                            <small class="text-color">Cancelled Appointment</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-unlock-alt"></i></span>
                    </div>
                    <footer class="widget-footer bg-danger">
                        <a href="cancelled-appointment.php"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">

                        <div class="pull-left">
                            <?php 
                         $docid=$_SESSION['damsid'];;
$sql ="SELECT * from  tblappointment where Doctor=:docid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':docid', $docid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totapt=$query->rowCount();
?>
                            <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($totapt);?></span></h3>
                            <small class="text-color">Total Appointment</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                    </div>
                    <footer class="widget-footer bg-primary">
                        <a href="all-appointment.php"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[5,4,3,5,2],{ type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
        </div><!-- .row -->

        <!-- Second Row with Today's Appointments -->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <?php 
                        $docid = $_SESSION['damsid'];
                        $today = date('Y-m-d');
                        $sql = "SELECT * FROM tblappointment WHERE Doctor=:docid AND DATE(AppointmentDate)=:today AND Status='Approved'";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':docid', $docid, PDO::PARAM_STR);
                        $query->bindParam(':today', $today, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $todayApt = $query->rowCount();
                        ?>
                        <div class="pull-left">
                            <h3 class="widget-title text-info"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($todayApt);?></span></h3>
                            <small class="text-color">Today's Appointments</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-calendar-o"></i></span>
                    </div>
                    <footer class="widget-footer bg-info">
                        <a href="today-appointment.php"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[3,5,4,6,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <?php 
                        $docid = $_SESSION['damsid'];
                        $tomorrow = date('Y-m-d', strtotime('+1 day'));
                        $sql = "SELECT * FROM tblappointment WHERE Doctor=:docid AND DATE(AppointmentDate)=:tomorrow AND Status='Approved'";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':docid', $docid, PDO::PARAM_STR);
                        $query->bindParam(':tomorrow', $tomorrow, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $tomorrowApt = $query->rowCount();
                        ?>
                        <div class="pull-left">
                            <h3 class="widget-title text-purple"><span class="counter" data-plugin="counterUp"><?php echo htmlentities($tomorrowApt);?></span></h3>
                            <small class="text-color">Tomorrow's Appointments</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <footer class="widget-footer" style="background-color: #9C27B0;">
                        <a href="tomorrow-appointment.php" style="color: white;"><small> View Detail</small></a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,5,3,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
        </div><!-- .row -->

        <!-- Today's Appointments Details Section -->
        <?php if($todayApt > 0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title">
                            <i class="fa fa-calendar text-info"></i> Today's Appointments Schedule
                        </h4>
                    </header>
                    <hr class="widget-separator">
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment Number</th>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Appointment Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $docid = $_SESSION['damsid'];
                                    $today = date('Y-m-d');
                                    $sql = "SELECT * FROM tblappointment WHERE Doctor=:docid AND DATE(AppointmentDate)=:today AND Status='Approved' ORDER BY AppointmentTime ASC";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':docid', $docid, PDO::PARAM_STR);
                                    $query->bindParam(':today', $today, PDO::PARAM_STR);
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
                                        <td>
                                            <span class="badge badge-info">
                                                <?php echo htmlentities(date('h:i A', strtotime($row->AppointmentTime))); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="view-appointment-detail.php?editid=<?php echo htmlentities ($row->ID);?>" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i> View Details
                                            </a>
                                            <a href="chat-dashboard.php?appointment_id=<?php echo htmlentities ($row->ID);?>" 
                                               class="btn btn-success btn-sm">
                                                <i class="fa fa-comments"></i> Chat
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        $cnt++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
        
    </section><!-- #dash-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
 <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

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
    <script src="libs/bower/moment/moment.js"></script>
    <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>

    <style>
        .text-purple {
            color: #9C27B0 !important;
        }
        
        .badge-info {
            background-color: #17a2b8;
            color: white;
            padding: 0.5em 0.8em;
            border-radius: 15px;
        }
        
        .btn-sm {
            margin-right: 5px;
        }
        
        .widget-title i {
            margin-right: 8px;
        }
    </style>
</body>
</html>
<?php }  ?>