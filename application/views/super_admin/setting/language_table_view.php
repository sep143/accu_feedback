<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <?= AlertMsg(); ?>
            </div>
            <div class="col-lg-8 ">
                <div class="card">
                    <div class="box-header">
                        <h3 class="box-title">Language List</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover" id="languageTable1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($all_language){
                                    foreach ($all_language as $count=>$row):
//                                        if($row->key_id == 11 || $row->key_id == 12 || $row->key_id == 21 || $row->key_id == 22){
//                                       
//                                        }else{
                                            ?>
                                <tr>
                                    <td><?= $row->ID ?></td>
                                    <td><?= $row->Name; ?></td>
                                    <td><?= $row->Code; ?></td>
                                    <td><?= date('d-M-Y, H:i A', strtotime($row->CreatedDT))?></td>
                                    <td id="update_date<?= $count; ?>">
                                        <?php if(!empty($row->LastModifiedDT)){ 
                                            echo date('d-M-Y, H:i A', strtotime($row->LastModifiedDT)); 
                                        }else{
                                            echo '-';
                                        }
                                    ?>
                                    </td>
                                    <!--<td>Active</td>-->
                                    <td>
                                        <span class="btn <?php if($row->Status == 1){ echo 'btn-success';} else{ echo 'btn-danger';}?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $row->ID; ?>" data-status="<?= $row->Status; ?>" style="cursor: pointer;"> 
                                            <?php if($row->Status == 1){  echo 'Active';}else{ echo 'Inactive';} ?> <span>
                                    </td>
                                </tr>
                                <?php
//                                        }
                                    endforeach;
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
            <!--Add New discount offers form start-->
            <div class="col-lg-4 crad">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">New Language Add</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row form-group">
                            <?php echo form_open(base_url('language/add'), 'class=""'); ?> 
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" placeholder="Language Name" name="lang_name" required="">
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" placeholder="Language Code" name="lang_code" required="">
                                </div>&nbsp;<br>
                                <div class="col-lg-12">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-success">
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-lg-2 text-right">
                                <label>ID : </label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="searchID">
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-success" onclick="searchDiscount(this)">Search</button>
                                <button type="button" class="btn btn-danger" onclick="search_clear()">Clear</button>
                            </div>
                        </div>
                        <!--Data found then view in table-->
                        <div id="viewDiscount">
                            
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <!--add discount offer end div-->
                        
                        
        </div>
    </div>
</section>

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#languageTable1").DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [3] } ]
    });
  });
  
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
                url:'<?= site_url('language/change_status'); ?>',
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
                url:'<?= site_url('language/change_status'); ?>',
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

<!--AJAX to get data of discount id then edit of possible-->
<script>
    function searchDiscount(current){
        var id = $('#searchID').val();
        $.ajax({
            url:'<?= site_url('language/edit_get'); ?>',
            type:'post',
            data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id},
            success:function(data){
                $('#viewDiscount').html(data);
            }
        });
    }
    //search clear
    function search_clear(){
        $('#viewDiscount').empty();
    }
</script>

<!--Sidebar in active class use-->
<script>
$('#languages').addClass('active');
</script>