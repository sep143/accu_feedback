<?php
if($get_res){
    //$current = new DateTime();
    $now = (new DateTime())->format('Y-m-d');
    $XD = date('Y-m-d', strtotime($get_res->expired_date));
    $total_amount = 0;
    $total_actual = 0;
    $dicount_total = 0;
    foreach ($payment_all as $count=> $value):
        $total_amount += $value->TXN_AMOUNT;
        $dicount_total += $value->discount;
    endforeach;
    $tax = ($total_amount*$this->pay_tax['for'])/100;
    $total_actual = $total_amount - $tax;
    ?>
<div class="row">
    <div class="col-lg-12 form-group">
        <div class="col-lg-3">
            <label>Restaurant ID : <?= $get_res->restaurant_id; ?></label>&nbsp;<br>
            <label>Restaurant Name : <?= $get_res->last_name; ?></label><br>
            <label>First Name : <?= $get_res->first_name; ?></label><br>
            <label>Last Name : <?= $get_res->last_name; ?></label><br>
            <label>Email ID : <b><?= $get_res->email; ?></b></label><br>
            <label>Mobile No. : <b><?= $get_res->mobile; ?></b></label><br>
            <br>
            <label>Address : </label>
            <address class="">
               <b> <?= $get_res->r_address ?>, <br><?= $get_res->r_city; ?>, <?= $get_res->r_state ?>, <?= $get_res->r_country ?><br> PIN CODE : <?= $get_res->r_pin_code?>
            </b></address>
        </div>
        <div class="col-lg-4">
            <label>Create Date : <input type="text" class="form-control" value="<?= date('d-F-Y', strtotime($get_res->create_date)); ?>" readonly=""></label>
            <label>Expired Date : <input type="text" style="<?php if($now <= $XD){ echo 'color:green;';}else{ echo 'color:red;';}?>"  class="form-control" value="<?= date('d-F-Y', strtotime($get_res->expired_date)); ?>" readonly=""></label>
            &nbsp;<br><br><br><br>
            <div class="small-box bg-teal card">
                <div class="inner">
                    <h3 style="color:green;"><?= $total_amount; ?>.00</h3>

                    <p>Total Amount</p>
                </div>
                <div class="icon">
                    <i class="fa fa-inr"></i>
                </div>
                <a href="<?= site_url('super_admin/users/view/' . $get_res->restaurant_id); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <div class="card form-group">
                <button type="button" class="form-control btn btn-warning" onclick="devices(this)" data-status="0">Device Active</button>
            </div>
            <!--Expired date show-->
            <div>
                <b> <i style="color:red;">Expired Date : <span id="viewDate1" style="<?php if($now <= $XD){ echo 'color:green;';}else{ echo 'color:red;';}?>"><?= date('d-F-Y', strtotime($get_res->expired_date)); ?></span></i></b>
                
            </div>
        </div>
        <div class="col-lg-5">
            <label>Device : <input type="text" class="form-control" style="color:red; font: bold;" value="<?php if($get_res->device==1){ echo 'Single Device';}else{ echo 'Multi Device';}; ?>" readonly=""></label>
            <label>Role : <input type="text" class="form-control" value="<?php if($get_res->expired_role==0){ echo 'Demo A/C';}else{ echo 'Current A/C';}; ?>" readonly=""></label>
            <label>Account Status : <input type="text" class="form-control" value="<?php if($get_res->expired_role==1){ echo 'Active';}else{ echo 'Inactive';}; ?>" readonly=""></label>
            <label>Account Create : <input type="text" class="form-control" value="<?php if($get_res->web==0){ echo 'Web Site';}else{ echo 'Admin';}; ?>" readonly=""></label>
            &nbsp;<br><br>
            <?php
            //last five transition view only query in use limit 5
            $last_five = 0;
            $five_actual = 0;
    foreach ($payment as $total):
        $last_five += $total->TXN_AMOUNT;
        
    endforeach;
        $tax = round(($last_five*$this->pay_tax['for'])/100);
        $five_actual = round($last_five - $tax);
            ?>
            <label style="color:red;">Last Five Transition : &nbsp;<b style="color:green;"> <?= $last_five; ?>.00 <i class="fa fa-inr"></i></b> Actual Amount: <?= $five_actual; ?>/- TAX: <?= $tax; ?>/-</label>&nbsp;<br>
            <table class="table table-bordered table-hover table-responsive" style="border: 3px solid black;">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Invoice No.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Mode</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($payment){
                    foreach ($payment as $count=> $row):
                        ?>
                    <tr>
                        <td><?= $count+1; ?></td>
                        <td><?= $row->ORDER_ID; ?></td>
                        <td><?= date('d-M-Y', strtotime($row->TXNDATE)); ?></td>
                        <td><?= $row->TXN_AMOUNT; ?>.00</td>
                        <td><?= $row->mode; ?></td>
                    </tr>
                    <?php
                    endforeach;
                    }
                    ?>
                </tbody>
            </table>
            <p style="color:green;">Only Success Transition Amount Calculate :</p>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Actual AMT</th>
                        <th>TAX AMT</th>
                        <th>TOTAL AMT</th>
                        <th>DISCOUNT AMT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $total_actual; ?></td>
                        <td><?= $tax; ?></td>
                        <td><?= $total_amount; ?></td>
                        <td><?= $dicount_total; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr>
<!--Transition History Select and cash add in Payment Table -->
<?php echo form_open(base_url('super_admin/TransitionController/submit_payment/'), 'class=""');  ?> 
<input type="hidden" value="<?= $get_res->restaurant_id; ?>" name="res_id">
<input type="hidden" value="<?= $get_res->mobile; ?>" name="mobile">
<input type="hidden" value="<?= $get_res->email; ?>" name="email">
<input type="hidden" value="<?= $get_res->first_name; ?>" name="fname">
<input type="hidden" value="" id="expired_date" name="expired">
<div class="row">
    <div class="col-lg-12 form-group">
        <div class="col-lg-2">
            <label>Select Device</label>
            <select class="form-control" name="device">
                <option value="1" <?php if($get_res->device==1)  echo 'selected'; ?> >Single Device</option>
                <option value="2" <?php if($get_res->device==2)  echo 'selected'; ?> >Multi Device</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>Duration</label>
            <select class="form-control" name="duration" id="durationValue" required="">
                <option value="">--select duration--</option>
                <option value="1 Month" data-value="1">1 Month</option>
                <option value="2 Months" data-value="2">2 Months</option>
                <option value="3 Months" data-value="3">3 Months</option>
                <option value="4 Months" data-value="4">4 Months</option>
                <option value="5 Months" data-value="5">5 Months</option>
                <option value="6 Months" data-value="6">6 Months</option>
                <option value="7 Months" data-value="7">7 Months</option>
                <option value="8 Months" data-value="8">8 Months</option>
                <option value="9 Months" data-value="9">9 Months</option>
                <option value="10 Months" data-value="10">10 Months</option>
                <option value="11 Months" data-value="11">11 Months</option>
                <option value="12 Months" data-value="12">12 Months</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>Actual Amount</label>
            <input type="number" class="form-control" name="amount" required="">
        </div>
        <div class="col-lg-2">
            <label>Discount</label>
            <select class="form-control" name="discount_amt" id="discountAmt1">
                <option value="0">No Discount</option>
                <?php
                if($discount){
                    foreach ($discount as $row):
                        echo '<option value="'.$row->amount.'">'.$row->name.'</option>';
                    endforeach;
                }
                ?>
            </select>
            <p>Discount : <span id="discounatView1"></span> <i class="fa fa-inr"></i></p>
        </div>
        <div class="col-lg-1">
            <label>Mode</label>
            <input type="text" value="Cash" name="mode" class="form-control" readonly="">
        </div>
        <div class="col-lg-3">
            <label>Remark</label>
            <textarea class="form-control" name="remark" rows="2"></textarea>
        </div>
    </div>
</div><hr>

<!--Device Active and Inactive -->
<div class="box" style="display: none; background-color: lightyellow;" id="devicesBox">
    <div class="box-header">
        <h3 class="box-title">Devices </h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-responsive" id="deviceTable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Device Name</th>
                    <th>Device IMEI</th>
                    <th>Create Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($devices){
                    foreach ($devices as $count=>$row):
                ?>
                <tr>
                    <td><?= $count+1; ?></td>
                    <td><?= $row->device_name; ?></td>
                    <td><?= $row->device_imei; ?></td>
                    <td><?= date('d-M-Y, H:i A', strtotime($row->d_create_date)); ?></td>
                    <td>
                        <div id="status_view<?= $count?>">
                            <span class="btn <?php if($row->status==0){echo 'btn-danger';}else{echo 'btn-success';} ?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $row->device_id; ?>" data-status="<?= $row->status; ?>" style="cursor: pointer;">
                                <?php if($row->status==0){echo 'Inactive';}else{ echo 'Active';}?>
                            </span>
                        </div>
                    </td>
                </tr>
                <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </div>
</div>
 <?php echo form_close( ); ?>
<!--Discount Select option then discount price under to set-->
<script>
//$(document).ready(function(){
    $('select[id^="discountAmt1"]').on('change', function(){
        var value = $(this).val();
       // alert(value);
        $('#discounatView1').text(value);
    });
//});
</script>
<!--Device Active and Inactive-->
<script>
function devices(current){
    $('#devicesBox').toggle('slow');
    var id = $(current).data('status');
    //alert(id);
    if(id == 0){
        $.ajax({
            type:'get',
            data:{},
            success:function(){
               // alert('id- 0');
                $(current).removeClass('btn-warning');
                $(current).addClass('btn-danger');
                $(current).data('status', 1);
               // $('#transition_history_view').show('slow');
            }
        });
    }else if(id == 1){
        $.ajax({
            type:'get',
            data:{},
            success:function(){
               // alert('else condi');
                $(current).addClass('btn-warning');
                $(current).removeClass('btn-danger');
                $(current).data('status', 0);
               // $('#transition_history_view').hide('slow');
            }
        });
    }
}
</script>
<!--Device Active and Inactive-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        var count = $(current).data('count');
       // alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('super_admin/TransitionController/device_update_status'); ?>',
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                    //$('#update_msg').text(data);
//                        $('#status_view'+count).empty();
//                        $('#status_view'+count).html(data);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('super_admin/TransitionController/device_update_status'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '1'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                    //$('#update_msg').text(data);
//                        $('#status_view'+count).empty();
//                        $('#status_view'+count).html(data);
                }
            });
        }
        
    }
</script>

<!--Select duration then expired date extaint-->
<script>
//$(document).ready(function(){
   
    $('select[id^="durationValue"]').on('change', function(){
        var value = $(this).find(':selected').data('value');
       // alert(value);
         if(value){
            $.ajax({
                url:'<?= site_url('future_date'); ?>',
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', value:value, id:<?= $get_res->restaurant_id;?>},
                success:function(data){
                    $('#expired_date').val(data);
                    $('#viewDate1').text(data);
                }
            });
           
        }
    });
//});
</script>
<?php
}
?>