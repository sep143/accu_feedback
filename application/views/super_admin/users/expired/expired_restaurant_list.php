 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Expired Restaurants</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        
      <table id="example1" class="table table-bordered table-hover ">
        <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Mobile No.</th>
          <th>Joining Date</th>
          <th>Expired Date</th>
          <th>Update Date</th>
          <th>Account Type</th>
          <!--<th>Role</th>-->
          <th style="width: 90px;" class="text-right">Option</th>
        </tr>
        </thead>
        <tbody id="restaurant">
          <?php 
          $i = 0;
          $current = (new DateTime())->format('Y-m-d');
          foreach($all_users as $row): ?>

            <?php if($current > $row['expired_date']){ ?> 
            <tr>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['mobile']; ?></td>
                <td><?php if(!empty($row['create_date'])) echo date('d-M-Y', strtotime($row['create_date'])); ?></td>
                <td><?php if(!empty($row['expired_date'])) echo date('d-M-Y', strtotime($row['expired_date'])); ?></td>
                <td><?php if(!empty($row['update_date'])) echo date('d-M-Y', strtotime($row['update_date'])).', '.date('H:i A', strtotime($row['update_date'])); ?></td>
                <td><?php if($row['expired_role']==0) {echo 'Demo Account';}else{ echo 'Current Account';} ?></td>
<!--                <td>
                    <span class="btn <?php if($row['account_status'] == 1){ echo 'btn-success';} else{ echo 'btn-danger';}?> btn-flat btn-xs" onclick="change_status(this)" data-id="<?= $row['restaurant_id']; ?>" data-status="<?= $row['account_status']; ?>" style="cursor: pointer;"> 
                      <?php if($row['account_status'] == 1){  echo 'Active';}else{ echo 'Inactive';} ?> <span>
                </td>                                            -->
                <td class="text-right">
                    <a href="<?= base_url('super_admin/users/edit/'.$row['restaurant_id']); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
                    <a href="<?= base_url('super_admin/users/view/'.$row['restaurant_id']); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
                    <a href="#" onclick="delete_restaurant(this)" data-id="<?= $row['restaurant_id']; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>
                </td>
            </tr>
            <?php }?>
          <?php 
          $i++; 
          endforeach; ?>
        </tbody>
       
      </table>
    </div>
    <p id="myElem" class="alert alert-info" style="display: none;">Update status successfully</p>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script> 

<!--click status change then call ajax to get data update page-->
<script>
    function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
       // var count = $(current).data('count');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('super_admin/users/update_status'); ?>',
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id,value:'0'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                   // $('#update_date'+count).text(data);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('super_admin/users/update_status'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',id:id,value:'1'},
                success:function(data){
                    //alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                    //$('#update_date'+count).text(data);
                }
            });
        }
        
    }
</script>

<!--Expired restaurant using ajax to delete-->
<script>
function delete_restaurant(res){
    var id = $(res).data('id');
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
                       url:'<?= site_url('delete'); ?>',
                       type:'post',
                       data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id},
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
}
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
<script>
$("#expired_res").addClass('active');
</script> 