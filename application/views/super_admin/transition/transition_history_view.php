 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
 <section class="content">
     <!--Search Restaurant list for using AJAX-->
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Restaurant Transition</h3>
         </div>
         <div class="box-body table-responsive">
             <div class="col-lg-12">
                 <div class="col-lg-2 col-md-6 col-xs-12">
                     <label>Restaurant ID</label>
                 </div>
                 <div class="col-lg-5 col-md-6 col-xs-12 form-group">
                     <input type="text" class="form-control" id="name" placeholder="Enter Restaurant ID...">
                 </div>
                 <div class="col-lg-3">
                     <button type="button" onclick="search_res(this)" class="btn btn-success">Search</button>
                     <button type="button" onclick="search_clear(this)" class="btn btn-danger">Clear</button>
                     <button type="button" class="btn btn-default" id="filter_open1"><i class="fa fa-filter"></i> &nbsp;Filter</button>
                 </div>
                 <div class="col-lg-2">
                     
                 </div>
             </div><hr>
             <!--Get id find data import-->
             <div id="restaurant_data">
                 <div id="loading" align="center" style="display:none;" class="">
                     Loading Please Wait....
                     <img src="<?= base_url(); ?>public/dist/img/gif/ajax-loader.gif" alt="Loading" />
                 </div>
             </div>
             
         </div>
     </div>
     <!--Filter div start-->
     <div class="box" style="display: none;" id="filter_close1">
         <div class="box-header">
             <h3 class="box-title">Filter For Transition History</h3>
             <button type="button" onclick="filter_clear(this)" class="pull-right btn btn-danger">Clear</button>
         </div>
         <div class="box-body">
             <div class="row">
                 <div class="col-lg-12">
                     
                     <div class="col-lg-3 form-group">
                         <label>Date Range</label>
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
                 </div>
                 
             </div>
<!--             <div class="row">
                 <div class="col-lg-12">
                     <div class="col-lg-3 form-group">
                         <label>Select Status</label>
                         <select class="form-control" id="select_status">
                             <option value="all">All</option>
                             <option value="success">Success</option>
                             <option value="failure">Failure</option>
                         </select>
                     </div>
                 </div>
             </div>-->
         </div>
     </div>
     
     <div class="box" id="filter_data">
         <div id="loading2" align="center" style="display:none;" class="">
             Loading Please Wait....
             <img src="<?= base_url(); ?>public/dist/img/gif/ajax-loader.gif" alt="Loading" />
         </div>
     </div>
     
     <!--Filter div end-->
  <!--Trasition History-->   
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Total Transition History</h3>
      <div class="pull-right">
          <?php
          if($all_trans){
              $actual_amt = 0;
              $failed = 0;
              foreach ($all_trans as $count=>$row):
                  if($row->STATUS=='success'){
                      $actual_amt += $row->TXN_AMOUNT;
                  }else{
                      $failed += $row->TXN_AMOUNT;
                  }
              endforeach;
              $tax = ($actual_amt*$this->pay_tax['for'])/100;
              $amount = $actual_amt-$tax;
          }
          ?>
          <p style="color:green;">Amount : <?php if(!empty($amount)) echo $amount; ?> + TAX : <?= $tax; ?> = Total Amount : <i class="fa fa-inr"></i> <?= $actual_amt; ?>/- <span style="color:red;">Failed Amount : <?= $failed; ?>/-</span></p>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        
      <table id="transition1" class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
          <th>S.No.</th>
          <th>Restaurant ID</th>
          <th>Restaurant Name</th>
          <th>Invoice No.</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Transition Date </th>
          <th>Mobile No.</th>
          <th>Email</th>
          <th>Txt ID</th>
          <th>Mode</th>
          <th>Product</th>
          <th>PG Type</th>
          <th>Bank Ref Code</th>
          <th>Device</th>
        </tr>
        </thead>
        <tbody >
          <?php 
          if($all_trans){
          $i = 0;
          $current = (new DateTime())->format('Y-m-d');
          foreach($all_trans as $count=>$row): ?>
            <!--Joining Date to expired date count and view-->
           
        <tr>
            <td><?= $count+1; ?></td>
            <td><?= $row->CUST_ID; ?></td>
            <td><?= $row->name; ?></td>
            <td><?= $row->ORDER_ID; ?></td>
            <td><?= $row->TXN_AMOUNT; ?></td>
            <td><?php if($row->STATUS=='success'){echo '<span class="btn btn-success btn-xs">'.$row->STATUS.'</span>';}elseif($row->STATUS=='failure'){echo '<span class="btn btn-danger btn-xs">'.$row->STATUS.'</span>';} ?></td>
            <td><?= date('d-M-Y, H:i A', strtotime($row->TXNDATE)) ?></td>
            <td><?= $row->MSISDN; ?></td>
            <td><?= $row->EMAIL; ?></td>
            <td><?= $row->TxtID; ?></td>
            <td><?= $row->mode; ?></td>
            <td><?= $row->productinfo; ?></td>
            <td><?= $row->PG_TYPE; ?></td>
            <td><?= $row->bank_ref_num; ?></td>
            <td><?php if($row->device==1){echo 'Single';}elseif($row->device==2){    echo 'Multiple';} ?></td>
            
        </tr>
          <?php 
          $i++; 
          endforeach;
          } ?>
        </tbody>
       
      </table>
    </div>
    <!--<p id="myElem" class="alert alert-info" style="display: none;">Update status successfully</p>-->
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#transition1").DataTable({
        searching : true,
        scrollX : true,
    });
  });
