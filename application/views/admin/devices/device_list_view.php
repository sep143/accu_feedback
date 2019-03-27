<section class="content">
    <div class="row">
        
<div class="col-md-12"> 
            <div class="">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update your devices?</h3>
                    </div>
                 <?php echo form_open(base_url('admin/Survey_C/survey_device'), 'class=""');  ?>  
                    <input type="hidden" value="<?= $s_id; ?>" name="survey_id">
                    <div class="box-body">
                        <label style="font-size-adjust: 10px; font-size: 15px;">Would you like to enable the survey <strong>"<?= $survey_name; ?>"</strong> on any of your devices? <br>
                            You can skip and do this later from the Devices page by clicking Change.</label>&nbsp;<br><hr>
                            <div class="col-md-12">
                                <?php
                                if($devices){
                                
                                foreach ($devices as $d_count => $d_data): ?>
                                    <input type="hidden" name="device_id[]" value="<?= $d_data->device_id; ?>">
                                    <div class="form-group">
                                        <div><input type="checkbox" name="device[]" value="<?= $d_data->device_id; ?>" class="form-cont" size="2"> <strong><?= $d_data->device_name; ?></strong></div>
                                    </div>
                                <?php endforeach; ?><hr>
                                <div><input type="submit" name="submit" value="Update" class="btn btn-default">
                                    <!--<button type="submit" name="submit" class="btn btn-default" style="padding: 10px;"><i class="fa fa-check"></i> Update</button>-->
                                    <a class="" href="<?= site_url('admin/Survey_C'); ?>" style="padding: 10px; cursor: pointer;"> Skip <i class="fa fa-forward"></i></a></div>
                                <?php } //if condition apply for availble device then update button open
                                else {  ?>
                                    <div class="form-group">
                                    <div><span>No Device add <br>Please Login your ID in mobile and add device</span></div>
                                </div><hr>
                                    <a class="" href="<?= site_url('admin/Survey_C'); ?>" style="padding: 10px; cursor: pointer;"> Skip <i class="fa fa-forward"></i></a>
                               <?php }?>
                            </div>
                    </div>
                      <?php echo form_close( ); ?>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
</div> <!--My Account Payment End Div-->
</div>
</section>