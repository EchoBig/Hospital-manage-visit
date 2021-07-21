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
                       <li><a href="#">ดูประวัติย้อนหลัง</a><span class="divider-last">&nbsp;</span></li>
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
                           <h4><i class="icon-reorder"></i> ดูประวัติย้อนหลัง</h4>
                            <span class="pull-right" id="search_his">
                              <input type="text" placeholder="ค้นหาตามชื่อ" id="txt_search">
                              <i class="icon-search"></i>
                            </span>
                        </div>
                        <div class="widget-body">
                           <div id="show_his"></div>
                        </div>
                  </div>
               </div>
            </div>
            <!-- END LIST -->
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
<?php include('footer.php');?>
<script>
  $(document).ready(function(){
    fetch_history();
    function fetch_history(page,key){
      $.ajax({
        url:'sql_fetch_his.php',
        type:'GET',
        data:{action:'fetch',page:page,key:key},
        dataType:'html',
        success:function(data){
          $('#show_his').html(data);
        }
      });
    }

    $(document).on('click', '.ul_page > li > a', function(){ 
      var page = $(this).attr("id");
      var key = $('#txt_search').val();
      fetch_history(page,key);
    });

    $('#txt_search').on('keyup', function(event){
      event.preventDefault();
      var key = $(this).val();
      fetch_history(1,key);
    });
  });
</script>
<?php
}
else{
	header("location: login.php");
}
?>