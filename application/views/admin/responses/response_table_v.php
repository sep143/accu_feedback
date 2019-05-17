<script src="http://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
<!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/select2/select2.min.css">

<!-- Content Header (Page header) -->
<style>
.filter-section{
        margin-top: 30px;
        border-radius: 0;
        border-left: 5px solid #b1b7cc;
        min-height: 130px;
        background: #e2e3e4;
        width: 100%;
        height: auto;
    }
.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #eff0f4;
    border: 1px solid #e3e3e3;
    border-left: 5px solid #b1b7cc;
    border-radius: 4px;
    box-shadow: inset 5px 2px 10px rgba(0,0,0,.05);
}
div.dataTables_wrapper {
    width: auto;
    margin: 0 auto;
}
   
</style>
<!--Responses view for Table data-->
<section class="content">
  <div class="row top-section">
    <?php //echo form_open(base_url('admin/Excel_export_Controller'), 'class=""'); ?> 
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-4">
                <div>
                   <?php if(!empty($this->session->userdata['s_session']['session_survey'])){
                        $survey_ses = $this->session->userdata['s_session']['session_survey'];
                       if(!empty($this->session->userdata['rang_date_session']['d_range_session'])){
                            $d_rang_date = $this->session->userdata['rang_date_session']['d_range_session'];
                       }
                       if(!empty($this->session->userdata['s_session']['fromDate'])){
                           $from_date_ses = $this->session->userdata['s_session']['fromDate'];
                       }
                       if(!empty($this->session->userdata['s_session']['toDate'])){
                           $to_date_ses = $this->session->userdata['s_session']['toDate'];
                       }
                       if(!empty($this->session->userdata['filter_session']['filter_set'])){
                           $filter_ses = $this->session->userdata['filter_session']['filter_set'];
                       }
                   } ?>
                    <select class="form-control" style="cursor: pointer;" id="survey_form" name="survey_id">
                        <option>--Select--</option>
                        <?php
                            foreach ($list as $row):
                         ?>
                        <option value="<?= $row->survey_id; ?>" <?php if(!empty($survey_ses)) if($survey_ses == $row->survey_id) echo 'selected="selected"';?>> <?= $row->survey_name; ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="btn-group z-behind">
                    <a style="color: black; font-size: 13px;" href="<?= site_url('admin/responses_C/responses'); ?>"><button type="button" class="btn btn-default">&nbsp;&nbsp;<i class="fa "></i>Responses&nbsp;&nbsp;</button></a>
                    <a style="color: black; font-size: 13px;" href="<?= site_url('admin/responses_C'); ?>"><button type="button" class="btn btn-default active">&nbsp;&nbsp;<i class="fa fa-table"></i> Table&nbsp;&nbsp;</button></a>
                    <a style="color: black; font-size: 13px;" href="<?= site_url('admin/responses_C/chart'); ?>"><button type="button" class="btn btn-default">&nbsp;&nbsp;<i class="fa fa-bar-chart"></i> Summary&nbsp;&nbsp;</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pull-right btn-group z-behind" style="display: flex;">
                    <div class="inline" style="flex: 1, padding:10px;">
                        <button class="btn btn-default" id="reloadPage"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="inline" style="flex: 1, padding:10px;">
                        <!--<button class="btn btn-default" id="downloadXls"><i class="fa fa-download"></i> Download</button>-->
                        <form action="<?= site_url('excel_download'); ?>" method="post">
                        <!--<form action="<?= site_url('excel_download_check'); ?>" method="post">-->
                            <button class="btn btn-default" type="submit"><i class="fa fa-download"></i> Download</button>
                            <?php
                            
                            ?>
                            <input type="hidden" name="survey_id" id="survey_excel" value="<?php if(!empty($survey_ses)){ echo $survey_ses;}; ?>">
                            <input type="hidden" name="startDate" id="startdate_excel" value="<?php if(!empty($from_date_ses)){ echo $from_date_ses;}; ?>">
                            <input type="hidden" name="endDate" id="enddate_excel" value="<?php if(!empty($to_date_ses)){echo $to_date_ses;}; ?>">
                            <input type="hidden" name="waiter_id1" id="waiterid_excel" value="all">
                            <input type="hidden" name="device_id1" id="deviceid_excel" value="all">
                            <input type="hidden" name="" value="<?php if(!empty($filter_ses)){echo $filter_ses;}; ?>">
                            <input type="hidden" name="" value="<?php if(!empty($d_rang_date)){ echo $d_rang_date;}; ?>">
                        </form>
                    </div>
                    <div class="inline" style="flex: 1, padding:10px;">
                        <button type="button" class="btn btn-default" id="filterViewOn" data-on="1"><i class="fa fa-filter"></i> Filters <i class=""></i></button>
                        <button type="button" class="btn btn-default" id="filterViewOff" data-off="0" style="display: none;"><i class="fa fa-filter"></i> Filters <i class=""></i></button>
                        
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
      <div class="col-md-12" id="filterDiv" style="display: none;">
         <div class="filter-section well">
             <div class="row">
                 <div class="container">
                 <div class="col-md-3 form-group" style="margin-top: 30px;">
                     <div><h6>Date Range</h6></div>
                     <div class="">
                        <select class="form-control" name="Destination" style="cursor: pointer;" id="datePicker_range">
                             <option value="custome" <?php if(!empty($d_rang_date)) if($d_rang_date == 'custome') echo 'selected="selected"';?>>Custom</option>
                             <option value="30d" <?php if(!empty($d_rang_date)) if($d_rang_date == '30d') echo 'selected="selected"';?>>Last 30 Days</option>
                             <option value="7d" <?php if(!empty($d_rang_date)) if($d_rang_date == '7d') echo 'selected="selected"';?>>Last 7 Days</option>
                             <option value="today" <?php if(!empty($d_rang_date)) if($d_rang_date == 'today') echo 'selected="selected"';?>>Today</option>
                             <option value="yesterday" <?php if(!empty($d_rang_date)) if($d_rang_date == 'yesterday') echo 'selected="selected"';?>>Yesterday</option>
                             <option value="month" <?php if(!empty($d_rang_date)) if($d_rang_date == 'month') echo 'selected="selected"';?>>This Month</option>
                             <option value="last_month" <?php if(!empty($d_rang_date)) if($d_rang_date == 'last_month') echo 'selected="selected"';?>>Last Month</option>
                        </select>
                     </div>
                 </div>
                     <div class="input-daterange">
                        <div class="col-md-3 form-group" style="margin-top: 30px;">
                             <div><h6>From</h6></div>
                               <?php
                               //echo $fromDate."<br>";
                               //echo $toDate."<br>";
                                $month = new DateTime();
                                $month->modify('-30 days');
                                $oneMonth = $month->format('d-M-Y');
                             ?>
                             <div class="input-group">
                                 <input type="text" name="startDate" id="datepicker" class="form-control date-range-filter" value="<?php if(!empty($from_date_ses)){ echo set_value('starDate', $from_date_ses); }else{ echo set_value('starDate', $oneMonth); } ?>" readonly="" style="background-color: white; cursor: pointer; text-align: left;">
                                 <span class="input-group-btn">
                                     <button type="button" class="btn btn-default">
                                         <i class="fa fa-calendar"></i>
                                     </button>
                                 </span>
                             </div>
                         </div>
                         <div class="col-md-3 form-group" style="margin-top: 30px;">
                             <div><h6>To</h6></div>
                           
                             <div class="input-group">
                                 <input type="text" name="endDate" id="endDatePicker" class="endDatePicker form-control date-range-filter" value="<?php if(!empty($to_date_ses)){ echo set_value('endDate', $to_date_ses); }else{echo set_value('endDate', date('d-M-Y')); } ?>" readonly="" style="background-color: white; cursor: pointer; text-align: left;">
                                 <span class="input-group-btn">
                                     <button type="button" class="btn btn-default endDatePicker">
                                         <i class="fa fa-calendar"></i>
                                     </button>
                                 </span>
                             </div>
                         </div>
                      </div> 
                 <div class="col-md-3"></div>
                 </div>
             </div>
             <div class="row">
                 <div class="container">
                     <div class="col-md-3 form-group">
                         <div><h6>Devices</h6></div>
                         <div>
                             <select class="form-control" id="device_list">
                                 <!--<option>--select--</option>-->
                             </select>
                         </div>
                     </div>
                     <div class="col-md-3 form-group">
                         <div><h6>Waiter</h6></div>
                         <div>
                             <select class="form-control" id="waiter_list">
                                 <!--Waiter List ke trou option ka data ajax se survey form select krne pr waiter ke naam a jaenge-->
                             </select>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div><h6>&nbsp;<br></h6></div>
                         <div><button class="btn btn-default" id="clear_f"><i class="fa fa-remove"></i> Clear</button></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-12 col-lg-12 col-xs-12" style="margin-top: 20px; ">
                 <div id="loading" style="margin-left: 480px; display: none;" class="">
                        Loading Please Wait....
                        <img src="<?= base_url();?>public/dist/img/gif/ajax-loader.gif" alt="Loading" style="margin-right: 500px;"/>
                    </div>
         <div id="viewData1">
             
         </div>
     </div>
     <?php //echo form_close(); ?>
  </div>  

