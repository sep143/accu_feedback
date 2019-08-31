<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Staff</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <?php echo form_open(site_url('admin/MyAccount_C/waiter_edit/'.$waiter['waiter_id']), 'class="form-horizontal"' )?> 
              
              <div class="form-group">
                  <input type="hidden" name="waiter_id" value="<?= $waiter['waiter_id']; ?>">
                <label for="username" class="col-sm-2 control-label">Staff Code</label>
                <div class="col-sm-9">
                    <input type="text" value="<?= $waiter['waiter_code']; ?>" class="form-control" id="waiterCode" placeholder="" disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-9">
                    <input type="text" name="fullname" value="<?= set_value('fullname', $waiter['waiter_name']); ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>
<!--              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                    <input type="email" name="email" value="" class="form-control" id="email" placeholder="" disabled="">
                </div>
              </div>-->
              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                <div class="col-sm-9">
                    <input type="number" name="m_number" value="<?= set_value('m_number', $waiter['waiter_mobile']); ?>" class="form-control" id="m_number" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="waiter_address"> <?= set_value('waiter_address', $waiter['waiter_add']); ?></textarea>
                </div>
              </div>
              <div class="form-group">
<!--                <div class="col-md-11">
                  <input type="submit" name="submit" value="Save & Close" class="btn btn-success pull-right">
                </div>-->
                  <div class="col-md-11">
                    <div class="text-right">
                        <a href="<?= site_url('admin/MyAccount_C'); ?>" class="btn btn-default"><i class="fa fa-backward"></i> Back</a>&nbsp;&nbsp;
                        <!--<input type="button" name="" value="Change Password" class="btn btn-default text-right">&nbsp;&nbsp;-->
                        <input type="submit" name="submit" value="Save & Close" class="btn btn-success pull-right">
                    </div>
                  
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 


<script>
    $("#myAccount").addClass('active');
</script>  