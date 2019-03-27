
<style>
  /* Outer */
.popup {
width:100%;
height:100%;
display:none;
position:fixed;
top:0px;
left:0px;
background:rgba(0,0,0,0.75);
}
/* Inner */
.popup-inner {
max-width:700px;
width:90%;
padding:25px;
position:absolute;
top:50%;
left:50%;
-webkit-transform:translate(-50%, -50%);
transform:translate(-50%, -50%);
box-shadow:0px 2px 6px rgba(0,0,0,1);
border-radius:3px;
background:#fff;
}
/* Close Button */
.popup-close {
width:30px;
height:30px;
padding-top:4px;
display:inline-block;
position:absolute;
top:-50px;
right:10px;
transition:ease 0.25s all;
-webkit-transform:translate(50%, -50%);
transform:translate(50%, -50%);
border-radius:1000px;
background:rgba(0,0,0,0.8);
font-family:Arial, Sans-Serif;
font-size:20px;
text-align:center;
line-height:100%;
color:#fff;
}
.popup-close:hover {
-webkit-transform:translate(50%, -50%) rotate(180deg);
transform:translate(50%, -50%) rotate(180deg);
background:rgba(0,0,0,1);
text-decoration:none;
}
</style>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>
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
           
            <?php echo form_open(base_url('admin/users/edit/'.$user['m2_id']), 'class="form-horizontal"' )?> 
<!--              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">User Name</label>

                <div class="col-sm-9">
                    <input type="text" name="m_user_name" value="<?= $user['m_user']; ?>" class="form-control" id="firstname" placeholder="" disabled="">
                </div>
              </div>-->
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>

                <div class="col-sm-9">
                  <input type="text" name="firstname" value="<?= $user['m_first_name']; ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">Last Name</label>

                <div class="col-sm-9">
                  <input type="text" name="lastname" value="<?= $user['m_last_name']; ?>" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                    <input type="email" name="email" value="<?= $user['m_email']; ?>" class="form-control" id="email" placeholder="" disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                <div class="col-sm-9">
                  <input type="number" name="mobile_no" value="<?= $user['m_mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Select Role</label>

                <div class="col-sm-9">
                  <select name="user_role" class="form-control">
                    <option value="">Select Role</option>
                    <option value="11" <?= ($user['m_role_id'] == 11)?'selected': '' ?> >Admin</option>
                    <option value="12" <?= ($user['m_role_id'] == 12)?'selected': '' ?>>User</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                    <div class="text-right">
                        <a href="<?= site_url('admin/MyAccount_C'); ?>" class="btn btn-default"><i class="fa fa-backward"></i> Back&nbsp;&nbsp;</a>
                        <button type="button" class="btn btn-default" data-popup-open="password_Change" ><i class="fa fa-key"></i> Change Password</button>&nbsp;&nbsp;
                        <!--<input type="button" name="" value="Change Password" class="btn btn-default text-right">&nbsp;&nbsp;-->
                        <input type="submit" name="submit" value="Update User" class="btn btn-success pull-right">
                    </div>
                  
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
        
        
        
    </div>
      
      
      
      <div class="popup" data-popup="password_Change">
            <div class="popup-inner">
                <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
            
           <?php echo form_open(base_url('admin/Users/edit'), 'class="form-horizontal"');  ?> 
           <input type="hidden" name="email" value="<?= $user['m_email']; ?>">
           <div class="col-md-12">
                <h3>Change Password</h3>
               
           </div>&nbsp;<br>
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    <div class="col-md-4">
                        <label for="firstname" class="control-label">Password : </label>
                    </div>
                <div class="col-md-8">
                    <input type="password" name="password" id="password1" class="form-control" id="fullname" placeholder="Password" required="">
                </div>
              </div>
                <div class="form-group col-md-12">
                    <div class="col-md-4">
                        <label for="cpassword" class="control-label">Confirm Password : </label>
                    </div>
                <div class="col-md-8">
                    <input type="password" name="cpassword" id="password2" class="form-control" id="fullname" placeholder="Confirm Password" required="">
                </div>
              </div>
              <div class="form-group col-md-12">
                    <div class="col-md-4">
                        <label>&nbsp;</label>
                    </div>
                <div class="col-md-8">
                    <label id="validate-status"></label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-9"><a data-popup-close="password_Change" class="btn btn-danger pull-right" style="margin-right: -21px;" href="#">Close</a></div>
                    <div class="col-md-3"><input type="submit" name="passwordsubmit" value="Save & Close" class="btn btn-info"></div>
                </div>
              </div>
            <?php echo form_close( ); ?>
                <!--p><a data-popup-close="popup-1" href="#">Close</a></p-->
                <a class="popup-close" data-popup-close="password_Change" href="#">x</a>
            </div>
        
            </div>
        </div>
  </div>  

</section> 

<script>
      
    
    $(function() {
    //----- OPEN waiter
    $('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
    e.preventDefault();
    });
    //----- CLOSE waiter
    $('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    e.preventDefault();
    });
    });
</script>

<!--Password Match condition scripting-->
<script>
    $(document).ready(function() {
  $("#password2").keyup(validate);
});

function validate() {
  var password1 = $("#password1").val();
  var password2 = $("#password2").val();

    if(password1 == password2) {
       $("#validate-status").text("Match Password").css('color', 'green');
    }
    else {
        $("#validate-status").text("Not Match Password !!!").css('color', 'red');;  
    }
    
}
</script>

<script>
    $("#myAccount").addClass('active');
</script>  