<!DOCTYPE html>
<!--
Template Name: Admin Lab Dashboard build with Bootstrap v2.3.1
Template Version: 1.2
Author: Mosaddek Hossain
Website: http://thevectorlab.net/
-->

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="th"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Login page</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/style_responsive.css" rel="stylesheet" />
  <link href="css/style_default.css" rel="stylesheet" id="style_color" />
  <link href="css/alertify.min.css" rel="stylesheet" id="style_color" />
  <style>
    #cid{
      width: 312px;
    }
  </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body id="login-body">
  <!-- BEGIN LOGIN -->
  <div id="login">
    <!-- BEGIN LOGIN FORM -->
    <form id="loginform" class="form-vertical no-padding no-margin">
          <img src="img/logo.png" alt="">
          <!-- <h4>User Login</h4> -->
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-key"></i></span>
                      <input type="text" name="cid" id="cid" placeholder="กรอกเลขประจำตัวประชาชน"/>
                  </div>
                  <div class="clearfix space5"></div>
              </div>
          </div>
      <input type="submit" id="login-btn" class="btn btn-block login-btn" value="Login" />
    </form>
    <!-- END LOGIN FORM -->        
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div id="login-copyright">
      2018 &copy; IT Praibueng Hospital.
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.blockui.js"></script>
  <script src="js/alertify.min.js"></script>
  <script src="js/scripts.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
    $('#cid').focus();
    $("#loginform").on("submit", function(event) {
      event.preventDefault();
      var cid = $('#cid').val();
      $.ajax({
          url: "chk_login.php",
          method: "GET",
          data: {cid:cid},
          datatype: 'json',
          success: function(data) {
            if (data.status =='1') {
                alertify.error(data.msg);
            }else{
              window.location.href = data.link;
            }
          }
      });
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>