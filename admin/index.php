<?php
session_start();
if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
	if ($_SESSION['level'] == 0) {
	include('../connection/config.php');
	$sql_detail = "SELECT * FROM visit.user WHERE id = $id";
	$query_detail = mysqli_query($conn,$sql_detail);
	$row_detail = mysqli_fetch_row($query_detail);
	$fname = $row_detail[3];
	$lname = $row_detail[4];
?>
<?php include('header.php'); ?>
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
    <?php include('sidebar.php'); ?>
    <!-- BEGIN PAGE -->
    <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#"><i class="icon-home"></i> Dashboard</a><span class="divider-last">&nbsp;</span>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                	<div class="widget">
					    <div class="widget-title">
					        <h4><i class="icon-bar-chart"></i>กราฟแสดงข้อมูล</h4>
					    </div>
					    <div class="widget-body">
					        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
					    </div>
					</div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<?php include('footer.php'); ?>
<?php
	}
	else
	{
		header("location: ../index.php"); //if exits not admin
	}
}
else{
	header("location: ../login.php"); // if exits not have session
}
?>