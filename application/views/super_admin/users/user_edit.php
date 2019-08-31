<style>

    .box-add{

        margin: 15px;

        //width: 90%;

        padding: 20px;

    }

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

           

            <?php echo form_open(base_url('super_admin/users/edit/'.$user['restaurant_id']), 'class=""');  ?> 

            <div class="">

              <div class="">

                  <div class="row">

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                      <label>First Name</label>

                      <input type="text" name="f_name" class="form-control" placeholder="Enter First Name" required="" value="<?= set_value('f_name',$user['first_name']); ?>">

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                      <label for="exampleInputPassword1">Last Name</label>

                      <input type="text" name="l_name" class="form-control" placeholder="Enter Last Name" required="" value="<?= set_value('l_name',$user['last_name']); ?>">

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-lg-12 col-md-12 col-xs-12">

                      <label>Restaurant Name</label>

                      <input type="text" name="res_name" class="form-control" placeholder="Enter Restaurant Name" required="" value="<?= set_value('res_name',$user['name']); ?>">

                      <p class="help-block">Full name your Restaurant...</p>

                    </div>

                </div>

                  <!--1. Country, 2. State 3. District show if change click change area-->

                  <div class="row">

                      <div class="col-lg-12">

                          <label>* <?= $user['r_country']?> -> <?= $user['r_state'] ?> -> <?= $user['r_city']?></label>

                      &nbsp;&nbsp;<button type="button" onclick="area_open(this)" data-status="0" class="btn btn-danger btn-xs">Change</button>

                      </div>

                  </div>

                  <div id="area_change" style="display: none;">

                <div class="row">

                    <div class="formm-group col-lg-6 col-md-6 col-xs-12">

                        <label>Country</label>

                        <select class="form-control countries" name="country_name" id="countryId">

                            <option value="">--select country--</option>

                        </select>

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label>State</label>

                        <select class="form-control states" name="state_name" id="stateId">

                            <option value="">--select State--</option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label>City</label>

                        <select class="form-control cities" name="city_name" id="cityId">

                            <option value="">--select city--</option>

                        </select>

                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">

                        <label></label>

                        

                    </div>

                </div>

                </div>  

                  <div class="row">

                      <div class="form-group col-lg-12 col-md-12 col-xs-12">

                          <label>Address:-</label>

                          <textarea class="form-control" name="address" required="" ><?= set_value('address',$user['r_address']); ?></textarea>

                      </div>

                  </div>

                  <div class="row">

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>PIN CODE</label>

                          <input type="text" name="pin_code" class="form-control" maxlength="10" required="" value="<?= set_value('pin_code',$user['r_pin_code']); ?>">

                      </div>

                      <div class="form-group col-lg-6 col-md-6 col-xs-12">

                          <label>Mobile No.</label>

                          <input type="text" name="mobile_no" class="form-control" maxlength="10" required="" value="<?= set_value('mobile_no',$user['mobile']); ?>">

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

                          <input type="email" name="email_id" class="form-control" placeholder="Enter Email ID" required="" value="<?= set_value('email_id',$user['email']); ?>" disabled="">

                      </div>

            

                      <div class="row">

                          <div class="col-lg-12">

                              <div class="form-group col-lg-4 col-md-4 col-xs-12">

                                  <label>Duration</label>

                                  <select class="form-control" name="duration" id="durationValue">

                                      <option value="111" <?php if (!empty($user['duration'])) if ($user['duration'] == '111') echo 'selected'; ?> >15 Days's</option>

                                      <option value="1" <?php if (!empty($user['duration']) == '1') if ($user['duration'] == '1') echo 'selected'; ?> >1 Month</option>

                                      <option value="2" <?php if (!empty($user['duration']) == '2') if ($user['duration'] == '2') echo 'selected'; ?> >2 Month's</option>

                                      <option value="3" <?php if (!empty($user['duration']) == '3') if ($user['duration'] == '3') echo 'selected'; ?> >3 Month's</option>

                                      <option value="4" <?php if (!empty($user['duration']) == '4') if ($user['duration'] == '4') echo 'selected'; ?> >4 Month's</option>

                                      <option value="5" <?php if (!empty($user['duration']) == '5') if ($user['duration'] == '5') echo 'selected'; ?> >5 Month's</option>

                                      <option value="6" <?php if (!empty($user['duration']) == '6') if ($user['duration'] == '6') echo 'selected'; ?> >6 Month's</option>

                                      <option value="7" <?php if (!empty($user['duration']) == '7') if ($user['duration'] == '7') echo 'selected'; ?> >7 Month's</option>

                                      <option value="8" <?php if (!empty($user['duration']) == '8') if ($user['duration'] == '8') echo 'selected'; ?> >8 Month's</option>

                                      <option value="9" <?php if (!empty($user['duration']) == '9') if ($user['duration'] == '9') echo 'selected'; ?> >9 Month's</option>

                                      <option value="10" <?php if (!empty($user['duration']) == '10') if ($user['duration'] == '10') echo 'selected'; ?> >10 Month's</option>

                                      <option value="11" <?php if (!empty($user['duration']) == '11') if ($user['duration'] == '11') echo 'selected'; ?> >11 Month's</option>

                                      <option value="12" <?php if (!empty($user['duration']) == '12') if ($user['duration'] == '12') echo 'selected'; ?> >12 Month's</option>

                                      <option value="custom" <?php if (!empty($user['duration']) == 'custom') if ($user['duration'] == 'custom') echo 'selected'; ?> >Custom</option>

                                  </select>

                              </div>

                              <div class="col-lg-3 col-md-3 col-xs-12" id="dateSelect" style="display: none;">

                                  <?php $month = (new DateTime())->format('d-F-Y'); ?>

                                  <label>Select Future Date</label>

                                  <input type="text" name="customDate" id="datepicker1" class="form-control date-range-filter" value="<?= set_value($month, date('d-F-Y', strtotime($user['expired_date']))); ?>" readonly="" style="background-color: white; cursor: pointer; text-align: left;">

                              </div>

                              <div class="col-lg-3 col-md-3 col-xs-12" id="dateSelect2" style="display: none;">

                                  <label>Select Future Date</label>

                                  <input type="text" class="form-control date-range-filter" id="viewDate" value="<?= set_value($month, date('d-F-Y', strtotime($user['expired_date']))); ?>" readonly="" style="background-color: white; cursor: pointer; text-align: left;">

                              </div>

                              <div class="form-group col-lg-3 col-md-3 col-xs-12">

                                  <label>Select Account Type</label>

                                  <select class="form-control" name="expired_role" required="">

                                      <option value="">--select--</option>

                                      <option value="0" <?php if ($user['expired_role'] == 0) echo 'selected'; ?> >Demo Account</option>

                                      <option value="1" <?php if ($user['expired_role'] == 1) echo 'selected'; ?> >Current Account</option>

                                  </select>

                              </div>

                              <div class="form-group col-lg-2 col-md-3 col-xs-12">

                                  <label>Select Device</label>

                                  <select class="form-control" name="device" required="">

                                      <option value="">--select--</option>

                                      <option value="1" <?php if ($user['device'] == 1) echo 'selected'; ?> >Single Device</option>

                                      <option value="2" <?php if ($user['device'] == 2) echo 'selected'; ?> >Multi Devices</option>

                                  </select>

                              </div>

                          </div>

                      </div>

                      <div class="row">

                          <div class="col-lg-12">

                              <div class="col-lg-12">

                                  <b style="color:red;">Expired Date Is:- <?= date('d-F-Y', strtotime($user['expired_date'])) ?></b>

                              </div>

                          </div>

                      </div>

              </div>&nbsp;<br>

              <!-- /.box-body -->

              <div class="row">

                <div class="box-footer">

                    <input type="submit" name="submit" class="btn btn-primary" value="save & close">

                    <!--<button type="submit" name="submit" class="btn btn-primary">save & close</button>-->

                    <button type="reset" class="btn btn-default"><i class="fa fa-recycle"></i> Reset</button>

                    <button type="button" class="btn btn-default" data-popup-open="password_Change" ><i class="fa fa-key"></i> Change Password</button>&nbsp;&nbsp;

                </div>

              </div>

          </div>

              

            <?php echo form_close( ); ?>

          </div>

          <!-- /.box-body -->

      </div>

    </div>

  </div> 

    

    <!--Change Password Popup box-->

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

            

           <?php echo form_open(base_url('super_admin/Users/edit/'.$user['restaurant_id']), 'class="form-horizontal"');  ?> 

           <input type="hidden" name="email" value="<?= $user['email']; ?>">

           <div class="col-md-12">

                <h3>Change Password</h3>

               

           </div>&nbsp;<br>

            <div class="col-md-12">

                <div class="form-group col-md-12">

                    <div class="col-md-4">

                        <label for="firstname" class="control-label">Password : </label>

                    </div>

                <div class="col-md-8">

                    <input type="password" name="password" id="password1" class="form-control" minlength="8" maxlength="32" placeholder="Enter Password length 8-32 character " required="">

                </div>

              </div>

                <div class="form-group col-md-12">

                    <div class="col-md-4">

                        <label for="cpassword" class="control-label">Confirm Password : </label>

                    </div>

                <div class="col-md-8">

                    <input type="password" name="cpassword" id="password2" class="form-control" minlength="8" maxlength="32" placeholder="Confirm Password length 8-32 character " required="">

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

