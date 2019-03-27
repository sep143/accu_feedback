<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<section class="content">
    
   <?php echo form_open(base_url('admin/Devices_C/device_update'), 'class=""'); ?> 
    <div class="row">
        <input type="hidden" name="device_id" value="<?= $device_data->device_id; ?>">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Device</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= site_url('admin/Devices_C'); ?>" class="btn btn-default btn-sm" ><i class="fa fa-times"></i></a>
                        </div>
                    </div>
               
                    <div class="box-body">
                        <div class="form-group col-lg-6 col-xs-12">
                            <div class="">
                                <label>Your changes can take upto a minute to appear on the device.</label>
                            </div>&nbsp;<br>
                            <div class="">
                                <label for="surveyname" class=""><b>Device Name</b></label>
                            </div>
                        <?php if($adminRole == 2 || $otherRole == 11) { ?>    
                            <div class="">
                                <input type="text" name="device_name" value="<?= $device_data->device_name; ?>" class="form-control" placeholder="Enter Trigger Name" required="">
                            </div>
                        <?php }else{ ?>
                            <div class="">
                                <input type="text" value="<?= $device_data->device_name; ?>" class="form-control" placeholder="Enter Trigger Name" disabled="">
                            </div>
                        <?php }?>
                        &nbsp;<br>
                         <div class="">
                             <label class="float-left h-25"><b>Survey</b></label>
                         </div>
                        <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <select class="form-control" name="survey_id" >
                            <?php foreach ($allSurvey as $s_count => $s_data): ?>
                                    <option value="<?= $s_data->survey_id; ?>" <?php if($device_data->survey_id == $s_data->survey_id) echo 'selected="selected"'; ?> > <?= $s_data->survey_name; ?></option>
                            <?php endforeach; ?>
                                </select>
                            <?php  }else{ ?>
                                <select class="form-control" name="survey_id" disabled="">
                            <?php foreach ($allSurvey as $s_count => $s_data): ?>
                                    <option value="<?= $s_data->survey_id; ?>" <?php if($device_data->survey_id == $s_data->survey_id) echo 'selected="selected"'; ?> > <?= $s_data->survey_name; ?></option>
                            <?php endforeach; ?>
                                </select>
                            <?php } ?>
                                   
                                
                        &nbsp;<br>
                        <div class="">
                             <label class="float-left h-25"><b>Branding</b></label>
                         </div>
                            <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <select class="form-control" name="brand_id" >
                                    <?php foreach ($allBrand as $b_count => $b_data):
                                        if(!empty($device_data->branding_id)){
                                        ?>
                                    <option value="<?= $b_data->b_id; ?>" <?php if($device_data->branding_id == $b_data->b_id) echo 'selected="selected"'; ?> > <?= $b_data->b_brand_name; ?></option>
                                        <?php }else{ ?>
                                    <option value="<?= $b_data->b_id; ?>" > <?= $b_data->b_brand_name; ?></option>        
                                       <?php }
                                    endforeach;
                                    ?>
                                </select>
                            <?php }else{ ?>
                                <select class="form-control" name="brand_id" disabled="">
                                    <?php foreach ($allBrand as $b_count => $b_data):
                                        if(!empty($device_data->branding_id)){
                                        ?>
                                    <option value="<?= $b_data->b_id; ?>" <?php if($device_data->branding_id == $b_data->b_id) echo 'selected="selected"'; ?> > <?= $b_data->b_brand_name; ?></option>
                                        <?php }else{ ?>
                                    <option value="<?= $b_data->b_id; ?>" > <?= $b_data->b_brand_name; ?></option>        
                                       <?php }
                                    endforeach;
                                    ?>
                                </select>
                            <?php } ?>
                            </div>
                        <?php if($adminRole == 2 || $otherRole == 11){ ?>
                        <div class="col-lg-3 col-xs-12 pull-right">
                            <div class="text-center" style="margin-top: 50%;">
                                <button type="submit" class="btn btn-default btn-block">
                                    <i class="fa fa-save"></i> Save Change
                                </button>
                            </div>
                            <div class="text-center" style="margin-top: 10%;">
                                <input type="button" class="btn btn-danger btn-block" value="Remove Device" id="dialog" data-id="<?= $device_data->device_id; ?>">
                            </div>
<!--                            <div class="text-center" style="margin-top: 10%;">
                                <a href="<?= site_url('admin/Devices_C/device_delete/'.$device_data->device_id); ?>" onclick="return confirm('Are You Sure.');">
                                    <button type="button" class="btn btn-danger btn-block">
                                    <i class="fa fa-trash fa-fw"></i> Remove Device
                                    </button></a>
                            </div>-->
                        </div>
                        <?php }else{ ?>
                        <div class="col-lg-3 col-xs-12 pull-right">
                            <div class="text-center" style="margin-top: 50%;">
                                <a href="<?= site_url('admin/Devices_C'); ?>" class="btn btn-success btn-block">
                                    <i class="fa fa-backward"></i> Back
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        </div>&nbsp;<br>
                       
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
    $("#devices_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  