<?php
include('../connection/config.php');
$data = '';
$sql = "SELECT a.id,a.hn,a.edit_date,a.visit,a.fname,a.mark,b.Name,b.dp
		FROM visit.detail_visit a
		INNER JOIN visit.user b ON b.id = a.id_user
		WHERE a.`status` = 1";
$query = mysqli_query($conn,$sql);

// Query All status
$status = '';
$sql_status = "SELECT * FROM visit.tbl_status";
$query_status = mysqli_query($conn,$sql_status);
while ($r_status = mysqli_fetch_array($query_status)) {
	$status .= '<option value="'.$r_status['id'].'"';
	if ($r_status['id'] == 2) {
		$status .= 'selected';
	}
	$status .='>'.$r_status['status'];
}
$status .= '</select>';
$data .='<div class="table-responsive"><table class="table table-bordered table-hover" id="table">
                              <thead>
                                  <tr>
                                      <th style="width: 80px;text-align:center;">HN</th>
                                      <th style="width: 100px;text-align:center;">วันที่ให้บริการ</th>
                                      <th style="width: 30px;text-align: center;">Visit</th>
                                      <th style="width: 220px;text-align:center;">ชื่อ - นามสกุล</th>
                                      <th style="text-align: center;">สาเหตุ</th>
                                      <th style="text-align: center;">ผู้แจ้ง</th>
                                      <th style="text-align: center;width: 130px;">แก้ไขสถานะ</th>
                                      <th style="text-align: center;width: 60px;"><i class="icon-ok-circle"></i></th>
                                  </tr>
                              </thead>
                              <tbody>';
if (mysqli_num_rows($query) > 0) {
	while ($row = mysqli_fetch_array($query)) {
		$data .= '<tr>
					<td>'.$row['hn'].'</td>
					<td>'.$row['edit_date'].'</td>
					<td style="text-align:center;">'.$row['visit'].'</td>
					<td>'.$row['fname'].'</td>
					<td>'.$row['mark'].'</td>
					<td>'.$row['Name'].' / '.$row['dp'].'</td>
					<td style="background-color:#16a085;">
						<select style="padding:0px 0px;margin:-5px 0px;border-style: none;" id="'.$row['id'].'">
						'.$status.'</option></td>
					<td style="text-align:center;">
						<label class="switch" data-id="'.$row['id'].'">
						    <span class="slider"></span>
						</label>
					</td>
				</tr>';
	}
}
else{
	$data .= '<tr><td colspan="8" style="text-align:center;">ไม่มีข้อมูล</td></tr>';
}
$data .= '</tbody></table></div>';

echo $data;
?>