</section> 



<!--if change area then click change button-->

<script>

function area_open(current){

    var check = $('#area_change').toggle('slow');

    var id = $(current).data('status');

    //alert(id);

    if(id == 0){

        $.ajax({

            type:'get',

            data:{},

            success:function(){

               // alert('id- 0');

                $(current).addClass('btn-success');

                $(current).removeClass('btn-danger');

                $(current).data('status',1);

            }

        });

    }else if(id == 1){

        $.ajax({

            type:'get',

            data:{},

            success:function(){

               // alert('else condi');

                $(current).removeClass('btn-success');

                $(current).addClass('btn-danger');

                $(current).data('status',0);

            }

        });

    }

    

}

</script>



<script>

$(document).ready(function(){

   

    $('select[id^="durationValue"]').on('change', function(){

        var value = $(this).val();

        //alert(value);

         if(value){

            $.ajax({

                url:'<?= site_url('future_date'); ?>',

                type:'post',

                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', value:value, id:<?= $user['restaurant_id'];?>},

                success:function(data){

                    $('#datepicker1').val(data);

                    $('#viewDate').val(data);

                }

            });

           

        }

    });

});

</script>

<!--<script>

$(document).ready(function(){

    var value = $('#durationValue').val();

    if(value == 'custom'){

            $('#dateSelect').show();

        }

    $('select[id^="durationValue"]').on('change', function(){

        var value = $(this).val();

        if(value == 'custom'){

            $('#dateSelect').show();

        }else{

           $('#dateSelect').hide();

        }

    });

});

