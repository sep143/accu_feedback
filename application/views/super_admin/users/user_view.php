 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?= $user['name']; ?> -Restaurant Information</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <div>
            <label>Owner Name: <?php echo $user['first_name'] .' '. $user['last_name']; ?></label><br>
            <label>Restaurant Name: <?php echo $user['name'] ; ?></label><br>
            <label>Address: <?php echo $user['r_address'] ; ?>, <?php echo $user['r_city'] ; ?>
                <?php echo $user['r_state'] ; ?>, <?php echo $user['r_country'] ; ?><br> PIN Code- <?php echo $user['r_pin_code'] ; ?>
            </label><br>
            <label>Email :- <?php echo $user['email'] ; ?></label><br>
            <label>Mobile :- <?php echo $user['mobile'] ; ?></label><br>
            <label>Create Account Date- <?php echo date('d-M-Y', strtotime($user['create_date'])); ?>, <?php echo date('H:i A', strtotime($user['create_date'])); ?></label><br>
            <label>Last Update Date- <?php echo date('d-M-Y', strtotime($user['update_date'])); ?>, <?php echo date('H:i A', strtotime($user['update_date'])); ?></label><br>
            <label>Last Payment Date- <?php echo date('d-M-Y', strtotime($user['expired_date'])); ?></label>
        </div> 
    </div>
    <!-- /.box-body -->
  </div>
     
     <!--This Box in view invoice bill only-->
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Invoice's</h3> 
             <button type="button" class="pull-right btn btn-success" onclick="area_open(this)" data-status="0">Transition History</button>
         </div>
         <div class="box-body">
             <table id="invoice" class="table table-bordered table-responsive table-responsive">
                 <thead>
                     <tr>
                         <th>S.No.</th>
                         <th>Invoice No.</th>
                         <th>Invoice Date</th>
                         <th>Amount</th>
                         <th>Download</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                     if($invoice){
                         foreach ($invoice as $i_count=> $i_row):
                     ?>
                     <tr>
                         <td><?= $i_count+1; ?></td>
                         <td><?= $i_row->ORDER_ID; ?></td>
                         <td><?= date('d-M-Y, H:i: A', strtotime($i_row->TXNDATE)); ?></td>
                         <td><?= $i_row->TXN_AMOUNT; ?>.00</td>
                         <td>
                             <a href="<?= base_url('invoice/view/'.$i_row->id); ?>" style="cursor: pointer;"><i style="color:green;" class="fa fa-eye"></i></a>&nbsp;&nbsp;
                             <a href="<?= base_url('admin/pdfGenerate/super_pdf/'.$i_row->id); ?>" target="_blank" style="cursor: pointer;"><i class="fa fa-download"></i></a></td>
                     </tr>
                     <?php
                         endforeach;
                     }
                     ?>
                 </tbody>
             </table>
         </div>
     </div>
     <!--Restaurant Transition History On Click Transition History-->
     <div class="box" style="display: none;" id="transition_history_view">
         <div class="box-header">
             <?php
             $total_amout = 0;
             foreach ($transition as $value):
                 if($value->STATUS=='success')
                 $total_amout += $value->TXN_AMOUNT;
             endforeach;
             ?>
             <h3 class="box-title">Transition History</h3>
             <label class="pull-right">Total Success Amount:- <u><b style="color:green;"><?php if(!empty($total_amout)) echo $total_amout;?>.00 <i class="fa fa-inr"></i> </b></u></label>
         </div>
         <div class="box-body">
             <table class="table table-bordered table-responsive table-hover" id="transition_get_res">
                 <thead style="background-color: lightgray;">
                     <tr>
                         <td>S.No.</td>
                         <td>Invoice No.</td>
                         <td>Amount</td>
                         <td>Status</td>
                         <td style="width: 10%">Transition Date</td>
                         <td>Email</td>
                         <td>Mobile</td>
                         <td>Txt ID</td>
                         <td>Mode</td>
                         <td>Product</td>
                         <td>PG Type</td>
                         <td>Bank Ref Code</td>
                         <td>Device</td>
                     </tr>
                 </thead>
                 <tbody>

                     <?php
                     if ($transition) {
                         foreach ($transition as $count => $row):
                             ?>   
                             <tr>
                                 <td><?= $count + 1; ?></td>
                                 <td><?= $row->ORDER_ID; ?></td>
                                 <td><?= $row->TXN_AMOUNT; ?></td>
                                 <td style="<?php if ($row->STATUS == 'success') {
                         echo 'color:green;';
                     } else {
                         echo 'color:red;';
                     } ?>"><?= $row->STATUS; ?></td>
                                 <td style="width: 10%"><?= date('d-M-Y, H:i A', strtotime($row->TXNDATE)); ?></td>
                                 <td><?= $row->EMAIL; ?></td>
                                 <td><?= $row->MSISDN; ?></td>
                                 <td><?= $row->TxtID; ?></td>
                                 <td><?= $row->mode; ?></td>
                                 <td><?= $row->productinfo; ?></td>
                                 <td><?= $row->PG_TYPE; ?></td>
                                 <td><?= $row->bank_ref_num; ?></td>
                                 <td><?php if ($row->device == 1) {
                         echo 'Single';
                     } elseif ($row->device == 2) {
                         echo 'Multi';
                     } ?></td>
                             </tr>
        <?php
    endforeach;
}
?>

                 </tbody>
             </table>
         </div>
     </div>
     <!--Box body user table list-->
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">User's List</h3>
         </div>
         <div class="box-body">
             <table id="example1" class="table table-bordered table-striped ">
                 <thead>
                     <tr>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Email</th>
                         <th>Mobile No.</th>
                         <th>Type</th>
                         <!--<th>Role</th>-->
                         <!--<th style="width: 80px;" class="text-right">Action</th>-->
                     </tr>
                 </thead>
                 <tbody id="restaurant">
                     <?php
                     $i = 0;
                     foreach ($all_users as $row):
                         if($row['m_status'] == 1){
                         ?>
                         <tr>
                             <td><?= $row['m_first_name']; ?></td>
                             <td><?= $row['m_last_name']; ?></td>
                             <td><?= $row['m_email']; ?></td>
                             <td><?= $row['m_mobile']; ?></td>
                             <td><?php if($row['m_role_id'] == 11){ echo 'Admin'; }else{     echo 'User';} ?></td>
                 <!--            <td><span class="btn <?php if ($row['account_status'] == 1) {
                         echo 'btn-success';
                     } else {
                         echo 'btn-danger';
                     } ?> btn-flat btn-xs" onclick="change_status(this)" data-status="<?php if ($row['account_status'] == 1) {
                         echo 0;
                     } else {
                         echo 1;
                     } ?>" data-id="<?= $row['restaurant_id']; ?>" id="active<?= $row['restaurant_id']; ?>"><?= ($row['account_status'] == 1) ? 'Active' : 'Inactive'; ?><span></td>-->
