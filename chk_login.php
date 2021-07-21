<?php
session_start();
header('Content-Type: application/json');
$cid = $_GET['cid'];

if ($cid !='') {
	include('connection/config.php');
	$sql="SELECT * FROM user Where CID='$cid'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_row($query);
		$level = $row[7]; // Query level  
		$_SESSION["level"] = $row[7]; // session level  
		$_SESSION["id"] = $row[0]; // Query id
		if ($level == 0) {
			$data['link'] = "admin/index.php";
		}
		else{
			$data['link'] = "index.php";
		}
	}
	else{
		$data['status'] = "1";
		$data['msg'] = '<p style="color:#fff">กรุณาติดต่อ Admin เพื่อลงทะเบียนใช้งาน</p>';
	}
}
else{
	$data['status'] = "1";
	$data['msg'] = '<p style="color:#fff">กรอกเลขประจำตัวประชาชนนำเด้อ</p>';
}
echo json_encode($data);
?>