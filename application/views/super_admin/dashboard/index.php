<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/iCheck/flat/blue.css">
<!-- Morris chart -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/morris/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Date Picker -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> 

<!--Stylesheet make a self-->
<link rel="stylesheet" href="<?= base_url() ?>public/common_styleSheet.css">
<script src="<?= base_url(); ?>public/card-depth.js"></script>

<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
<?php
if($all_users){
    $total_res=0; $active_res = 0; $inactive_res=0; $expaired_tot=0; 
    foreach ($all_users as $r_count=>$r_data):
        $total_res++;
    if($r_data['account_status']==1){
        $active_res ++;
    }else if($r_data['account_status']==0){
        $inactive_res ++;
    }
 //Expired Restaurant Count and More button to click full list show   
    if(!empty ($r_data['expired_date'])){
        $current = (new DateTime())->format('Y-m-d');
            $now_date = date('Y-m-d', strtotime($r_data['expired_date']));
            if($current > $now_date){
                $expaired_tot ++;
        }
    }
    endforeach;
    
 //All Enquiry Count and click More than open full list open 
    
}
?>

<style>
    table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    min-width: 120px;
}
</style>

<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $total_res; ?></h3>

              <p>Total Restaurant</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('super_admin/users'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $active_res; ?></h3>

              <p>Active Restaurant</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('super_admin/users'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $enquiry_count; ?><sup style="font-size: 20px"></sup></h3>

              <p>Enquiry Pandding</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="<?= base_url('enquiry/list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $expaired_tot; ?></h3>

              <p>Expired Restaurant</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
              <a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
          <!-- Left col -->
          <section class="col-lg-8 connectedSortable">
              <!-- Custom tabs (Use filter button)-->
              <div class="nav-tabs-custom">
                  <!-- Tabs within a box -->
                  <ul class="nav nav-tabs pull-right">
                      <li class="active"><a href="#filter-k" data-toggle="tab">Filter</a></li>
                      <li><a href="#expired_chart" data-toggle="tab">Amount</a></li>
                      <li class="pull-left header"><i class="fa fa-filter"></i> Filter</li>
                  </ul>
                  <div class="tab-content no-padding">
                      <!-- Morris chart - Sales -->
                      <div class="chart tab-pane active" id="filter-k" style="position: relative; height: 200px;">
                          <div class="row">&nbsp;<br><br>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label>Select Type</label>
                                  <div class="form-group">
                                      <select class="form-control" name="search_type" id="searchType">
                                          <option value="">Text To Search</option>
                                          <option value="expired">Expired Date</option>
                                          <option value="join">Joining Date</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-12 searchViaText">
                                <label>Enter Text</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchViaText" placeholder="Enter Email/Owner/Restaurant Name...">
                                </div>
                            </div>
                            <div class="filterClick" style="display: none;">
                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label>Date Range</label>
                                  <div class="form-group">
                                      <select class="form-control" id="datePicker_range">
                                            <option value="">--select--</option>
                                            <option value="custome">Custom</option>
                                            <option value="30d">Last 30 Days</option>
                                            <option value="7d">Last 7 Days</option>
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="month">This Month</option>
                                            <option value="last_month">Last Month</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label>From</label>
                                  <div class="form-group">
                                      <input type="text" class="form-control" id="FromDatePicker" readonly="" style="cursor: pointer">
                                  </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label>To</label>
                                  <div class="form-group">
                                      <input type="text" class="form-control" id="TODatePicker" readonly="" style="cursor: pointer">
                                  </div>
                              </div>
                              <!--</div>-->
                          </div>
                        <div class="row filterClick" style="display: none;">
                              <div class="col-lg-12 col-md-12 col-xs-12">
                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label class="">Select</label>
                                  <div class="form-group">
                                      <select class="form-control" name="" id="expNoexp">
                                          <option value="all">All</option>
                                          <option value="exp">Expired</option>
                                          <option value="No-exp">Non Expired</option>
                                      </select>
                                  </div>
                              </div>
<!--                              <div class="col-lg-3 col-md-3 col-xs-6">
                                  <label class="">Select</label>
                                  <div class="form-group">
                                      <select class="form-control" name="">
                                          <option value="">All</option>
                                          <option value="">Current</option>
                                          <option value="">Demo</option>
                                      </select>
                                  </div>
                              </div>-->
                            
                             </div> 
                          </div>
                            
                        </div>
                      </div>
                      </div>  
                      <!--Amount View Panel-->
                      <?php
                        if($transition_all){
                            $today = 0;
                            $total_amt = 0;
                            foreach ($transition_all as $v_count=>$v_row):
                                if($v_row->STATUS=='success'){
                                    $total_amt += $v_row->TXN_AMOUNT;
                                }
                            endforeach;
                            foreach ($transition as $v_count=>$v_row):
                                if($v_row->STATUS=='success'){
                                    $today += $v_row->TXN_AMOUNT;
                                }
                            endforeach;
                        }
                      ?>
                     <div class="chart tab-pane" id="expired_chart" style="position: relative; height: 200px;">
                         <div class="row">
                             <div class="col-lg-12">
                                 
                                 <div class="col-lg-4">
                                     <div class="small-box bg-teal card">
                                         <div class="inner">
                                             <h3><?php if(!empty($today)){echo $today;} ?>.00</h3>

                                             <p>Today Amount</p>
                                         </div>
                                         <div class="icon">
                                             <i class="ion ion-pie-graph"></i>
                                         </div>
                                         <a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                     </div>
                                 </div>
                                 <div class="col-lg-4">
                                     <div class="small-box bg-teal card">
                                         <div class="inner">
                                             <h3><?php if(!empty($total_amt))echo $total_amt; ?>.00</h3>

                                             <p>Total Amount</p>
                                         </div>
                                         <div class="icon">
                                             <i class="ion ion-pie-graph"></i>
                                         </div>
                                         <a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                     </div>
                                 </div>
                                 
                             </div>
                         </div>
                      </div>
                  </div>
              </div>
              <!--Table view in data show-->
              <div class="box">
                  <div class="box-body">
                      <table class="table table-bordered table-hover table-responsive" id="dashboardTable">
                      <thead>
                          <tr>
                              <th>S.No.</th>
                              <th>Owner Name</th>
                              <th>Restaurant Name</th>
                              <th>Email</th>
                              <th>Joining Date</th>
                              <th>Expired Date</th>
                              <th>Role Type</th>
                              <th>Role</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody id="viewData1">
                          
                      </tbody>
                  </table>
                      <div id="loading" align="center" style="display:none;" class="">
                        Loading Please Wait....
                        <img src="<?= base_url();?>public/dist/img/gif/ajax-loader.gif" alt="Loading" />
                    </div>
                  </div>
              </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-4 connectedSortable">
              <?= AlertMsg(); ?>
              <div class="box box-info">
                  <div class="box-header">
                      <i class="fa fa-envelope"></i>

                      <h3 class="box-title">Quick Email</h3>
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                              <i class="fa fa-times"></i></button>
                      </div>
                      <!-- /. tools -->
                  </div>
                  <!--<form action="<?= site_url('super_admin/Dashboard/quick_mail'); ?>" method="post">-->
                  <?php echo form_open(base_url('send_mail'), 'class="form-horizontal"');  ?> 
                      <div class="box-body">
                          <div class="form-group">
                              <input type="email" class="form-control" name="email" placeholder="Email to:">
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="subject" placeholder="Subject">
                          </div>
                          <div>
                              <textarea class="textarea" name="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                          </div>

                      </div>
                      <div class="box-footer clearfix">
                          <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                              <i class="fa fa-arrow-circle-right"></i></button>
                      </div>
                  <!--</form>-->
                  <?php echo form_close( ); ?>
              </div>
              <div class="box box-info">
                  <div class="box-header">
                      <i class="fa fa-envelope"></i>

                      <h3 class="box-title">Quick Message</h3>
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                              <i class="fa fa-times"></i></button>
                      </div>
                      <!-- /. tools -->
                  </div>
                  <!--<form action="<?= site_url('super_admin/Dashboard/quick_mail'); ?>" method="post">-->
                  <?php echo form_open(base_url('send_msg'), 'class="form-horizontal"');  ?> 
                      <div class="box-body">
                          <div class="form-group">
                              <input type="number" class="form-control" name="mobile" placeholder="Mobile No:">
                          </div>
<!--                          <div class="form-group">
                              <input type="text" class="form-control" name="subject" placeholder="Subject">
                          </div>-->
                          <div>
                              <textarea class="" name="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                          </div>

                      </div>
                      <div class="box-footer clearfix">
                          <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                              <i class="fa fa-arrow-circle-right"></i></button>
                      </div>
                  <!--</form>-->
                  <?php echo form_close( ); ?>
              </div>


              <!--List Open -->
              <div class="box box-primary">
                  <div class="box-header">
                      <i class="ion ion-clipboard"></i>

                      <h3 class="box-title">Today Pay</h3>

<!--                      <div class="box-tools pull-right">
                          <ul class="pagination pagination-sm inline">
                              <li><a href="#">&laquo;</a></li>
                              <li><a href="#">1</a></li>
                              <li><a href="#">2</a></li>
                              <li><a href="#">3</a></li>
                              <li><a href="#">&raquo;</a></li>
                          </ul>
                      </div>-->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="table-responsive">
                          <table class="table table-bordered table-responsive" id="todayTransition">
                              <thead style="background-color: lightgray;">
                                  <tr>
                                      <td>Res. ID</td>
                                      <td>Ord. ID</td>
                                      <td>Amount</td>
                                      <td>Status</td>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                          if($transition){
                              foreach ($transition as $count=> $row):
                          ?>        
                          <tr style="<?php if($row->STATUS=='success'){echo '';}else{echo 'color:red;';}?>">
                              <td class="text"><?= $row->CUST_ID; ?></td>
                              <td class="text"><?= $row->ORDER_ID; ?></td>
                              <td class="text"><?= $row->TXN_AMOUNT ?></td>
                              <td class="text"><?= $row->STATUS ?></td>
                          </tr>
                          <?php
                          endforeach;
                          }
                          ?>
                               
                              </tbody>
                          </table>
                      </div>
                      <ul class="todo-list">
                          
                          
                          
                      </ul>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix no-border">
                      <a href="<?= site_url('transition/history'); ?>" class="btn btn-default pull-right"><i class="fa fa-plus"></i> History</a>
                  </div>
              </div>

          </section>
          <!-- right col -->
      </div>
      <!-- /.row (main row) -->


</section>
<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script> 
  
<script>
  $(function () {
    $("#dashboardTable").DataTable({
		searching : false,
		scrollX : true,
	});
    
  });
</script> 
<script>
  $(function () {
    $("#todayTransition").DataTable({
		searching : false,
		//scrollX : true,
	});
    
  });
</script> 


<!--Text To search restaurant-->
<script>
$(document).ready(function(){
    $('#searchViaText').on('keyup', function(){
        var value = $(this).val();
        $('#loading').hide();
        $.ajax({
            url:'<?= site_url('super_admin/FilterController/search_via_text'); ?>',
            type:'POST',
            data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', searchText:value, expNoexp:'all'},
            success:function(data){
                $('#viewData1').html(data);
                $('#loading').hide(); 
            }
        });
    });
});
</script>
<!--Filter data use then script to call AJAX-->
<script>
$(document).ready(function(){
    $('select[id^="searchType"]').on('change', function(){
        var value = $(this).val();
        var before = $('#datePicker_range').val();
        if(value == 'expired' || value == 'join'){
           // alert(value);
          $('.filterClick').show('slow');
          $('.searchViaText').hide('slow');
            if(before=='30d'||before=='7d'||before=='today'||before=='yesterday'||before=='month'||before=='last_month'){
                $('#loading').show();
                $.ajax({
                    url:"<?= site_url('super_admin/FilterController/data_rang_select'); ?>",
                    type: 'post',
                    data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',dateOption:before, serchType:value, expNoexp:'all'},
                    success: function(data){
                        $('#viewData1').html(data);
                        $('#loading').hide();
                       // alert('check'+value);
                    }
                });
            }
        //alert(value);
        //select date rang then this will set function
            $('select[id^="datePicker_range"]').on('change', function(){
                var dateOption = $(this).val();
                // alert(value);
                $('#loading').hide();
                $('#loading').show();
                var today = new Date();
                if(dateOption == 'custome'){
                    //this only check
                    var from = moment().subtract(30, 'days').format('DD-MMM-YYYY');
                    var to = moment().format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == '30d'){
                    var from = moment().subtract(30, 'days').format('DD-MMM-YYYY');
                    var to = moment().format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == '7d'){
                    var from = moment().subtract(7, 'days').format('DD-MMM-YYYY');
                    var to = moment().format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == 'today'){
                    var from = moment().format('DD-MMM-YYYY');
                    var to = moment().format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == 'yesterday'){
                    var from = moment().subtract(1, 'days').format('DD-MMM-YYYY');
                    var to = moment().subtract(1, 'days').format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == 'month'){
                    var from = moment().subtract(0, 'months').startOf('month').format('DD-MMM-YYYY');
                    var to = moment().format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }else if(dateOption == 'last_month'){
                    var from = moment().subtract(1, 'months').startOf('month').format('DD-MMM-YYYY');
                    var to = moment().subtract(1, 'months').endOf('month').format('DD-MMM-YYYY');
                    $('#FromDatePicker').val(from);
                    $('#TODatePicker').val(to);
                }
                //alert(dateOption);
                $.ajax({
                    url:"<?= site_url('super_admin/FilterController/data_rang_select'); ?>",
                    type: 'post',
                    data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',dateOption:dateOption, serchType:value, expNoexp:'all'},
                    success: function(data){
                        $('#viewData1').html(data);
                        $('#loading').hide();
                    }
                });
            //Expired restaurant get data and Non expired data
                $('select[id^="expNoexp"]').on('change', function(){
                   // alert(dateOption);
                   // alert(value);
                    var expNoexp = $(this).val();
                   // alert(expNoexp);
                    $('#loading').show();
                    $.ajax({
                        url:"<?= site_url('super_admin/FilterController/data_rang_select'); ?>",
                        type: 'post',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',dateOption:dateOption, serchType:value, expNoexp:expNoexp},
                        success: function(data){
                            $('#viewData1').html(data);
                            $('#loading').hide();
                        }
                    });
                });
            });
            
            //select date rang then this will set function
            
            //select custom then 
         
                $('#FromDatePicker').on('change', function(){
                    var fromDate = $('#FromDatePicker').val();
                    var toDate = $('#TODatePicker').val();
                    $('#loading').show();
                    //alert(fromDate);
                    $.ajax({
                        url:"<?= site_url('super_admin/FilterController/select_date') ?>",
                        type:'post',
                        //dataType: 'json',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', serchType:value, expNoexp:'all', fromDate:fromDate, toDate:toDate},
                        success: function(data){
                            $('#viewData1').html(data);
                            $('#loading').hide();
                        }
                    });
                });
                $('#TODatePicker').on('change', function(){
                    var fromDate = $('#FromDatePicker').val();
                    var toDate = $('#TODatePicker').val();
                    $('#loading').show();
                  //  alert(fromDate);
                  //  alert(toDate);
                    $.ajax({
                        url:"<?= site_url('super_admin/FilterController/select_date') ?>",
                        type:'post',
                        //dataType: 'json',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', serchType:value, expNoexp:'all', fromDate:fromDate, toDate:toDate},
                        success: function(data){
                            $('#viewData1').html(data);
                            $('#loading').hide();
                        }
                    });
                });
                                
        }else{
            $('.filterClick').hide('slow');
            $('.searchViaText').show('slow');
        }
        //alert(value);
    });
});
</script>

<!--select date rang then set date wise filter and session set-->
<script>
    $(document).ready(function(){
        
    });
</script>
<!--Date Picker-->
<script>
$(function () {
    var today = new Date();
    //Start Date picker
    $('#FromDatePicker').datepicker({
      format:'d-M-yyyy',
      autoclose: true,
     // maxDate: today,
     // endDate: "today",
    });
    
    $('#TODatePicker').datepicker({
      format:'d-M-yyyy',
      autoclose: true,
     // maxDate: today,
     // endDate: "today",
    });
});
</script>

   
<script>
$("#dashboard1").addClass('active');
</script>  