<?php 
include('connection/config.php');

date_default_timezone_set('Asia/Bangkok');
$No = date("Y") + 543;
$No2 = substr($No,2);
$sql2 = "SELECT * FROM `num_detail_visit`";
$aid = mysqli_query($conn,$sql2);
$cid = mysqli_num_rows($aid);
$lastid2 = $No2.'-'.$cid++;
$no_delete = $lastid2.'/'.date('hi');

echo $no_delete;
?>