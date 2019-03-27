<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
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
 table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    min-width: 120px;
}
</style>
<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<section class="content">
    <div class="row">
        <?php //echo form_open(base_url('admin/Survey_C/addSurvey'), 'class="form-horizontal"'); ?> 
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">My Account</h3>
                    </div>

                    <div class="box-body">
                        <center>
                            <i class="fa fa-user" style="font-size: 80px; color: gray; margin-bottom: 20px;"></i><br>
                            <label><b><?= $account->first_name; ?> <?= $account->last_name; ?></b></label><br>
                            <label> Admin <?php // $account->user_name; ?></label>
                        </center><br>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="col-md-5">
                                <label><b>Restaurant Name : <?= $account->name; ?></b></label><br>
                                <label>Email : <?= $account->email; ?></label><br>
                                 <label>Mobile No. : <?= $account->mobile; ?></label><br>
                                 
                            </div>
                            <?php
                            $total_amt = 0;
                            $discount = 0;
                            $actual_total = 0;
                            $tax = 0;
                            if($transition){
                                foreach ($transition as $count=>$row):
                                    if($row->STATUS=='success'){
                                        $total_amt += $row->TXN_AMOUNT;
                                        $discount += $row->discount;
                                    }
                                endforeach;
                                $tax = ($total_amt*$this->pay_tax['for'])/100;
                                $actual_total = $total_amt - $tax;
                            }
                            ?>
                            <div class="col-md-7">
                                <div class="pull-right col-md-8">
                                    <div class="row">
                                        <div class="small-box bg-teal card">
                                            <div class="inner" style="color:green;">
                                                <h3><?= $total_amt?>/-<sup style="font-size: 20px"></sup></h3>

                                                <p>Total Amount</p>
                                            </div>
                                            <div class="icon" style="color:green;">
                                                <i class="fa fa-inr"></i>
                                            </div>
                                            <a class="small-box-footer" id="trans_more" style="cursor: pointer;">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                        &nbsp;<br>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default" id="chg_psw"><i class="fa fa-key"></i> Change Password</button>
                            <button type="button" class="btn btn-success" id="Transition_click"><i class="fa fa-inr"></i> Transition History</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box" style="display: none;" id="chg_psw_open">
                    <div class="box-header with-border">
                        <h3 class="box-title">Change Password</h3>
                    </div>
                    <?php echo form_open(base_url('admin/LoginController/change_pwd'), 'class="form-horizontal"');  ?> 
                    <div class="box-body">
                        <div class="form-group">
                            <div>
                                <label>New Password</label>
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" required="">
                            </div><br>
                            <div>
                                <label>Confirm Password</label>
                            </div>
                            <div>
                                <input type="password" name="confirm_pwd" class="form-control" required="">
                            </div><br>
                            <div>
                                <input type="submit" name="submit" value="Change" class="btn btn-success pull-right">
                            </div>
                        </div>
                    </div>
                     <?php echo form_close( ); ?>
                </div>
                <!--Total Amount Column in click view more then other function div open-->
                <div class="box" style="display: none;" id="trans_amount_more">
                    <div class="box-header with-border">
                        <h3 class="box-title">More Transition Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table class="table table-striped" style="font-size: 20px;">
                                <thead>
                                    <tr><td>Sub Total</td><td>:</td><td><i class="fa fa-inr"></i> <?= $actual_total; ?>/-</td></tr>
                                    <tr><td>TAX</td><td>:</td><td><i class="fa fa-inr"></i> <?= $tax; ?>/-</td></tr>
                                    <tr><td>Discount</td><td>:</td><td><i class="fa fa-inr"></i> <?= $discount; ?>/-</td></tr>
                                    
                                <tr style="background-color: lightgray;"><td>Total Amount</td><td>:</td><td><i class="fa fa-inr"></i> <b><?= $total_amt; ?>/-</b></td></tr>
                                </thead>
                            </table>
                                                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> <!--My Account basic detail view End Div-->
        <div class="col-md-12">
            <div class="col-md-8">
                <!--Transition History-->
                <div class="box" style="display: none;" id="Transition_history">
                    <div class="box-header">
                        <h3 class="box-title">Transition History</h3>
                    </div>
                    <div class="box-body" >
                        <table class="table table-hover table-striped table-bordered table-responsive" id="transition_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TXT ID</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($transition){
                                    foreach ($transition as $count=>$row):
                                        ?>
                                <tr>
                                    <td><?= $count+1; ?></td>
                                    <td><?= $row->TxtID; ?></td>
                                    <td><?= $row->TXN_AMOUNT; ?></td>
                                    <td><?= $row->discount; ?></td>
                                    <td><?= $row->STATUS; ?></td>
                                    <td><?= $row->mode; ?></td>
                                    <td><?= date('d-M-Y', strtotime($row->TXNDATE)); ?></td>
                                </tr>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if($this->session->userdata('role_id')==2){ //this condition check to view this function other wise never view 
        ?>
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subscription</h3>
                    </div>

                    <div class="box-body">
                        <p>After the free evaluation, Elegant Surveys is billed depending the number of devices connected.</p>
                        <label></label>
                        <div class="">
                            <a href="<?= site_url('admin/payment/upgrade'); ?>" class="btn btn-success">View Plan / Upgrade  <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account Payment End Div-->
        <?php
            }
        ?> 
        <?php
            if($this->session->userdata('role_id')==2 || $this->session->userdata('m_role_id')==11){ //this condition check to view this function other wise never view 
        ?>
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Invoices</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Invoice No.</th>
                                <th>Devices</th>
                                <th>Invoice Date</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($invoice as $row=>$data): ?>
                                <tr>
                                    <td><?= $data->ORDER_ID; ?></td>
                                    <td><?php if($data->device==1){echo 'Single Device';}elseif($data->device==2){echo 'Multi Device';} ?></td>
                                    <td><?= date('d-M-Y', strtotime($data->TXNDATE)); ?>, <?= date('H:i A', strtotime($data->TXNDATE)); ?></td>
                                    <td><?= $data->TXN_AMOUNT; ?>.00</td>
                                    <td><?= $data->discount; ?>.00</td>
                                    <td>
                                        <a href="<?= base_url('admin/invoice/view/'.$data->id); ?>" target="_blank" style="cursor: pointer;"><i class="fa fa-eye" style="color:green;"></i></a>
                                        &nbsp;&nbsp;<a href="<?= base_url('admin/pdfGenerate/pdf/'.$data->id); ?>" target="_blank" style="cursor: pointer;"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account Invoices End Div-->
        <?php
                
            }
        ?>
        
        
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Authorized Users</h3>
                    </div>

                    <div class="box-body">
                        <div>
                            <label>Share read-only access to other users within your company for specific devices.</label>
                        </div><br>
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Role</th>
                             <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <th>Action</th>
                             <?php } ?>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($users as $count=>$row):
                                 ?>
                                <tr>
                                    <td><?= $row->m_first_name; ?> <?= $row->m_last_name; ?></td>
                                    <td><?= $row->m_mobile; ?></td>
                                    <td><?= $row->m_email; ?></td>
                                    <td>
                                    <?php if($row->m_role_id==11)
                                        { echo "Account Admin";  } 
                                        else{ echo "Regular User";} ?>
                                    </td>
                             <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                     <td>
                                        <a style="text-decoration: none; color: white;" href="<?= site_url('admin/Users/edit/'.$row->m2_id); ?>">
                                            <i class="fa fa-edit" style="color:green; font-size: 20px;"></i></a> &nbsp;
                                        <span style="cursor: pointer;" id="dialog<?= $count; ?>" data-id="<?= $row->m2_id; ?>" data-email="<?= $row->m_email;?>"><i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>
                                        <!--<input type="button" class="btn btn-danger btn-xs" value="Delete" id="dialog<?= $count; ?>" data-id="<?= $row->m2_id; ?>" data-email="<?= $row->m_email; ?>">-->
                                     </td>
                             <?php } ?>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                                
                            </tbody>
                        </table><br>
                         <?php if($adminRole == 2 || $otherRole == 11){ ?>
                        <div class="col-md-12">
                            <button class="btn btn-default" data-popup-open="popup-1" ><i class="fa fa-plus"></i> Add User</button>
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account User End Div-->
        
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Staff</h3>
                    </div>

                    <div class="box-body">
                        <div>
                            <label>Share read-only access to other users within your company for specific devices.</label>
                        </div><br>
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Code</th>
                                <th>Address</th>
                         <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <th>Action</th>
                         <?php } ?>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($waiter as $count=>$row):
                                 ?>
                                <tr>
                                    <td><?= $row->waiter_name; ?> </td>
                                    <td><?= $row->waiter_mobile; ?></td>
                                    <td><b><?= $row->waiter_code; ?></b></td>
                                    <td><?= $row->waiter_add; ?></td>
                         <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                     <td>
                                        <a style="text-decoration: none; color: white;" href="<?= site_url('admin/MyAccount_C/waiter_edit/'.$row->waiter_id); ?>" >
                                        <i class="fa fa-edit" style="color:green; font-size: 20px;"></i></a>&nbsp;
                                        <span style="cursor: pointer;" id="dialog_w<?= $count; ?>" data-id="<?= $row->waiter_id ?>" data-code="<?= $row->waiter_code; ?>" data-mobile="<?= $row->waiter_mobile; ?>">
                                            <i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>
                                        <!--<input type="button" class="btn btn-danger btn-xs" value="Delete" id="dialog_w<?= $count; ?>" data-id="<?= $row->waiter_id ?>" data-code="<?= $row->waiter_code; ?>" data-mobile="<?= $row->waiter_mobile; ?>">-->
                                    </td>
                         <?php } ?>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                                
                            </tbody>
                        </table><br>
                     <?php  if($adminRole == 2 || $otherRole == 11){ ?>
                        <div class="col-md-12">
                            <button class="btn btn-default" data-popup-open="waiter-popup" ><i class="fa fa-plus"></i> Add Staff</button>
                        </div>
                     <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account waiter End Div-->
        <div class="popup" data-popup="popup-1">
             
            <div class="popup-inner">
                <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
            
           <?php echo form_open(base_url('admin/users/add'), 'class="form-horizontal"');  ?> 
           <input type="hidden" name="member_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">
           <div class="col-md-12">
                <h3>Authorized User</h3>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    <div class="col-md-3">
                        <label for="firstname" class="control-label">First Name</label>
                    </div>
                <div class="col-md-9">
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="" required="">
                </div>
              </div>
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="lastname" class="control-label">Last Name</label>
                  </div>
                <div class="col-md-9">
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="" required="">
                </div>
              </div>
<!--                <div class="form-group col-md-12">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-9">
                        <label id="viewEmail"></label>
                    </div>
                </div>-->
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="mobile_no" class="control-label">Mobile No</label>
                  </div>
                <div class="col-md-9">
                    <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="" required="">
                </div>
              </div>
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="email" class="control-label">Email</label>
                  </div>
                <div class="col-md-9">
                    <div class="">
                        <input type="email" name="email" class="form-control" id="email" placeholder="" required="">
                        <label id="viewEmail" class=""></label>
                    </div>
                   
                </div>
              </div>
<!--              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="user_name" class="control-label">User Name</label>
                  </div>
                <div class="col-md-9">
                    <input type="text" name="m_user_name" class="form-control" id="username" placeholder="" required="">
                </div>
              </div>-->
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="password" class="control-label">Password</label>
                  </div>
                <div class="col-md-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="" required="">
                </div>
              </div>
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="role" class="control-label">Select Role</label>
                  </div>
                <div class="col-md-9">
                    <select name="user_role" class="form-control" required="">
                    <option value="">Select Role</option>
                    <option value="11">Admin</option>
                    <option value="12">User</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-9"><a data-popup-close="popup-1" class="btn btn-danger pull-right" style="margin-right: -21px;" href="#">Close</a></div>
                    <div class="col-md-3"><input type="submit" name="submit" value="Add User" class="btn btn-info"></div>
                </div>
              </div>
            <?php echo form_close( ); ?>
                <!--p><a data-popup-close="popup-1" href="#">Close</a></p-->
                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
            </div>
        
            </div>
        </div>
        
        <!--waiter popup open-->
        <div class="popup" data-popup="waiter-popup">
            <div class="popup-inner">
                <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
            
           <?php echo form_open(base_url('admin/MyAccount_C/waiter_add'), 'class="form-horizontal"');  ?> 
           <input type="hidden" name="wmember_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">
           <div class="col-md-12">
                <h3>Staff</h3>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    <div class="col-md-3">
                        <label for="firstname" class="control-label">Full Name</label>
                    </div>
                <div class="col-md-9">
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter a Name" required="">
                </div>
              </div>
            
              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="mobile_no" class="control-label">Mobile No.</label>
                  </div>
                <div class="col-md-9">
                    <div class="">
                        <input type="number" name="m_number" class="form-control" id="m_number" placeholder="" required="">
                        <label id="viewNumber" class=""></label>
                    </div>
                </div>
              </div>
                 <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="address" class="control-label">Address</label>
                  </div>
                <div class="col-md-9">
                    <textarea name="address" class="form-control" rows="3"></textarea>
                    <!--<input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="" required="">-->
                </div>
              </div>
<!--              <div class="form-group col-md-12">
                  <div class="col-md-3">
                      <label for="password" class="control-label">Password</label>
                  </div>
                <div class="col-md-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="" required="">
                </div>
              </div>-->
              <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-9"><a data-popup-close="waiter-popup" class="btn btn-danger pull-right" style="margin-right: -21px;" href="#">Close</a></div>
                    <div class="col-md-3"><input type="submit" name="submit" value="Add Staff" class="btn btn-info"></div>
                </div>
              </div>
            <?php echo form_close( ); ?>
                <!--p><a data-popup-close="popup-1" href="#">Close</a></p-->
                <a class="popup-close" data-popup-close="waiter-popup" href="#">x</a>
            </div>
        
            </div>
        </div>
        
    </div>

    <?php //echo form_close(); ?>
 
</section> 
<!--DataTables--> 
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$('#transition_table').DataTable({
    scrollX : true,
    //searching : false,
});
</script>

<script>
    $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
    e.preventDefault();
    });
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e) {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
    e.preventDefault();
    });
    });

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
<script>
    $(document).ready(function() {
        $('#email').on('keyup', function() {
            var email = $(this).val();
            //alert(email);
            $.ajax({
                url:"<?= site_url('admin/Responses_C/get_email')?>",
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','email':email},
                success: function(data){
                    $('#viewEmail').html(data);
                }
            });
        });
        
        //waiter number check
        $('#m_number').on('keyup', function() {
            var m_number = $(this).val();
            //alert(email);
            $.ajax({
                url:"<?= site_url('admin/MyAccount_C/get_number')?>",
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','m_number':m_number},
                success: function(data){
                    $('#viewNumber').html(data);
                }
            });
        });
    });
