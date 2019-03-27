<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6 ">
                <div class="card">
                    <div class="box-header">
                        <h3 class="box-title">Discount List</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover" id="discountTable1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($dicount){
                                    foreach ($dicount as $count=>$row):
                                        if($row->key_id == 11 || $row->key_id == 12 || $row->key_id == 21 || $row->key_id == 22){
                                       
                                        }else{
                                            ?>
                                <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $row->name; ?></td>
                                                <td><?= $row->amount; ?></td>
                                                <td><?= date('d-M-Y, H:i A', strtotime($row->create_date))?></td>
                                                <td><?php if(!empty($row->lastModifiedDT))
                                                    { echo date('d-M-Y, H:i A', strtotime($row->lastModifiedDT)); 
                                                    
                                                    }else{
                                                        echo '-';}?></td>
                                                <td>Active</td>
                                            </tr>
                                <?php
                                        }
                                    endforeach;
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!--Jb restaurant online payment karega tb discount offer kitna dena h yaha se discount hokr add hoga-->
                <div class="card">
                    <div class="box-header">
                        <h3 class="box-title">Online Payment Discount Offers</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover" id="discountTable2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Last Update Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($dicount){
                                    foreach ($dicount as $count=>$row):
                                        if($row->key_id == 11 || $row->key_id == 12 || $row->key_id == 21 || $row->key_id == 22){
                                       ?>
                                       <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $row->name; ?></td>
                                                <td><?= $row->amount; ?></td>
                                                <td><?php if(!empty($row->lastModifiedDT)) echo date('d-M-Y, H:i A', strtotime($row->lastModifiedDT))?></td>
                                            </tr>
                                <?php
                                        }
                                    endforeach;
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--Add New discount offers form start-->
            <div class="col-lg-6 crad">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">New Discount Add</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <!--Add new offer and discount-->
                        <label>New Discount Add</label>&nbsp;<br><br>
                        <div class="row form-group">
                            <?php echo form_open(base_url('discount/view'), 'class=""'); ?> 
                            <div class="col-lg-5">
                                <input type="text" class="form-control" placeholder="Enter Discount Name" name="name">
                            </div>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" placeholder="Amount" name="amount">
                            </div>
                            <div class="col-lg-3">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-lg-2 text-right">
                                <label>ID : </label>
                            </div>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="searchID">
                            </div>
                            <div class="col-lg-5">
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
    $("#discountTable1").DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [3] } ]
    });
  });
  $(function () {
    $("#discountTable2").DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [3] } ]
    });
  });
</script> 

<!--AJAX to get data of discount id then edit of possible-->
<script>
    function searchDiscount(current){
        var id = $('#searchID').val();
        $.ajax({
            url:'<?= site_url('discount_get'); ?>',
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
$('#discount').addClass('active');
</script>