</section> 
<!-- Select2 -->
<script src="<?= base_url() ?>public/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>public/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>public/dataTables/moment.min.js"></script>
<script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>public/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url() ?>public/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?= base_url() ?>public/plugins/iCheck/icheck.min.js"></script>
<!-- Page script -->

<!--DataTables--> 
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--For script use Responses Filter-->
<script>
    $(document).ready(function(){
        $("#reloadPage").click(function(){
            $('#loading').show();
            $('#viewData1').hide();
            location.reload(true);
            $('#loading').hide(1000);
        });
    //if set session of filter button click then set session then autometically filter div open other wise hide
        var filter_ses = <?php if(!empty($filter_ses)){ echo $filter_ses; }else{ echo 0; } ?>
        //alert('filter_ses');
        if(filter_ses == 1){
            $('#filterDiv').show('slow');
            $("#filterViewOff").show();
            $("#filterViewOn").hide();
            $("#filterViewOff").addClass('active');
        }else{
            $('#filterDiv').hide('slow');
        }
    });
    
</script>
<!--Filter button click then set session call ajax-->
<script>
    $('#filterViewOn').click(function() {
            $(this).hide();
            $("#filterViewOff").show();
            $("#filterViewOff").addClass('active');
            $('#filterDiv').show('slow');
            var on = $('#filterViewOn').data('on');
           // alert(on);
            $.ajax({
                url:'<?= site_url('admin/responses_C/filter'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', filter_click:on},
                success:function(data){
                    
                }
            });
        });
        $('#filterViewOff').click(function() {
            $(this).hide();
            $("#filterViewOn").show();
            $("#filterViewOff").removeClass('active');
            $('#filterDiv').hide('slow');
            var off = $('#filterViewOff').data('off');
           // alert(off);
            $.ajax({
                url:'<?= site_url('admin/responses_C/filter'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', filter_click:off},
                success:function(data){
                    
                }
            });
        });
