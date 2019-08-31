

<style>

    .box-add{

        margin: 15px;

        //width: 90%;

        padding: 20px;

    }

</style>

<section class="content">

  <div class="row">

    <div class="col-md-12">

      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Add New Restaurant</h3>

        </div>

        <!-- /.box-header -->

        <!-- form start -->

        <div class="box-add box-body">

          <?php if(isset($msg) || validation_errors() !== ''): ?>

              <div class="alert alert-warning alert-dismissible">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>

                  <?= validation_errors();?>

                  <?= isset($msg)? $msg: ''; ?>

              </div>

            <?php endif; ?>

           

            <?php echo form_open(base_url('super_admin/users/add'), 'class=""');  ?> 

            <div class="">

              <div class="">

                  <div class="row">

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                      <label>First Name</label>

                      <input type="text" name="f_name" class="form-control" placeholder="Enter First Name" required="" value="<?= set_value('f_name'); ?>">

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                      <label for="exampleInputPassword1">Last Name</label>

                      <input type="text" name="l_name" class="form-control" placeholder="Enter Last Name" required="" value="<?= set_value('l_name'); ?>">

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-lg-12 col-md-12 col-xs-12">

                      <label>Restaurant Name</label>

                      <input type="text" name="res_name" class="form-control" placeholder="Enter Restaurant Name" required="" value="<?= set_value('res_name'); ?>">

                      <p class="help-block">Full Name of Restaurant</p>

                    </div>

                </div>

                <div class="row">

                    <div class="formm-group col-lg-6 col-md-6 col-xs-12">

                        <label>Country</label>

                        <select class="form-control countries" name="country_name" id="countryId" required="">

                            <option value="">--select country--</option>

                        </select>

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label>State</label>

                        <select class="form-control states" name="state_name" id="stateId" required="">

                            <option value="">--select State--</option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label>City</label>

                        <select class="form-control cities" name="city_name" id="cityId" required="">

                            <option value="">--select city--</option>

                        </select>

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label></label>

                        

                    </div>

                </div>

                  <div class="row">

                      <div class="form-group col-lg-12 col-md-12 col-xs-12">

                          <label>Address:-</label>

                          <textarea class="form-control" name="address" required="" value="<?= set_value('address'); ?>"></textarea>

                      </div>

                  </div>

                  <div class="row">

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>PIN CODE</label>

                          <input type="text" name="pin_code" class="form-control" maxlength="10" required="" value="<?= set_value('pin_code'); ?>">

                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>Mobile No.</label>

                          <input type="text" name="mobile_no" class="form-control" maxlength="10" required="" value="<?= set_value('mobile_no'); ?>">

                      </div>

                  </div><hr>

                  <div class="row">

                      <div class="col-lg-12 col-md-12 col-xs-12">

                          <label><u>Sign Up Account Details</u></label>

                      </div>

                  </div>

                  <div class="row">

                      <div class="form-group col-lg-12 col-md-12 col-xs-12">

                          <label>Email ID</label>

                          <div class="input-group">

                              <input type="email" name="email_id" id="emailCheck" class="form-control" placeholder="Enter Email ID" required="" value="<?= set_value('email_id'); ?>">

                            <div class="input-group-addon">

                                <label class="red" style="" id="emailMsg">&nbsp;</label>

                            </div>

                          </div>

                      </div>

                      <div class="form-group col-lg-2 col-md-2 col-xs-12 ">

                          

                      </div>

                  </div>

                  <div class="row">

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>Password</label>

                          <input type="password" name="password" class="form-control" id="NewPassword" minlength="8" maxlength="32" placeholder="Enter Password length 8-32 character " required="">

                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>Confirm Password</label>

                          <input type="password" name="cpassword" class="form-control" id="ConfirmPassword" minlength="8" maxlength="32" placeholder="Enter Confirm Password length 8-32 character " required="">

                      </div>

                      <div class="form-group col-lg-12 col-md-12 col-xs-12">

                          <label id="divCheckPasswordMatch"></label>

                      </div>

                  </div>

                  <div class="row">

                      <div class="form-group col-lg-4 col-md-4 col-xs-12">

                        <label>Duration</label>

                        <select class="form-control" name="duration" id="durationValue">

                            <option value="0">15 Days's</option>

                            <option value="1">1 Month</option>

                            <option value="2">2 Month's</option>

                            <option value="3">3 Month's</option>

                            <option value="4">4 Month's</option>

                            <option value="5">5 Month's</option>

                            <option value="6">6 Month's</option>

                            <option value="7">7 Month's</option>

                            <option value="8">8 Month's</option>

                            <option value="9">9 Month's</option>

                            <option value="10">10 Month's</option>

                            <option value="11">11 Month's</option>

                            <option value="12">12 Month's</option>

                            <option value="custom">Custom</option>

                        </select>

                    </div>

                      <div class="col-lg-3 col-md-3 col-xs-12" id="dateSelect" style="display: none;">

                          <?php $month = (new DateTime())->format('d-F-Y'); ?>

                          <label>Select Future Date</label>

                          <input type="text" name="customDate" id="datepicker1" class="form-control date-range-filter" value="<?= $month; ?>" readonly="" style="background-color: white; cursor: pointer; text-align: left;">

                      </div>

                      <div class="form-group col-lg-3 col-md-3 col-xs-12">

                          <label>Select Account Type</label>

                          <select class="form-control" name="expired_role" required="">

                              <option value="">--select--</option>

                              <option value="0">Demo Account</option>

                              <option value="1">Current Account</option>

                          </select>

                      </div>

                      <div class="form-group col-lg-2 col-md-3 col-xs-12">

                          <label>Select Device</label>

                          <select class="form-control" name="device" required="">

                              <option value="">--select--</option>

                              <option value="1">Single Device</option>

                              <option value="2">Multi Devices</option>

                          </select>

                      </div>

                  </div>

              </div>

              <!-- /.box-body -->

              <div class="row">

                <div class="box-footer">

                    <input type="submit" name="submit" class="btn btn-primary" value="save & close">

                    <!--<button type="submit" name="submit" class="btn btn-primary">save & close</button>-->

                    <button type="reset" class="btn btn-default">Reset</button>

                </div>

              </div>

          </div>

              

            <?php echo form_close( ); ?>

          </div>

          <!-- /.box-body -->

      </div>

    </div>

  </div>  