</script>

<!--If select user delete button than open popup box and click button confirm than data delete script -->
<script>
 //$(document).ready(function(){
      <?php foreach ($users as $devices_count=> $devices_data): ?>
        $('#dialog<?= $devices_count; ?>').on('click', function () {
            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");
            var email = $('#dialog<?= $devices_count; ?>').attr("data-email");
//            alert(value);
//            alert(email);
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete User',
                content: 'This will disconnect this device from your account. Data sycned from this device will be orphaned.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                        //$.alert('Confirmed!');
                       $.ajax({
                           url:'<?= site_url('admin/Users/del'); ?>',
                           type:'post',
                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', user_id:value, emaildelete:email},
                           success: function(data){
                               $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Delete User',
                                    content: 'Successfully Delete User.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.reload();
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
   <?php endforeach; ?>
//});
</script>

<!--If select staff delete button than open popup box and click button confirm than data delete script waiter list to delete data-->
<script>
 //$(document).ready(function(){
      <?php foreach ($waiter as $devices_count=> $devices_data): ?>
        $('#dialog_w<?= $devices_count; ?>').on('click', function () {
            var value = $('#dialog_w<?= $devices_count; ?>').attr("data-id");
            var code = $('#dialog_w<?= $devices_count; ?>').attr("data-code");
            var mobile = $('#dialog_w<?= $devices_count; ?>').attr("data-mobile");
//            alert(value);
//            alert(code);
//            alert(mobile);
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Staff',
                content: 'This will disconnect this device from your account. Data sycned from this device will be orphaned.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                        //$.alert('Confirmed!');
                       $.ajax({
                           url:'<?= site_url('admin/MyAccount_C/w_del/'); ?>',
                           type:'post',
                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', waiter_id:value, witerCodeDelete:code, witerMobileDelete:mobile},
                           success: function(data){
                               $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Delete Staff',
                                    content: 'Successfully Delete User.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.reload();
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
   <?php endforeach; ?>
//});
</script>
<script>
    $("#myAccount").addClass('active');
</script>    

<script>
    $(document).ready(function () {
        $("#chg_psw").click(function(){
            $("#chg_psw_open").toggle('slow');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#Transition_click").click(function(){
            $("#Transition_history").toggle('slow');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#trans_more").click(function(){
            $("#trans_amount_more").toggle('slow');
        });
    });
</script>