</script>
<!--if already session set then function call using ajax-->
<script>
    $(document).ready(function(){
        var d_rang = '<?php if(!empty($d_rang_date)){ echo $d_rang_date; }else{ echo 'custome'; } ?>'
        if(d_rang == 'custome'){
            $('#loading').show();
        var search = $('#survey_form').val();
        var fromDate_r = $('#datepicker').val();
        var toDate_r = $('#endDatePicker').val();
        var dateOption = $('#datePicker_range').val();     
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',searchvalue:search, d_rang_sessionSet:dateOption, sessionSet:search, fromDate_t:fromDate_r, toDate_t:toDate_r, fromDate_s:fromDate_r, toDate_s:toDate_r},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                 
                }
            });
            
        }else if(d_rang == '30d' || d_rang == '7d' || d_rang == 'today' || d_rang == 'yesterday' || d_rang == 'month' || d_rang == 'last_month'){
            $('#loading').show();
            var dateOption = $('#datePicker_range').val();
            var servey_id = $('#survey_form').val();
            $.ajax({
                url:"<?= site_url('admin/Responses_C/datewise_responses_get'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', dateOption:dateOption, d_rang_sessionSet:dateOption, servey_id:servey_id },
                success: function(data){
                    $('#loading').hide();
                    $('#viewData1').html(data);
                }
            }); 
        }
    });
