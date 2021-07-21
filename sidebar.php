<!-- BEGIN SIDEBAR -->
<div id="sidebar" class="nav-collapse collapse">
         <div class="sidebar-toggler hidden-phone"></div>
          <?php
            $file = basename($_SERVER['PHP_SELF'],".php");
          ?>
          
         <!-- BEGIN SIDEBAR MENU -->
          <ul class="sidebar-menu">
              <li class="has-sub <?php echo $file == 'index' ? 'active' : ''; ?>">
                  <a href="index.php" class="">
                      <span class="icon-box"> <i class="icon-home"></i></span> Dashboard
                  </a>
              </li>
              <li class="has-sub
                  <?php
                  if($file == 'delete' or $file =='history')
                  {
                    echo 'active';
                  }
                  else{
                    '';
                  }
                  ?>">
                  <a href="javascript:;" class="">
                      <span class="icon-box"> <i class="icon-book"></i></span> VISIT
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li class="<?php echo $file == 'delete' ? 'active' : ''; ?>">
                        <a class="" href="delete.php">แจ้งลบ Visit</a>
                      </li>
                      <li class="<?php echo $file == 'history' ? 'active' : ''; ?>">
                        <a class="" href="history.php">ดูประวัติย้อนหลัง</a>
                      </li>
                  </ul>
              </li>
          </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->