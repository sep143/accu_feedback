
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> 

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Enquiry View</h3>
                    <div class="pull-right box-tools">
                        <a href="<?= site_url('enquiry/list'); ?>" class="btn btn-default"><i class="fa fa-backward"></i> Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-responsive table-striped" >
                        <thead>
                            <tr>
                                <td>Name </td><td>:</td><td> <?= $enquiry->name; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td><td>:</td><td><?= $enquiry->email; ?></td>
                            </tr>
                            <tr>
                                <td>Mobile</td><td>:</td><td><?= $enquiry->mobile; ?></td>
                            </tr>
                        </thead>
                    </table>&nbsp;<br>
                    
                    <label>Message : <br><pre><?= $enquiry->message; ?> </pre></label>
                </div>
            </div>
        </div>
        <!--Mail Send if enquiry send person-->
        <div class="col-md-6 ">
            <div class="box box-info">
                  <div class="box-header">
                      <i class="fa fa-envelope"></i>

                      <h3 class="box-title">Quick Email</h3>
                      <!-- tools box -->
<!--                      <div class="pull-right box-tools">
                          <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                              <i class="fa fa-times"></i></button>
                      </div>-->
                      <!-- /. tools -->
                  </div>
                  <!--<form action="<?= site_url('super_admin/Dashboard/quick_mail'); ?>" method="post">-->
                  <?php echo form_open(base_url('send_mail'), 'class="form-horizontal"');  ?> 
                      <div class="box-body">
                          <div class="form-group col-md-12">
                              <input type="email" class="form-control" name="email" placeholder="Email to:" value="<?= $enquiry->email; ?>" >
                          </div>
                          <div class="form-group col-md-12">
                              <input type="text" class="form-control" name="subject" placeholder="Subject">
                          </div>
                          <div>
                              <textarea class="textarea" name="message" placeholder="Message" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                          </div>

                      </div>
                      <div class="box-footer clearfix">
                          <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                              <i class="fa fa-arrow-circle-right"></i></button>
                      </div>
                  <!--</form>-->
                  <?php echo form_close( ); ?>
              </div>
        </div>
    </div>
</section>