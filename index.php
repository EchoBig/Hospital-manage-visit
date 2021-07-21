<?php
session_start();
if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];

	include('connection/config.php');
	$sql_detail = "SELECT * FROM visit.user WHERE id = $id";
	$query_detail = mysqli_query($conn,$sql_detail);
	$row_detail = mysqli_fetch_row($query_detail);
	$fname = $row_detail[3];
	$lname = $row_detail[4];
?>
<?php
  $sql_graph = "SELECT month(a.edit_date),count(*)
              FROM visit.detail_visit a
              WHERE a.edit_date != '0000-00-00' AND a.id_user = $id AND year(a.edit_date) = YEAR(CURDATE())
              GROUP BY year(a.edit_date),month(a.edit_date)";
  $query_graph = mysqli_query($conn,$sql_graph);
  while ($row_g = mysqli_fetch_array($query_graph)) {
    $r_count[$row_g[0]] = $row_g[1];
  }

for ($i=1; $i <= 12; $i++) { 
  if (!empty($r_count[$i])) {
    $val_graph[] = $r_count[$i];
  }else{
    $val_graph[] = 0;
  }
}

$dataPoints = array(
  array("label"=> "มกราคม", "y"=> $val_graph[0]),
  array("label"=> "กุมภาพันธ์", "y"=> $val_graph[1]),
  array("label"=> "มีนาคม", "y"=> $val_graph[2]),
  array("label"=> "เมษายน", "y"=> $val_graph[3]),
  array("label"=> "พฤษภาคม", "y"=> $val_graph[4]),
  array("label"=> "มิถุนายน", "y"=> $val_graph[5]),
  array("label"=> "กรกฎาคม", "y"=> $val_graph[6]),
  array("label"=> "สิงหาคม", "y"=> $val_graph[7]),
  array("label"=> "กันยายน", "y"=> $val_graph[8]),
  array("label"=> "ตุลาคม", "y"=> $val_graph[9]),
  array("label"=> "พฤศจิกายน", "y"=> $val_graph[10]),
  array("label"=> "ธันวาคม", "y"=> $val_graph[11]),
);
  
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
<?php include('footer.php');?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: "ข้อมูลการแจ้งลบ visit <?php echo (date('Y')+543) ?>",
    fontSize: 20
  },
  axisY: {
    title: "จำนวน",
    includeZero: false
  },
  data: [{
    type: "column",
    yValueFormatString: "#,##0\" visit\"",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
<?php
}
else{
	header("location: login.php");
}
?>