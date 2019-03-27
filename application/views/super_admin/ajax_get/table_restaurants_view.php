<?php
    if($getRestaurantData){
        $current = (new DateTime())->format('Y-m-d');
        foreach ($getRestaurantData as $count=>$row):
      if($expNoexp == 'all'){ ?>
          <tr>
    <td><?= $count+1; ?></td>
    <td><?= $row->first_name; ?> <?= $row->last_name; ?></td>
    <td><?= $row->name; ?></td>
    <td><?= $row->email; ?></td>
    <td><?= date('d-M-Y', strtotime($row->create_date)); ?>, <?= date('H:i A', strtotime($row->create_date)); ?></td>
    <td><?= date('d-M-Y', strtotime($row->expired_date)); ?></td>
    <td><?php if($row->expired_role == 0){     echo 'Demo';}else{    echo 'Current';} ?></td>
    <td>
        <span class="btn <?php if ($row->account_status == 1) {
            echo 'btn-success';
        } else {
            echo 'btn-danger';
        } ?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $row->restaurant_id; ?>" data-status="<?= $row->account_status; ?>" style="cursor: pointer;"> 
        <?php if ($row->account_status == 1) {
            echo 'Active';
        } else {
            echo 'Inactive';
        } ?> <span>
    </td>
    <td class="text-right">
        <a href="<?= base_url('super_admin/users/edit/' . $row->restaurant_id); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
        <a href="<?= base_url('super_admin/users/view/' . $row->restaurant_id); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
        <!--<a href="#" id="dialog_del<?= $count; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>-->
    </td>
</tr>
      <?php 
      
      }else if($expNoexp == 'exp' && ($current > $row->expired_date)){
      ?>
        <tr>
    <td><?= $count+1; ?></td>
    <td><?= $row->first_name; ?> <?= $row->last_name; ?></td>
    <td><?= $row->name; ?></td>
    <td><?= $row->email; ?></td>
    <td><?= date('d-M-Y', strtotime($row->create_date)); ?>, <?= date('H:i A', strtotime($row->create_date)); ?></td>
    <td><?= date('d-M-Y', strtotime($row->expired_date)); ?></td>
    <td><?php if($row->expired_role == 0){     echo 'Demo';}else{    echo 'Current';} ?></td>
    <td>
        <span class="btn <?php if ($row->account_status == 1) {
            echo 'btn-success';
        } else {
            echo 'btn-danger';
        } ?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $row->restaurant_id; ?>" data-status="<?= $row->account_status; ?>" style="cursor: pointer;"> 
        <?php if ($row->account_status == 1) {
            echo 'Active';
        } else {
            echo 'Inactive';
        } ?> <span>
    </td>
    <td class="text-right">
        <a href="<?= base_url('super_admin/users/edit/' . $row->restaurant_id); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
        <a href="<?= base_url('super_admin/users/view/' . $row->restaurant_id); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
        <!--<a href="#" id="dialog_del<?= $count; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>-->
    </td>
</tr>
      <?php
      }else if($expNoexp == 'No-exp' && ($current <= $row->expired_date)){
      ?>
        <tr>
    <td><?= $count+1; ?></td>
    <td><?= $row->first_name; ?> <?= $row->last_name; ?></td>
    <td><?= $row->name; ?></td>
    <td><?= $row->email; ?></td>
    <td><?= date('d-M-Y', strtotime($row->create_date)); ?>, <?= date('H:i A', strtotime($row->create_date)); ?></td>
    <td><?= date('d-M-Y', strtotime($row->expired_date)); ?></td>
    <td><?php if($row->expired_role == 0){     echo 'Demo';}else{    echo 'Current';} ?></td>
    <td>
        <span class="btn <?php if ($row->account_status == 1) {
            echo 'btn-success';
        } else {
            echo 'btn-danger';
        } ?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $row->restaurant_id; ?>" data-status="<?= $row->account_status; ?>" style="cursor: pointer;"> 
        <?php if ($row->account_status == 1) {
            echo 'Active';
        } else {
            echo 'Inactive';
        } ?> <span>
    </td>
    <td class="text-right">
        <a href="<?= base_url('super_admin/users/edit/' . $row->restaurant_id); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
        <a href="<?= base_url('super_admin/users/view/' . $row->restaurant_id); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
        <!--<a href="#" id="dialog_del<?= $count; ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>-->
    </td>
</tr>
    <?php

          }
    ?>

<?php
        endforeach;
    }
?>

<!--click status change then call ajax to get data update page-->
<script>
    function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        var count = $(current).data('count');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('super_admin/Users/update_status'); ?>',
                type:'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                    $('#update_date'+count).text(data);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('super_admin/Users/update_status'); ?>',
                type:'POST',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '1'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                    $('#update_date'+count).text(data);
                }
            });
        }
        
    }
</script>