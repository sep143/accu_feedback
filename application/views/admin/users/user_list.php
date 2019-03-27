 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">User List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="tblView" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Mobile No.</th>
          <th>Role</th>
          <th style="width: 150px;" class="text-right">Option</th>
        </tr>
        </thead>
        <tbody>
           <?php $admin_id = ucwords($this->session->userdata('admin_id')); ?> 
          <?php 
          
          foreach($all_users as $row): 
              if($row['restaurant_id'] == $admin_id){
           ?>
          <tr>
            <td><?= $row['m_first_name']; ?></td>
            <td><?= $row['m_last_name']; ?></td>
            <td><?= $row['m_email']; ?></td>
            <td><?= $row['m_mobile']; ?></td>
            <td><span class="btn btn-primary btn-flat btn-xs"><?= ($row['m_role_id'] == 11)? 'admin': 'member'; ?><span></td>
                        <td class="text-right"><a href="<?= base_url('admin/users/edit/'.$row['m2_id']); ?>" class="btn btn-info btn-flat">Edit</a><a href="<?= base_url('admin/users/del/'.$row['m2_id']); ?>" class="btn btn-danger btn-flat <?= ($row['m_role_id'] == 11)? 'disabled': ''?>">Delete</a></td>
          </tr>
          
              <?php } 
              endforeach; ?>
        </tbody>
       
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#tblView").DataTable();
  });
</script> 
<script>
$("#view_users").addClass('active');
</script>        
