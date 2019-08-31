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

    $total = 0;

    foreach ($trigger_list as $trigger_count=> $trigger_data):

        $total +=1;

    endforeach;

?>

<!-- Main content -->

<section class="content">

    <div class="row">

        <!--First Box Start-->

        <div class="col-md-3">

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Notification Triggers</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <h1><span style="font-size: 60px; font-weight: 300; color: black; line-height: 1;"><?= $total; ?> <i class="fa fa-hand-pointer-o"></i></span></h1>

                    <!--<span style="font-size: 60px;"><?= $total; ?><b> <i class="fa fa-hand-pointer-o"></i></b></span>-->

                </div>

                <!-- /.box-body -->

            </div>



            <!--Add Survey box-->

            <div class="box">

                <?php 

                if($adminRole == 2 || $otherRole == 11){ ?>

                <div class="">

                    <a href="<?= site_url('admin/Notifications_C/trigger_add'); ?>" >  

                      <button type="button" class="btnMain btn btn-default btn-block"><i class="fa fa-plus"> </i> &nbsp;Add Trigger</button>

                  </a>

                    <!--<a href="<?= site_url('admin/Notifications_C/trigger_add'); ?>" class="btnSurvey"> <center> <h3 class="box-title"><i class="fa fa-plus"> </i> New Trigger</h3> </center> </a>-->

                </div>

                <?php } ?>

            </div>

        </div>

        <!--First Box End-->



        <!--Second Box And Surveys List show start box-->

        <div class="col-md-9">

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Triggers List</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <table class="table table-bordered">

                        <tr>

                            <!--th style="width: 10px">#</th-->

                            <th>Trigger Name</th>

                            <th>Create Date</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                        <?php foreach ($trigger_list as $trigger_count=> $trigger_data): ?>

                        <tr>

                            <td><?= $trigger_data->trigger_name; ?></td>

                            <td><?= date('d-M-Y', strtotime($trigger_data->trigger_create_date)); ?>, <?= date('H:i a', strtotime($trigger_data->trigger_create_date)); ?></td>

                            <td><?php if($trigger_data->trigger_status == 1){

                                echo "Active";

                            }else{

                                echo "Deactive";

                            } ; ?>

                            </td>

                            <?php 

                            if($adminRole == 2 || $otherRole == 11){ ?>

                            <td>

                                <a style="text-decoration: none; color: white;" href="<?= site_url('admin/Notifications_C/trigger_edit/'.$trigger_data->trigger_id); ?>">

                                    <i class="fa fa-edit" style="color:green; font-size: 20px;"></i></a>&nbsp;

                                <span style="cursor: pointer;" id="dialog<?= $trigger_count; ?>" data-id="<?= $trigger_data->trigger_id; ?>"><i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>

                                <!--<BUTTON type="button" class="btn btn-danger btn-xs"><a style="text-decoration: none; color: white;" onclick="return confirm('Are You Sure.');" href="<?= site_url('admin/Notifications_C/trigger_delete/'.$trigger_data->trigger_id); ?>">Delete</a></BUTTON>-->

                            </td>

                            <?php }else{ ?>

                            <td>

                                <BUTTON type="button" class="btn btn-success btn-xs"><a style="text-decoration: none; color: white;" href="<?= site_url('admin/Notifications_C/trigger_edit/'.$trigger_data->trigger_id); ?>">View</a></BUTTON>

                            </td>

                            <?php } ?>

                        </tr>      

                        <?php endforeach;  ?>

                        

                    </table>

                </div>

                <!-- /.box-body -->

            </div>

        </div>

        <!--Second Box And Surveys List show start box-->



    </div>





</section>

<!-- /.content -->





<!--If select staff delete button than open popup box and click button confirm than data delete script waiter list to delete data-->

<script>

 //$(document).ready(function(){

      <?php foreach ($trigger_list as $devices_count=> $devices_data): ?>

        $('#dialog<?= $devices_count; ?>').on('click', function () {

            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");



            $.confirm({

                animation: 'zoom',

                icon:'fa fa-warning',

                title: 'Delete Trigger',

                content: 'This trigger will be deleted and its notifications cleared.',

                theme: 'modern',

                buttons: {

                    confirm: function () {

                        //$.alert('Confirmed!');

                       $.ajax({

                           url:'<?= site_url('admin/Notifications_C/trigger_delete'); ?>',

                           type:'post',

                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', trigger_id:value},

                           success: function(data){

                               $.confirm({

                                   //animation: 'zoom',

                                    icon:'fa fa-check-circle',

                                    title: 'Trigger Deleted',

                                    content: 'The selected trigger was deleted.',

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

   $("#notifications_dashboard").addClass('active');

    //$("#simple-tables").addClass('active');

</script>  

