<STYLE>
   .btnMain{
        padding: 12px;
        border: 0.4px solid gainsboro;
        background-color: white;
    }
</style>    
<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
    $count= 0;
    foreach ($list as $row):
        //$show=$count+$row;
    $count++;
    endforeach;
    
?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <!--First Box Start-->
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Branding</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h1><span style="font-size: 60px; font-weight: 300; color: black; line-height: 1;"><?= $count; ?> <i class="fa fa-photo"> </i></span></h1>
                    <!--<h1><?= $count; ?> <b> ?</b></h1>-->
                </div>
                <!-- /.box-body -->
            </div>

            <!--Add Survey box-->
            <div class="box">
            <?php if($adminRole == 2 || $otherRole == 11){ ?>
                <div class="">
                    <a href="<?= site_url('admin/Branding_C'); ?>" >  
                      <button type="button" class="btnMain btn btn-default btn-block"><i class="fa fa-plus"> </i> &nbsp;Add Branding</button>
                  </a>
                    <!--<a href="<?= site_url('admin/Branding_C'); ?>" class="btnSurvey"> <center> <h3 class="box-title"><i class="fa fa-plus"> </i> Add Branding</h3> </center> </a>-->
                </div>
            <?php } ?>
            </div>
        </div>
        <!--First Box End-->

        <!--Second Box And Surveys List show start box-->
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Branding Template</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <!--th style="width: 10px">#</th-->
                            <th>Brand Name</th>
                            <th>Use On Device</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                            foreach ($list as $count=>$row):
                        ?>    
                        <tr>
                            <td><?= $row->b_brand_name; ?></td>
                            <td id="device<?= $count; ?>">
                                <script>
                                    $.ajax({
                                        url:'<?= site_url('admin/Branding_C/get_device_count'); ?>',
                                        type:'post',
                                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', brand_id:<?= $row->b_id; ?>},
                                        success: function(data){
                                           $('#device<?= $count; ?>').html(data); 
                                        }
                                    });
                                </script>
                            </td>
                            <td><?= date('d-M-Y', strtotime($row->b_create_date))?>, <?= date('H:i A', strtotime($row->b_create_date))?></td>
                           <?php if($adminRole == 2 || $otherRole == 11){ ?>
                            <td>
                                <a style="text-decoration: none; color: white;" href="<?= site_url('admin/Branding_C/branding_edit/'.$row->b_id); ?>" >
                                    <i class="fa fa-edit" style="color:green; font-size: 20px;"></i></a>&nbsp;
                                <span style="cursor: pointer;" id="dialog<?= $count; ?>" data-id="<?= $row->b_id; ?>"><i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>
                            </td>
                           <?php }else{ ?>
                               <td>
                                <a href="<?= site_url('admin/Branding_C/branding_edit/'.$row->b_id); ?>" class="btn btn-success btn-xs">View</a>
                            </td>
                          <?php } ?>
                        </tr>
                         <?php
                            endforeach;
                        ?>
                        
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!--Second Box And Surveys List show start box-->

    </div>


</section>
<!-- /.content -->

<script>
 //$(document).ready(function(){
      <?php foreach ($list as $devices_count=> $devices_data): ?>
        $('#dialog<?= $devices_count; ?>').on('click', function () {
            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");
            //alert(value);
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Branding',
                content: 'This branding and associated data will be deleted.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                           url:'<?= site_url('admin/Branding_C/brand_delete'); ?>',
                           type:'post',
                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', brand_id:value},
                           success: function(data){
                               $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Branding Deleted',
                                    content: 'The selected branding was deleted.',
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
    $("#brand_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  