</script>
<!--select date rang then set date wise filter and session set-->
<script>
    $(document).ready(function(){
        $('select[id^="datePicker_range"]').on('change', function(){
            var dateOption = $(this).val();
            var servey_id = $('#survey_form').val();
            $('#loading').show();
            var today = new Date();
            if(dateOption == 'custome'){
               // alert('set custome');
            }else if(dateOption == '30d'){
                var from = moment().subtract(30, 'days').format('DD-MMM-YYYY');
                var to = moment().format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }else if(dateOption == '7d'){
                var from = moment().subtract(7, 'days').format('DD-MMM-YYYY');
                var to = moment().format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }else if(dateOption == 'today'){
                var from = moment().format('DD-MMM-YYYY');
                var to = moment().format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }else if(dateOption == 'yesterday'){
                var from = moment().subtract(1, 'days').format('DD-MMM-YYYY');
                var to = moment().subtract(1, 'days').format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }else if(dateOption == 'month'){
                var from = moment().subtract(0, 'months').startOf('month').format('DD-MMM-YYYY');
                var to = moment().format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }else if(dateOption == 'last_month'){
                var from = moment().subtract(1, 'months').startOf('month').format('DD-MMM-YYYY');
                var to = moment().subtract(1, 'months').endOf('month').format('DD-MMM-YYYY');
                $('#datepicker').val(from);
                $('#endDatePicker').val(to);
                $('#startdate_excel').val(from);
                $('#enddate_excel').val(to);
            }
            //alert(dateOption);
            $.ajax({
                url:"<?= site_url('admin/Responses_C/datewise_responses_get'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',dateOption:dateOption, d_rang_sessionSet:dateOption, servey_id:servey_id},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                }
            });
            //set session in date of select date-rang
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',sessionSet:servey_id, fromDate_s:from, toDate_s:to},
                success: function(data){
                   
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
//if set session than get data automectically
        var search = $('#survey_form').val();
//if set session than get waiter list automectically
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_waiter')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','survey_id':search},
                success: function(data){
                    $('#waiter_list').html(data);
                    //$('#loading').hide();
                }
            });
        //get device
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_device')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','survey_id':search},
                success: function(data){
                    $('#device_list').html(data);
                    //$('#loading').hide();
                }
            });
        
       //select custome option than call ajax
    $('select[id^="datePicker_range"]').on('change', function(){
        var dateOption = $('#datePicker_range').val();
         //alert(dateOption);
        if(dateOption == 'custome'){ 
            var search = $('#survey_form').val();
            var fromDate_r = $('#datepicker').val();
            var toDate_r = $('#endDatePicker').val();
            $('#loading').show();
            //alert(search);
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',servey_id:search, sessionSet:search, fromDate_t:fromDate_r, toDate_t:toDate_r},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                 
                }
            });
        }
    });

        $('select[id^="survey_form"]').on('change', function(){
            var search = $(this).val();
            var fromDate_r = $('#datepicker').val();
            var toDate_r = $('#endDatePicker').val();
            $('#survey_excel').val(search); //for use this id excel file download
            $('#loading').show();
            //alert(search);
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',searchvalue:search, sessionSet:search, fromDate_t:fromDate_r, toDate_t:toDate_r},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                }
            });
            
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_waiter')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','survey_id':search},
                success: function(data){
                    $('#waiter_list').html(data);
                    //$('#loading').hide();
                }
            });
            
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_device')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','survey_id':search},
                success: function(data){
                    $('#device_list').html(data);
                    //$('#loading').hide();
                }
            });
        });
            
         //date set then recall
        $('#datepicker').on('change', function(){
            var search = $('#survey_form').val();
            var fromDate = $('#datepicker').val();
            var toDate = $('#endDatePicker').val();
            $('#startdate_excel').val(fromDate);
            $('#enddate_excel').val(toDate);

            $('#loading').show();
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', searchvalue:search, sessionSet:search, fromDate_t:fromDate, toDate_t:toDate, fromDate_s:fromDate, toDate_s:toDate},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                }
            });
        });
        
        $('#endDatePicker').on('change', function(){
            var search = $('#survey_form').val();
            var fromDate = $('#datepicker').val();
            var toDate = $('#endDatePicker').val();
            $('#startdate_excel').val(fromDate);
            $('#enddate_excel').val(toDate);

            $('#loading').show();
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_response')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', searchvalue:search, sessionSet:search, fromDate_t:fromDate, toDate_t:toDate, fromDate_s:fromDate, toDate_s:toDate},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                }
            });
        });   
        
    });