</script>
<!--filter toggle-->
<script>
//$(documet).ready(function(){
    $('#filter_open1').click(function(){
        //alert('hello');
        $('#filter_close1').toggle('slow');
    });
//});
</script>

<!--Enter Restaurant ID then table in view data of particular restaurant id-->
<script>
function search_res(current){
    var search = $('#name').val();
    if(search){
        $.ajax({
            url:'<?= site_url('get_res_id'); ?>',
            type:'post',
            data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',search:search},
            success:function(data){
                $('#restaurant_data').html(data);
            }
        });
    }
}
</script>
<!--after search clear get data-->
<script>
function search_clear(cl_data){
    $('#restaurant_data').empty();
}
</script>
<!--after search clear get data-->
<script>
function filter_clear(cl_data){
    $('#filter_data').empty();
}
</script>

<!--Filter data use then script to call AJAX-->
<script>
$(document).ready(function(){
    
        //alert(value);
        //select date rang then this will set function
            $('select[id^="datePicker_range"]').on('change', function(){
                var dateOption = $(this).val();
                 //alert(dateOption);
               // $('#loading').hide();
                $('#loading2').show();
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
                    url:"<?= site_url('date_rang'); ?>",
                    type: 'post',
                    data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',dateOption:dateOption, status:'all', from:from, to:to},
                    success: function(data){
                        $('#filter_data').html(data);
                        $('#loading2').hide();
                    }
                });
                //select Status if success and failure or all
                $('#select_status').on('change', function(){
                    var status = $(this).val();
                    //alert(status);
                    var fromDate = $('#FromDatePicker').val();
                    var toDate = $('#TODatePicker').val();
                    $('#loading2').show();
                    //alert(fromDate);
                    //alert(toDate);
                    $.ajax({
                        url:"<?= site_url('date_rang') ?>",
                        type:'post',
                        //dataType: 'json',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', dateOption:dateOption, status:status, from:fromDate, to:toDate},
                        success: function(data){
                            $('#filter_data').html(data);
                            $('#loading2').hide();
                        }
                    });
                });
            
            });
            
            //select date rang then this will set function
            
            //select custom then 
         
                $('#FromDatePicker').on('change', function(){
                    var fromDate = $('#FromDatePicker').val();
                    var toDate = $('#TODatePicker').val();
                    $('#loading2').show();
                    //alert(fromDate);
                    $.ajax({
                        url:"<?= site_url('date_rang') ?>",
                        type:'post',
                        //dataType: 'json',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', dateOption:'custome', from:fromDate, to:toDate},
                        success: function(data){
                            $('#filter_data').html(data);
                            $('#loading2').hide();
                        }
                    });
                });
                $('#TODatePicker').on('change', function(){
                    var fromDate = $('#FromDatePicker').val();
                    var toDate = $('#TODatePicker').val();
                    $('#loading2').show();
                    //alert(fromDate);
                    //alert(toDate);
                    $.ajax({
                        url:"<?= site_url('date_rang') ?>",
                        type:'post',
                        //dataType: 'json',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', dateOption:'custome', from:fromDate, to:toDate},
                        success: function(data){
                            $('#filter_data').html(data);
                            $('#loading2').hide();
                        }
                    });
                });
            
                                
        
    
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
      maxDate: today,
      endDate: "today",
    });
    
    $('#TODatePicker').datepicker({
      format:'d-M-yyyy',
      autoclose: true,
      maxDate: today,
      endDate: "today",
    });
});
</script>
<script>
$("#transition").addClass('active');
</script>   

<!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>




