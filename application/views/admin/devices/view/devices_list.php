

<STYLE>

    .btnSurvey{

        color: #ffffff;

    }

    .btnSurvey:hover{

        color: #000000;

    }

</style>    



 

<?php

$adminRole = ucwords($this->session->userdata('role_id'));

$otherRole = ucwords($this->session->userdata('m_role_id'));

    $total = 0;

    foreach ($devices as $devices_count=> $devices_data):

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

                    <h3 class="box-title">Devices Connected</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <h1><span style="font-size: 60px; font-weight: 300; color: black; line-height: 1;"><?= $total; ?> <i class="fa fa-tablet"></i></span></h1>

                    <!--<span style="font-size: 60px;"><?= $total; ?><b> <i class="fa fa-hand-pointer-o"></i></b></span>-->

                </div>

            </div>

            <label>
            <?php
            if(isset($access)) {

                if($access->device==1){

                    echo '<i style="color:red;">Only one device can be active at a time.</i>';

                }else{

                    echo '<i style="color:green;">All Device Active At a time.</i>';

                }

            }
            ?></label>

            <br>

            <b id="update_msg" style="color:red;"></b>

        </div>

        <!--First Box End-->



        <!--Second Box And Feedbacks List show start box-->

        <div class="col-md-9">

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Devices List</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <table class="table table-bordered table-hover" id="refresh">

                        <tr>

                            <!--th style="width: 10px">#</th-->

                            <th>Devices Name</th>

                            <th>Feedback</th>

                            <th>Branding</th>

                            <th>Create Date</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                        <?php foreach ($devices as $devices_count=> $devices_data): ?>

                        <tr>

                            <td><?= $devices_data->device_name; ?></td>

                            <!-- <td><?= sizeof(json_decode($devices_data->survey_id, true)); ?></td> -->
                            <td><?= ($devices_data->survey_id!='null')?sizeof(json_decode($devices_data->survey_id, true)):'0'; ?></td>

                            

<!--                            <td id="survey_name<?= $devices_count; ?>">

                                <script>

                                   // $(document).ready(function(){

                                    $.ajax({

                                        url:'<?= site_url('admin/Devices_C/get_name'); ?>',

                                        type:'post',

                                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', survey_name:<?= $devices_data->survey_id; ?>},

                                        success: function(data){

                                           $('#survey_name<?= $devices_count; ?>').html(data); 

                                        }

                                    });

                                //});

                                </script>

                            </td>-->

                            <td id="branding_name<?= $devices_count; ?>">

                                <script>

                                   // $(document).ready(function(){

                                    $.ajax({

                                        url:'<?= site_url('admin/Devices_C/get_brand_name'); ?>',

                                        type:'post',

                                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', branding_name:<?= $devices_data->branding_id; ?>},

                                        success: function(data){

                                           $('#branding_name<?= $devices_count; ?>').html(data); 

                                        }

                                    });

                                //});

                                </script>

                            </td>

                            <td><?= date('d-M-Y', strtotime($devices_data->d_create_date)); ?>, <?= date('H:i A', strtotime($devices_data->d_create_date)); ?></td>

                            <td>

                                <?php

                                if($adminRole == 2 || $otherRole == 11){

                                    ?>

                                <div id="status_view<?= $devices_count?>">

                                    <span class="btn <?php if($devices_data->status==0){echo 'btn-danger';}else{echo 'btn-success';} ?> btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $devices_count; ?>" data-id="<?= $devices_data->device_id; ?>" data-status="<?= $devices_data->status; ?>" style="cursor: pointer;">

                                        <?php if($devices_data->status==0){echo 'Inactive';}else{ echo 'Active';}?>

                                    </span>

                                </div>

                                <?php

                                }else{

                                    ?>

                                <span style="<?php if($devices_data->status==0){echo 'color:red;';}else{ echo 'color:green;';}?>">

                                    <?php if($devices_data->status==0){echo 'Inactive';}else{ echo 'Active';}?>

                                </span>

                                <?php

                                }

                                ?>

                            </td>

                            <?php 

                            if($adminRole == 2 || $otherRole == 11){ ?>

                            <td>

                                <a style="text-decoration: none; color: white;" href="<?= site_url('admin/Devices_C/devices_edit/'.$devices_data->device_id); ?>">

                                    <i class="fa fa-edit" style="color:green; font-size: 20px;"></i> &nbsp;</a>

                          <!--Delete Button-->

                                <span style="cursor: pointer;" id="dialog<?= $devices_count; ?>" data-id="<?= $devices_data->device_id; ?>"><i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>

                            </td>

                            <?php }else{ ?>

                            <td>

                                <BUTTON type="button" class="btn btn-success btn-xs"><a style="text-decoration: none; color: white;" href="<?= site_url('admin/Devices_C/devices_edit/'.$devices_data->device_id); ?>">View</a></BUTTON>

                            </td>

                            <?php } ?>

                        </tr>      

                        <?php endforeach;  ?>

                        

                    </table>

                </div>

                <!-- /.box-body -->

            </div>

        </div>

        <!--Second Box And Feedbacks List show start box-->



    </div>

   

</section>

<!-- /.content -->



<!--Device Active-->

<script>

function change_status(current){

        var id = $(current).data('id');

        var status = $(current).data('status');

        var count = $(current).data('count');

       // alert(status);

        if(status == 1){

            $.ajax({

                url:'<?= site_url('admin/Devices_C/update_status'); ?>',

                type:'post',

                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '0', count:count},

                success:function(data){

                   // alert(data);

//                    $(current).removeClass('btn-success');

//                    $(current).addClass('btn-danger');

//                    $(current).text('Inactive');

//                    $(current).data('status',0);

//                    $('#update_msg').text(data);

                        $('#status_view'+count).empty();

                        $('#status_view'+count).html(data);

                }

            });

        }else if(status == 0){

            $.ajax({

                url:'<?= site_url('admin/Devices_C/update_status'); ?>',

                type:'POST',

                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', id:id, value: '1', count:count},

                success:function(data){

                   // alert('data');

//                    $(current).removeClass('btn-danger');

//                    $(current).addClass('btn-success');

//                    $(current).text('Active');

//                    $(current).data('status',1);

//                    $('#update_msg').text(data);

                        $('#status_view'+count).empty();

                        $('#status_view'+count).html(data);

                }

            });

        }

        

    }

</script>

<script>

    

 //$(document).ready(function(){

      <?php foreach ($devices as $devices_count=> $devices_data): ?>

        $('#dialog<?= $devices_count; ?>').on('click', function () {

            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");

            //alert(value);

            $.confirm({

                //animation: 'zoom',

                icon:'fa fa-warning',

                title: 'Delete Device',

                content: 'This will disconnect this device from your account. Data sycned from this device will be orphaned.',

                theme: 'modern',

                buttons: {

                    confirm: function () {

                        //$.alert('Confirmed!');

                       $.ajax({

                           url:'<?= site_url('admin/Devices_C/device_delete'); ?>',

                           type:'post',

                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', device_id:value},

                           success: function(data){

                               $.confirm({

                                   //animation: 'zoom',

                                    icon:'fa fa-check-circle',

                                    title: 'Delete Device',

                                    content: 'Successfully Delete Device.',

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

    $("#devices_dashboard").addClass('active');

    //$("#simple-tables").addClass('active');

</script>  