</script>
<!--Get waiter select then call ajax and get to data-->
<script>
    $(document).ready(function(){
        $('select[id^="waiter_list"]').on('change', function() {
            var waiter_code = $(this).val();
            var survey_id = $('#survey_form').val();
            var fromDate = $('#datepicker').val();
            var toDate = $('#endDatePicker').val();
            $('#waiterid_excel').val(waiter_code);
            $('#loading').show();
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_waiter')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', role:'table', survey_id2 :survey_id, waiter_code:waiter_code, fromDate:fromDate, toDate: toDate},
                success: function(data){
                    $('#viewData1').html(data);
                    //alert('check');
                    $('#loading').hide();
                }
            });
        });
    });
</script>

<!--Get Device select then ajax to get data filter data and show-->
<script>
    $(document).ready(function(){
        $('select[id^="device_list"]').on('change', function(){
            var get_device = $(this).val();
            var survey_id = $('#survey_form').val();
            var fromDate = $('#datepicker').val();
            var toDate = $('#endDatePicker').val();
            $('#deviceid_excel').val(get_device);
            $('#loading').show();
            $.ajax({
                url:'<?= site_url('admin/Responses_C/get_device'); ?>',
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',role:'table' ,survey_id2:survey_id, device_imei:get_device, fromDate:fromDate, toDate: toDate},
                success: function(data){
                    $('#viewData1').html(data);
                    $('#loading').hide();
                }
            });
        });
    });
</script>
<!--If select date then set cutome set and set session then call ajax-->
<script>
$(document).ready(function(){
    $('#datepicker').on('click', function(){
        $("#datePicker_range option[value='<?php if(!empty($d_rang_date)){ echo $d_rang_date; } ?>']").removeAttr('selected');
        $("#datePicker_range option[value='custome']").attr('selected', 'selected');
    //if select date then set session of cutome
        $.ajax({
                url:"<?= site_url('admin/Responses_C/datewise_responses_get'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', d_rang_sessionSet:'custome'},
                success: function(data){
                }
            });
    });
    
    $('#endDatePicker').on('click', function(){
        $("#datePicker_range option[value='<?php if(!empty($d_rang_date)){ echo $d_rang_date; } ?>']").removeAttr('selected');
        $("#datePicker_range option[value='custome']").attr('selected', 'selected');
    //if select date then set session of cutome
        $.ajax({
                url:"<?= site_url('admin/Responses_C/datewise_responses_get'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', d_rang_sessionSet:'custome'},
                success: function(data){
                }
            });
    });
});
</script>

<script>
$(function () {
    var today = new Date();
    //Start Date picker
    $('#datepicker').datepicker({
      format:'d-M-yyyy',
      autoclose: true,
      maxDate: today,
      endDate: "today",
    });
    
    $('.endDatePicker').datepicker({
      format:'d-M-yyyy',
      autoclose: true,
      maxDate: today,
      endDate: "today",
    });
});
</script>

<script>
$("#downloadXls").click(function(){
  $("#surveyResponses").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "Responses", //do not include extension
    fileext: ".xlsx"
//    exclude_img: true,
//    exclude_links: true,
//    exclude: ".dntinclude",
//    exclude_inputs: true
  }); 
});
</script>

<!--clear of filter -->
<script>
    $(document).ready(function(){
        $('#clear_f').on('click', function(){
            $('#loading').show();
            $.ajax({
                url:'<?= site_url('admin/responses_C/clear_session'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', clear:'1'},
                success: function(data){
                    location.reload(true);
                    $('#loading').hide();
                }
            });
        });
    });
</script>
<script>
$("#responses").addClass('active');
</script>  

<!--DataTable Date Range Demo-->
<!--<script src="https://www.jqueryscript.net/demo/DataTables-Jquery-Table-Plugin/media/js/jquery.dataTables.js"></script>-->
<!--<script src="https://www.jqueryscript.net/demo/DataTables-Jquery-Table-Plugin/media/js/jquery.js"></script>-->