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
                           <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
                       </li>
                       <li>
                           <a href="#">VISIT</a> <span class="divider">&nbsp;</span>
                       </li>
                       <li><a href="#">แจ้งลบ</a><span class="divider-last">&nbsp;</span></li>
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
                           <h4><i class="icon-trash"></i> แจ้งลบ</h4>                 
                        </div>
                        <div class="widget-body">
                            <form id="frm_visit">
                                <div class="span12 text-center" id="insert_visit">
                                  <input type="text" id="hn" class="input-small" placeholder="HN">
                                  <input type="text" id="date_visit" data-mask="99/99/9999" placeholder="วันที่ให้บริการ (วว/ดด/ปปปป)">
                                  <select class="input-small m-wrap" id="no_visit" tabindex="1">
                                      <option value=""><--กรุณาเลือก--></option>
                                      <option value="1">Visit 1</option>
                                      <option value="2">Visit 2</option>
                                      <option value="3">Visit 3</option>
                                      <option value="4">Visit 4</option>
                                  </select>
                                  <input type="text" id="full_name" placeholder="ชื่อ - นามสกุล">
                                  <input type="text" id="cause" placeholder="สาเหตุ">
                                  <button type="submit" class="btn btn-success" style="margin-top: -10px;">
                                    <i class="icon-plus icon-white"></i> INSERT</a>
                                  </button>
                                </div>
                            </form>
                        </div>
                  </div>
               </div>
            </div>
            <!-- BEGIN LIST -->
            <form id="frm_add" method="post">
            <div class="row-fluid">
               <div class="span12">
                  <div class="widget">
                        <div class="widget-title">
                           <h4><i class="icon-th-list"></i> รายการแจ้งลบ</h4>                 
                        </div>
                        <div class="widget-body">
                          <div id="time_no" class="text-right">
                            <h3><a id="no_del_show"></a></h3>
                            <input type="hidden" name="no_delete" id="no_delete">
                          </div>
                            <table class="table table-bordered table-hover" id="tbl_visit">
                              <thead>
                                  <tr>
                                      <th style="width: 20px;">#</th>
                                      <th style="width: 80px;text-align:center;">HN</th>
                                      <th style="width: 100px;text-align:center;">วันที่ให้บริการ</th>
                                      <th style="width: 60px;text-align: center;">Visit</th>
                                      <th style="width: 300px;text-align:center;">ชื่อ - นามสกุล</th>
                                      <th style="text-align: center;">สาเหตุ</th>
                                      <th style="width: 50px;"></th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                        </div>
                  </div>
               </div>
            </div>
            <div class="row-fluid text-center">
                <button type="submit" class="btn btn-primary btn-large">
                  <i class="icon-save"></i> Submit All Visit
              </button>
              <input type="hidden" name="id_user" value="<?php echo $id;?>">
            </div>
            </form>
            <!-- END LIST -->
            <div class="row-fluid">
              <div id="show"></div>
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
  // BEGIN Add new Row
  var count = 1;
  $('#frm_visit').on('submit', function(event){
    event.preventDefault();
    var date_sub = $('#date_visit').val();
    var month_visit = date_sub.substring(3,5);
    var year_visit = date_sub.substring(6,10);
    if ($('#hn').val() == '') {
      $('#hn').focus();
      alert('กรุณากรอก HN ด้วยครับ')
      return false;
    }
    else if($('#date_visit').val() == '' || (month_visit < 1 || month_visit > 12) || (year_visit < 2560)){
      $('#date_visit').focus();
      alert('กรุณาตรวจสอบวันที่ให้บริการด้วยครับ')
      return false;
    }
    else if($('#no_visit').val() == ''){
      alert('กรุณาเลือก Visit ด้วยครับ');
      $('#no_visit').focus();
      return false;
    }
    else if($('#full_name').val() == ''){
      $('#full_name').focus();
      alert('กรุณากรอกชื่อ - นามสกุลด้วยครับ')
      return false;
    }else if($('#cause').val() == ''){
      $('#cause').focus();
      alert('กรุณาระบุสาเหตุด้วยครับ')
      return false;
    }else
    {
      if (count == 1) {
        $.ajax({
          url:'sql_getno_delete.php',
          type:'POST',
          dataType:'HTML',
          success:function(data){
            $('#no_del_show').html('เลขใบแจ้งลบ '+data);
            $('#no_delete').val(data);
          }
        });
      }
      var html_code = "<tr id='row'>";
      html_code += "<td>"+count+"</td>";
      html_code += "<td><input type='hidden' name='hn[]' value='"+$('#hn').val()+"'>"+$('#hn').val()+"</td>";
      html_code += "<td><input type='hidden' name='date_visit[]' value='"+$('#date_visit').val()+"'>"+$('#date_visit').val()+"</td>";
      html_code += "<td><input type='hidden' name='no_visit[]' value='"+$('#no_visit').val()+"'>"+$('#no_visit').val()+"</td>";
      html_code += "<td><input type='hidden' name='name[]' value='"+$('#full_name').val()+"'>"+$('#full_name').val()+"</td>";
      html_code += "<td><input type='hidden' name='cause[]' value='"+$('#cause').val()+"'>"+$('#cause').val()+"</td>";
      html_code += '<td class="remove_visit" style="text-align: center;"><a><i class="icon-remove-sign"></i></a></td>';
      html_code += "</tr>";
      $('#tbl_visit').append(html_code);
      document.getElementById("frm_visit").reset();
      $('#hn').focus();
      count = count + 1;
    }
  });
  // End Add Row

  // BEGIN Remove Row
  $("#tbl_visit").on("click", ".remove_visit", function(event) {
    $(this).closest("tr").remove();
    count--;
  });
  // End Remove Row 

  // BEGIN Insert
  $('#frm_add').on('submit', function(event){
    event.preventDefault();
        if (count > 1) {
            $.ajax({
              url: 'sql_add_visit.php',
              type: 'POST',
              data:$(this).serialize(),
              dataType: "json",
              success: function(data) {
                  if (data.status == 1) {
                      for (var i = 0;i<=count;i++) {
                        $("#row").remove();
                      }
                      count = 1;
                      alertify.success(data.message);
                  }else{
                    alertify.error(data.message);
                  }
              }
            });
          }
        else{
          alert('กรุณาเพิ่มรายละเอียดก่อนครับ');
            return false;
        }
    });
  // End Insert
</script>
<?php
}
else{
	header("location: login.php");
}
?>