<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>public/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?= base_url(); ?>public/plugins/select2/select2.full.min.js"></script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: black;
}
</style>
<section class="content">
   <?php echo form_open(base_url('admin/SmsSend_C/device_update'), 'class=""'); ?> 
    <div class="row">
        <input type="hidden" name="device_id" value="">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customers</h3>
                        <!-- <div class="box-tools pull-right">
                            <a href="<?= site_url('admin/Devices_C'); ?>" class="btn btn-default btn-sm" ><i class="fa fa-times"></i></a>
                        </div> -->
                    </div>
               
                    <div class="box-body">
                        <div class="form-group col-lg-6 col-xs-12">
                            <div class="">
                                <label>You can send text sms on your customer mobile.</label>
                            </div>&nbsp;<br>

                            <div class="">
                                <label class="float-left h-25"><b>Customers</b></label>
                            </div>
                            <?php if($adminRole == 2 || $otherRole == 11){ 
                                
                            ?>


                                <select class="form-control select2" name="survey_id[]" multiple="multiple" data-placeholder="Select a Customers" searchable="Search here..">
                            <?php 
                                
                                foreach ($allCustomers as $s_count => $cust_data): 
                                    ?>
                                    <option value="<?= $cust_data['id']; ?>" 
                                    
                                    > 
                                    <?= $cust_data['name']; ?>
                                    </option>

                            <?php 
                                    if($set_survey_id[$lang_set] == $cust_data->id){
                                        $lang_set += 1;
                                    }
                                endforeach; 
                            ?>
                                </select>
                            <?php }?>
                                   
                            &nbsp;<br>    
                            &nbsp;<br>

                            <div class="">
                                <label class="float-left h-25"><b>Message</b></label>
                            </div>
                            
                            <div class="">
                                <textarea class="form-control"></textarea>
                            </div>

                            
                        
                        </div>
                        <?php if($adminRole == 2 || $otherRole == 11){ ?>
                        <div class="col-lg-3 col-xs-12 pull-right">
                            <div class="text-center" style="margin-top: 50%;">
                                <button type="submit" disabled="disabled" class="btn btn-default btn-block">
                                    <i class="fa fa-mail-forward"></i> Send SMS
                                </button>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>
                    <!-- /.box-body -->
                </div>
         
        </div>
        
        <?php echo form_close(); ?>
</section>


<script>
 $(document).ready(function(){
        $('#dialog').on('click', function () {
            var value = $('#dialog').attr("data-id");
            //alert(value);
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Device',
                content: 'This will disconnect this device from your account. Data sycned from this device will be orphaned.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                        //$.alert('Confirmed!');
                       $.ajax({
                           url:'<?= site_url('admin/Devices_C/device_delete'); ?>',
                           type:'post',
                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', device_id:value},
                           success: function(data){
                               $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Delete Device',
                                    content: 'Successfully Delete Device.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.assign('<?= base_url()?>admin/Devices_C')
                                        }
                                    }
                               });
                               
                           }
                       });
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    },
                    
                }
            });
        });
  
});
</script>

<script>
    $("#send_sms").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>