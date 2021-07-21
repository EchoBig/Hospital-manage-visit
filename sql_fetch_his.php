<?php
session_start();
include('connection/config.php');
$action = $_GET['action'];
$id = $_SESSION['id'];
$keysearch = empty($_GET["key"]) ? '' : $_GET["key"];
$data = '';

function ConvDate($convD) {
    $GGyear = substr($convD, 0, 4) + 543;
    $GGmonth = substr($convD, 5, 2);
    $GGdate = substr($convD, 8, 2);
    $Buffdate = $GGdate.'/'.$GGmonth.'/'.$GGyear;
    return $Buffdate;
}

if ($action == 'fetch') {
	$record_per_page = 15;
    $page = '';
    if(isset($_GET["page"]))
    {
     $page = $_GET["page"];
    }
    else
    {
     $page = 1;
    }
    $start_from = ($page-1)*$record_per_page;

	$sql = "SELECT a.hn,a.edit_date,a.visit,a.fname,a.mark,b.id,b.status FROM visit.detail_visit a
			INNER JOIN visit.tbl_status b
			WHERE a.status = b.id
			AND a.id_user = $id AND a.fname LIKE '%$keysearch%'
			ORDER BY a.id DESC
			LIMIT $start_from, $record_per_page";
	$query = mysqli_query($conn,$sql);
	$data .=' <table class="table table-bordered table-hover" style="border-color:#4c9ca0;">
                              <thead>
                                  <tr style="background-color:#4c9ca0;color:#fff;border-color:#4c9ca0;">
                                      <th style="width: 80px;text-align:center;">HN</th>
                                      <th style="width: 100px;text-align:center;">วันที่ให้บริการ</th>
                                      <th style="width: 60px;text-align: center;">Visit</th>
                                      <th style="width: 300px;text-align:center;">ชื่อ - นามสกุล</th>
                                      <th style="text-align: center;">สาเหตุ</th>
                                      <th style="text-align: center;width: 180px;">สถานะ</th>
                                  </tr>
                              </thead>
                              <tbody>';
    if (mysqli_num_rows($query) > 0) {
    	while ($row = mysqli_fetch_array($query)) {
    		$no_status = $row['id'];
    		$data .='<tr>
    				<td>'.$row['hn'].'</td>
    				<td>'.ConvDate($row['edit_date']).'</td>
    				<td style="text-align:center">'.$row['visit'].'</td>
    				<td>'.$row['fname'].'</td>
    				<td>'.$row['mark'].'</td>
    				<td>';
          if ($no_status == 1) {
            $data .= '';
          }
          elseif ($no_status == 2) {
            $data .= '<img src="img/vector/remove.png" width="16px" hieght="16px">';
          }
          elseif ($no_status == 3) {
            $data .= '<img src="img/vector/question.png" width="16px" hieght="16px">';
          }
          elseif ($no_status == 4) {
            $data .= '<img src="img/vector/cancel.png" width="16px" hieght="16px">';
          }
          elseif ($no_status == 5) {
            $data .= '<img src="img/vector/padlock.png" width="16px" hieght="16px">';
          }
          else {
            $data .= '<img src="img/vector/info.png" width="16px" hieght="16px">';
          }

        $data .= ' '.$row['status'];
    		$data .='</td>
    			</tr>';
    	}
    }
    else{
    	$data .='<tr><td colspan="6" style="text-align:center;">ไม่มีข้อมูล</td></tr>';
    }
    $data .='</tbody></table>';

    $page_query = "SELECT * FROM visit.detail_visit a
			INNER JOIN visit.tbl_status b
			WHERE a.status = b.id
			AND a.id_user = $id AND a.fname LIKE '%$keysearch%'";
	if(isset($keysearch))
	{
	  $page_query .= '';
	}
	else{
	  $page_query .= 'LIMIT $start_from, $record_per_page';
	}
	$page_result = mysqli_query($conn, $page_query);
	$total_records = mysqli_num_rows($page_result);
	$total_pages = ceil($total_records / $record_per_page);
	$start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    $data .='<div class="pagination text-right">
    <ul class="ul_page">';
    if($page > 1)
    {
    	$data .='<li><a id="'.($page - 1).'" style="cursor:pointer">«</a></li>';
    }
    if ($start_loop > 0) {
		for ($i=$start_loop; $i<=$end_loop; $i++) {
		  	$data .='<li '.($page == $i ? 'class="active"' : '').'><a id="'.$i.'" style="cursor:pointer">'.$i.'</a></li>';
		}
	}
    if($page < $end_loop)
    {
    	$data .='<li><a id="'.($page + 1).'" style="cursor:pointer">»</a></li>';
    }
    $data .'</ul></div>';
}
echo $data;
?>