<?php foreach($all_users as $row): ?>
          <tr>
            <td><?= $row['first_name']; ?></td>
            <td><?= $row['last_name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['mobile']; ?></td>
            <td><span class="btn <?php if($row['account_status'] == 1){ echo 'btn-success';}else{ echo 'btn-danger';} ?> btn-flat btn-xs" onclick="change_status(this)" data-status="<?php if($row['account_status'] == 1){ echo 0;}else{ echo 1;}  ?>" data-id="<?= $row['restaurant_id'];?>" id="active<?= $row['restaurant_id'];?>"><?= ($row['account_status'] == 1)? 'Active': 'Inactive'; ?><span></td>
            <td class="text-right">
                <a href="<?= base_url('super_admin/users/edit/'.$row['restaurant_id']); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
                <a href="<?= base_url('super_admin/users/view/'.$row['restaurant_id']); ?>" class="fa fa-eye" style="font-size: 20px;"></a>
                <a href="<?= base_url('super_admin/users/del/'.$row['restaurant_id']); ?>" class="fa fa-trash-o" style="color: red; font-size: 20px;"></a>
            </td>
          </tr>
<?php endforeach; ?>