</script>-->



<!--Select custom then open calender-->

<script>

    $(document).ready(function () {

    var today = new Date();

    var dur = $('#durationValue').val();

        if(dur == 'custom'){

            $('#dateSelect').show();

            $('#dateSelect2').hide();

            $('#datepicker1').datepicker({

             format:'d-MM-yyyy',

             //autoclose: true,

             //maxDate: today,

             //endDate: "today",

           });

        }else{

            $('#dateSelect').hide();

            $('#dateSelect2').show();

        }

    $('select[id^="durationValue"]').on('change', function(){

        var duration = $(this).val();

        //Start Date picker

        if(duration == 'custom'){

            $('#dateSelect').show();

            $('#dateSelect2').hide();

            $('#datepicker1').datepicker({

             format:'d-MM-yyyy',

             //autoclose: true,

             //maxDate: today,

             //endDate: "today",

           });

        }else{

            $('#dateSelect').hide();

            $('#dateSelect2').show();

        }

    });

});

</script>





<!--Change password popup box open if click change password-->

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

<!--Password Match -->

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

$("#edit_user").addClass('active');

</script>    



<!-- daterangepicker -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

  <script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>

  

  

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 

<!-- <script src="http://geodata.solutions/includes/countrystatecity.js"></script> -->
<script src="<?= base_url('public/countryState/countrystatecity.js');?>"></script>