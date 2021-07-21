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
					        <h4><i class="icon-bar-chart"></i>ลบ Visit</h4>
					    </div>
					    <div class="widget-body">
                            <div id="show_visit"></div>
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
<script>
    $(document).ready(function(){
        fetch_visit();
    });
    function fetch_visit(){
        $.ajax({
            url:'sql_fetch_visit.php',
            type:'POST',
            dataType:'HTML',
            success:function(data){
                $('#show_visit').html(data);
            }
        });
    }
    $(document).on('click','.switch',function(){
        var id_visit = $(this).attr('data-id');
        var id_status = $('#'+id_visit).val();
        $.ajax({
            url:'upstat.php',
            type:'POST',
            data:{idv:id_visit,ids:id_status},
            success:function(data){
                if (data.status == 1) {
                    fetch_visit();
                    alertify.success(data.message);
                }else{
                    alertify.error(data.message);
                }
            }
        });
    });
</script>
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