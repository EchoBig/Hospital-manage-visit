<?php session_start(); ?>
<?php
include("../config.php");
$iduser = $_SESSION["id"];
$output = '';
$query = "SELECT * FROM `detail_visit` WHERE status = 1 ORDER BY time DESC";
$result = mysqli_query($con,$query);
$output .= '<table class="table table-bordered">
    <thead>
      <tr>
        <th>HN</th>
        <th>วันที่ต้องการแก้ไข</th>
        <th>visit</th>
        <th>ชื่อ - นามสกุล</th>
        <th>หมายเหตุ</th>
        <th>สถานะ</th>
      </tr>
    </thead>
    <tbody>';

	while($row = mysqli_fetch_array($result))
		{
		 $output .= '
		 <tr>
		  <td>'.$row["hn"].'</td>
		  <td>'.$row["edit_date"].'</td>
		  <td>'.$row["visit"].'</td>
		  <td>'.$row["fname"].'</td>
		  <td>'.$row["mark"].'</td>
		  <td><label class="switch">
			  <input type="checkbox" id="btnup" value="'.$row["id"].'">
			  <span class="slider"></span>
			</label></td>';

		 $output .= '</tr>';
		}
 $output .= '</tbody></table>';
echo $output;
?>