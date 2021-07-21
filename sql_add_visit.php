<?php
header('Content-Type: application/json');
include('connection/config.php');

$iduser = $_POST["id_user"];
$no_delete = $_POST["no_delete"];
$hn = isset($_POST['hn']) ? $_POST['hn'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$date_visit = isset($_POST['date_visit']) ? $_POST['date_visit'] : '';
$cause = isset($_POST['cause']) ? $_POST['cause'] : '';
$no_visit = isset($_POST['no_visit']) ? $_POST['no_visit'] : '';

function ConvDate($convD) {
    $GGyear = substr($convD, 7, 4) - 543;
    $GGmonth = substr($convD, 3, 2);
    $GGdate = substr($convD, 0, 2);
    $Buffdate = $GGyear."-".$GGmonth."-".$GGdate;
    return $Buffdate;
}

if (!empty($iduser)) {
	foreach ($hn as $key => $value) {
		if ($key == 0) {
			$sql = "INSERT INTO visit.num_detail_visit ( `No`, `Id_user`, `date_input`)VALUES ('$no_delete', '$iduser', CURRENT_TIMESTAMP);";
			mysqli_query($conn, $sql);
		}
		$sql_detail = "INSERT INTO visit.detail_visit (id_user,idnum_detail,hn,edit_date,visit,fname,mark,time,status) VALUES('$iduser','$no_delete','$hn[$key]','".ConvDate($date_visit[$key])."','$no_visit[$key]','$name[$key]','$cause[$key]',CURRENT_TIMESTAMP,'1')";
		$query = mysqli_query($conn,$sql_detail);
	}
	if ($query) {
		$data['status']='1';
		$data['message'] = '<p style="color:#fff;font-size: 16px;"><i class="icon-ok-sign"></i> บันทึกข้อมูลเรียบร้อย</p>';
	}
}
else{
	$data['status']='0';
	$data['message'] = '<p style="color:#fff"><i class="icon-remove-sign"></i> ไม่สามารถบันทึกข้อมูลได้:)</p>';
}

echo json_encode($data);
?>