<!--                             <td class="text-right">
                                 <a href="<?= base_url('super_admin/users/edit/' . $row['restaurant_id']); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
                                 <a href="<?= base_url('super_admin/users/view/' . $row['restaurant_id']); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
                                 <a href="#" id="dialog_del<?= $i; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>
                             </td>-->
                         </tr>
    <?php
    $i++;
      }
endforeach;
?>
                 </tbody>
             </table> <hr>
         </div>
     </div>
     
     <!--Box open use staff member's table list open-->
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Staff's List</h3>
         </div>
         <div class="box-body">
             <table id="example2" class="table table-bordered table-striped ">
                 <label align="center">Staff List</label>
                 <thead>
                     <tr>
                         <th>Name</th>
                         <th>Code</th>
                         <th>Address</th>
                         <th>Mobile No.</th>
                         <!--<th>Role</th>-->
                         <!--<th style="width: 150px;" class="text-right">Option</th>-->
                     </tr>
                 </thead>
                 <tbody id="restaurant">
                     <?php
                     $i = 0;
                     foreach ($all_staff as $row):
                         ?>
                         <tr>
                             <td><?= $row['waiter_name']; ?></td>
                             <td><?= $row['waiter_code']; ?></td>
                             <td><?= $row['waiter_add']; ?></td>
                             <td><?= $row['waiter_mobile']; ?></td>
                 <!--            <td><span class="btn <?php if ($row['account_status'] == 1) {
                         echo 'btn-success';
                     } else {
                         echo 'btn-danger';
                     } ?> btn-flat btn-xs" onclick="change_status(this)" data-status="<?php if ($row['account_status'] == 1) {
                         echo 0;
                     } else {
                         echo 1;
                     } ?>" data-id="<?= $row['restaurant_id']; ?>" id="active<?= $row['restaurant_id']; ?>"><?= ($row['account_status'] == 1) ? 'Active' : 'Inactive'; ?><span></td>-->
