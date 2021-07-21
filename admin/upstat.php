<?php
header('Content-Type: application/json');
include("../connection/config.php");
$ids = $_POST['ids'];
$idv = $_POST['idv'];

$sql = "UPDATE `visit`.`detail_visit` SET  `status` =  $ids,
`edit_time` =  CURRENT_TIMESTAMP WHERE  `detail_visit`.`id` = $idv";
$query = mysqli_query($conn, $sql);

if ($query) {
	$data['status']='1';
	$data['message'] = '<p style="color:#fff;font-size: 16px;"><i class="icon-ok-sign"></i> บันทึกข้อมูลเรียบร้อย</p>';
}
else
{
	$data['status']='0';
	$data['message'] = '<p style="color:#fff"><i class="icon-remove-sign"></i> ไม่สามารถบันทึกข้อมูลได้:)</p>';
}
echo json_encode($data);
?>