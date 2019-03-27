<?php
$check_date = $this->session->userdata('expired_date');
$current = (new DateTime())->format('Y-m-d');
       
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('admin');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?= base_url() ?>image/app_logo.png" class="" alt="Logo" width="30px" height="35px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
          <img src="<?= base_url() ?>image/app_logo.png" class="" alt="Logo" width="30px" height="35px">
          <b>Accu</b> Feedback
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                <span class="hidden-xs"><?= ucwords($this->session->userdata('name')); ?> &nbsp;<i class="fa fa-angle-down"></i></span>
            </a>
            <ul class="dropdown-menu">
                <!--<div class="col-md-2">-->
                    <ul class="nav">
                        <?php //start Condition if duration condition check successfully then open otherwise off 
                          if($current <= $check_date){ 
                        ?>
                        <li>
                            <a href="<?= site_url('admin/MyAccount_C'); ?>" ><i class="ti-settings pdd-right-10"></i> &nbsp;My Account</a>
                        </li>
                          <?php }else{ ?>
                              
                          <?php } ?>
                        <li>
                            <a href="<?= site_url('admin/LoginController/logout'); ?>" ><i class="ti-power-off pdd-right-10"></i> &nbsp;Sign out</a>
                        </li>
                    </ul>
                    
                <!--</div>-->
<!--              <li class="">
                <div class="pull-right">
                  <a href="<?= site_url('admin/LoginController/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
              </li>
                </div>
                <div class="pull-left">
              <li>
                  <a href="<?= site_url('admin/LoginController/change_pwd'); ?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
              </li>-->
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li class="border left">
              <a href="<?= site_url('admin/Notifications_C'); ?>"><i class="fa fa-bell-o"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
 