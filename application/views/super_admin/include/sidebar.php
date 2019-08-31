<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard1': $this->uri->segment(2);  
?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
<!--        <div class="pull-left image">
          <img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p style="color: black;"><?= ucwords($this->session->userdata('name')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>-->
      </div>
      <!-- search form -->
<!--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      

      <ul class="sidebar-menu">
          <li id="dashboard1" class="">
              <a href="<?= site_url('super_admin/dashboard'); ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            
          </a>
        </li>
        <li id="users" class="treeview">
            <a href="<?= base_url('super_admin/users'); ?>">
              <i class="fa fa-cutlery"></i> <span>Restaurants</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="add_user"><a href="<?= base_url('super_admin/users/add'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <li id="view_users" class=""><a href="<?= base_url('super_admin/users'); ?>"><i class="fa fa-circle-o"></i> View Users</a></li>
            </ul>
          </li>
          <li id="expired_res" class="">
              <a href="<?= site_url('expired/restaurant'); ?>">
            <i class="fa fa-send-o"></i>
            <span>Expired Restaurant</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <li id="transition" class="">
              <a href="<?= site_url('transition/history'); ?>">
            <i class="fa fa-bank"></i>
            <span>Transition History</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <li id="cash" class="">
              <a href="<?= site_url('transition/cash'); ?>">
            <i class="fa fa-inr"></i>
            <span>Cash Bill</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <li id="discount" class="">
              <a href="<?= site_url('discount/view'); ?>">
            <i class="fa fa-inr"></i>
            <span>Discount</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <li id="view_enquiry" class="">
              <a href="<?= site_url('enquiry/list'); ?>">
            <i class="fa fa-envelope"></i>
            <span>Enquiry</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <li id="languages" class="">
              <a href="<?= site_url('language/list'); ?>">
            <i class="fa fa-globe"></i>
            <span>Language</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $("#<?= $cur_tab; ?>").addClass('active');
</script>
