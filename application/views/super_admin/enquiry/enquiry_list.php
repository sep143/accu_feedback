 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Total Enquiries</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        
      <table id="example1" class="table table-bordered table-hover table-responsive">
        <thead>
        <tr>
          <th>S.No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile No.</th>
          <th>Message</th>
          <th>Enquiry Date</th>
          <th>Role</th>
        </tr>
        </thead>
        <tbody id="restaurant">
          <?php 
          if($all_enquiry){
          foreach($all_enquiry as $count=>$row): ?>
            <!--Joining Date to expired date count and view-->
           
            <tr style="font-weight : <?php if($row['status']==1){echo 'bold';} else{    echo '';}?>" >
                <td><?= $count+1; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['mobile']; ?></td>
                <td><?= $row['message']; ?></td>
                <td><?= date('d-M-Y, H:i A', strtotime($row['enquiryDT'])) ?></td>
                <td><?php if($row['status']==1){
                    echo '<a href="'.site_url('enquiry/view/'.$row['id']).'" class="btn btn-xs btn-success">View</button>';
                }else{    
                    echo '<lable>Read</lable>';
                } ?>
                
        </tr>
          <?php 
          endforeach;
          } ?>
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
    $("#example1").DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [6] } ]
    });
  });
</script> 
<script>
$("#view_enquiry").addClass('active');
</script>   

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