</section> 



<!--Email Enter then backend check to detail then responses-->

<script>

$(document).ready(function(){

    $('#emailCheck').on('keyup', function(){

        var email = $(this).val();

        $.ajax({

            url:'<?= site_url('check_email'); ?>',

            type:'post',

            data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', email:email},

            success:function(data){

                $('#emailMsg').html(data);

            }

        });

        

    });

});

</script>



<script>

$(document).ready(function(){

    $('select[id^="durationValue"]').on('change', function(){

        var value = $(this).val();

        if(value == 'custom'){

            $('#dateSelect').show();

        }else{

           $('#dateSelect').hide();

        }

    });

});

</script>



<!--Select custom then open calender-->

<script>

    $(function () {

    var today = new Date();

 //Start Date picker

    $('#datepicker1').datepicker({

      format:'d-MM-yyyy',

      //autoclose: true,

      //maxDate: today,

     // endDate: "today",

    });

});

</script>

<!--Password Match -->

<script>

$(function() {

    $("#ConfirmPassword").keyup(function() {

        var password = $("#NewPassword").val();

        $("#divCheckPasswordMatch").html(password == $(this).val() ? "<span style='color:green;'>Passwords match.</span>" : "<span style='color:red;'>Passwords do not match!</span>");

    });



});

</script>





<script>

$("#add_user").addClass('active');

</script>    



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 

<!-- <script src="http://geodata.solutions/includes/countrystatecity.js"></script> -->
<script src="<?= base_url('public/countryState/countrystatecity.js');?>"></script>