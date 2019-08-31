<style>

    ul.sidebar-menu>li>a {

    position: relative;

    display: block;

    //padding: 7px 15px;

    font-weight: 500;

    font-size: 15px;

    white-space: nowrap;

    color: #6d7186;

}

li.treeview>a>span{

    margin-right: 15px;

    font-size: 15px;

}

li.treeview>a>span{

   // margin-right: 15px;

    font-size: 16px;

}







</style>



<?php 

$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2); 



$adminRole = ucwords($this->session->userdata('role_id'));

$otherRole = ucwords($this->session->userdata('m_role_id'));

//if duration date to cross then pannel diseble and this account update then open other wise never open

$check_date = $this->session->userdata('expired_date');

//$duration_check = $this->session->userdata('duration');

$current = (new DateTime())->format('Y-m-d');



?>  



  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

         <!-- sidebar menu: : style can be found in sidebar.less -->

   

    <ul class="sidebar-menu">

        <li id="dashboard" class="treeview">

          <a href="<?= base_url('admin/dashboard'); ?>">

              <span> <i class="ti-home"></i></span> 

              <span>Dashboard</span>

<!--            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>-->

          </a>

        </li>

      </ul>

      <ul class="sidebar-menu">

    <?php //start Condition if duration condition check successfully then open otherwise off 

        if($current <= $check_date){ 

    ?>

      <li id="responses" class="treeview">

          <a href="<?= base_url('admin/responses_C'); ?>">

              <span><i class="ti-view-list"></i></span>

              <span>Responses</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

              

        </li>

        <li id="responses-chart" class="treeview">

          <a href="<?= base_url('admin/responses_C/chart'); ?>">

              <span><i class="ti-pie-chart"></i></span>

              <span>Graphical Reports</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>

        <li></li>

        <li id="notifications_dashboard" class="treeview">

          <a href="<?= base_url('admin/Notifications_C'); ?>">

              <span><i class="ti-bell"></i></span>

              <span>Notifications</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>



          <li id="devices_dashboard" class="treeview">

          <a href="<?= base_url('admin/Devices_C'); ?>">

              <span><i class="ti-tablet"></i></span>

              <span>Devices</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>

          <li id="survey_dashboard" class="treeview">

          <a href="<?= base_url('admin/Survey_C'); ?>">

              <span><i class="fa fa-comments-o"></i></span>

              <span>Feedbacks</span>

<!--            <span class="pull-right-container">

                <i class="fa fa-angle-left pull-right"></i>

              span class="label label-primary pull-right">4</span

            </span>-->

          </a>

        </li>



         <li id="brand_dashboard" class="treeview">

          <a href="<?= base_url('admin/Branding_C/show'); ?>">

              <span><i class="ti-image"></i></span>

              <span>Branding</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>

        

        <li id="myAccount" class="treeview">

          <a href="<?= base_url('admin/MyAccount_C'); ?>">

              <span><i class="ti-user"></i></span>

              <span>My Account</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>

        <li id="send_sms" class="treeview">
          <a href="<?= base_url('admin/SmsSend_C'); ?>">
              <span><i class="ti-comment"></i></span>
              <span>SMS</span>
<!--            <span class="pull-right-container">
              <small class="label pull-right bg-green"></small>
            </span>-->
          </a>
        </li>

<?php //End Condition if duration condition check successfully then open otherwise off 

} else {

    ?>

    <li id="myAccount" class="treeview">

          <a href="<?= base_url('admin/payment/upgrade'); ?>">

              <span><i class="ti-user"></i></span>

              <span>Update Account</span>

<!--            <span class="pull-right-container">

              <small class="label pull-right bg-green"></small>

            </span>-->

          </a>

        </li>

<?php

} //else condition value show?>

      </ul>

      

    </section>

    <!-- /.sidebar -->

  </aside>



  

<script>

  $("#<?= $cur_tab; ?>").addClass('active');

</script>