<!--                             <td class="text-right">
                                 <a href="<?= base_url('super_admin/users/edit/' . $row['restaurant_id']); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
                                 <a href="<?= base_url('super_admin/users/view/' . $row['restaurant_id']); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
                                 <a href="#" id="dialog_del<?= $i; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>
                             </td>-->
                         </tr>
    <?php
    $i++;
endforeach;
?>
                 </tbody>
             </table>
         </div>
     </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--Particular restaurant Transition History view-->
<!--<script>
function history_oprn(current){
    $('#transition_history_view').toggle('slow');
}
</script>-->
<script>
  $(function () {
    $("#example1").DataTable();
  });
  $(function () {
    $("#example2").DataTable();
  });
  $(function () {
    $("#transition_get_res").DataTable();
  });
</script> 
<script>
$("#view_users").addClass('active');
</script>  

<!--User's Table in delete users to re-active user-->
<script>
function active_account(current){
    var id = $(current).data('id');
    //due plan
    $.ajax({
       // url:'<?= site_url('re_active'); ?>',
        type:'POST',
        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id,},
        success:function(data){
            
        }
    });
}
</script>
<!--if click active and inactive button then account status update-->
<script>
//$(document).ready(function(){
    function change_status(current_this){
        //alert('check');
        var id = $(current_this).data('id');
        var value = $(current_this).data('status');
        $("#myElem").show();
           // alert(value);
           $.ajax({
               url:'<?= site_url('super_admin/users/update_status')?>',
               type:'post',
               data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value:value},
               success: function(data){
                   $('#restaurant').empty();
                   $('#restaurant').html(data);
                   $("#myElem").hide(3000);
                    //setTimeout(function() { $("#myElem").hide(); }, 5000);
               }
           });
    }        
//});
</script>
<!--if click delete button then open popup box and confirmation-->
<script>
<?php foreach ($all_users as $devices_count=> $devices_data): ?>
        $('#dialog_del<?= $devices_count; ?>').on('click', function () {
            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");
            var email = $('#dialog<?= $devices_count; ?>').attr("data-email");
//            alert(value);
//            alert(email);
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Restaurant',
                content: 'This will disconnect this device from your account. Data sycned from this device will be orphaned.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                        //$.alert('Confirmed!');
                       $.ajax({
                           //url:'<?= site_url('admin/Users/del'); ?>',
                           type:'post',
                           //data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', user_id:value, emaildelete:email},
                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
                            success: function(data){
                               $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Delete Restaurant',
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
</script>

<!--if change area then click change button-->
<script>
function area_open(current){
    var check = $('#transition_history_view').toggle('slow');
    var id = $(current).data('status');
    //alert(id);
    if(id == 0){
        $.ajax({
            type:'get',
            data:{},
            success:function(){
               // alert('id- 0');
                $(current).removeClass('btn-success');
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
                $(current).addClass('btn-success');
                $(current).removeClass('btn-danger');
                $(current).data('status', 0);
               // $('#transition_history_view').hide('slow');
            }
        });
    }
    
}
</script>