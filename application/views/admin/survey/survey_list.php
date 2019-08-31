<style>

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

                    <h3 class="box-title">Feedbacks</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <h1><span style="font-size: 60px; font-weight: 300; color: black; line-height: 1;"><?= $count; ?><b> <i class="fa fa-comments-o"></i></b></span></h1>

                </div>

                <!-- /.box-body -->

            </div>



            <!--Add Feedback box-->

            <div class="box">

                <?php

                if($adminRole == 2 || $otherRole == 11){ ?>

                <div class="">

                  <a href="<?= site_url('admin/Survey_C/addSurvey'); ?>" >  

                      <button type="button" class="btnMain btn btn-default btn-block"><i class="fa fa-plus"> </i> &nbsp;New Feedback</button>

                  </a>

                    <!--<a href="<?= site_url('admin/Survey_C/addSurvey'); ?>" class="btnSurvey"> <center> <h3 class="box-title"><i class="fa fa-plus"> </i> Add Surveys</h3> </center> </a>-->

                </div>

                <?php } ?>

            </div>

        </div>

        <!--First Box End-->



        <!--Second Box And Feedbacks List show start box-->

        <div class="col-md-9">

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Restaurant Feedback</h3>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <tr>

                            <!--th style="width: 10px">#</th-->

                            <th>Feedback Name</th>

                            <th>Questions</th>

                            <th>Use On Device</th>

                            <!-- <th>Language</th> -->

                            <th>Create Date</th>

                            <th>Action</th>

                        </tr>

                        

                        <?php

                            foreach ($list as $count=>$row):

                                $json1= $row->options;

                                $json_data = json_decode($json1, TRUE);

                                $qi=0;

                                if($json1){

                                    foreach ($json_data['question'] as $Qcount=> $Qrow):

                                     $qi =+ $Qcount+1 ;   

                                    endforeach;

                                }

                        ?>    

                        <tr>

                            <td><?= $row->survey_name; ?></td>

                            <td><?= $qi; ?> questions</td>

                            <td id="device<?= $count; ?>">

                                <script>

                                    $.ajax({

                                        url:'<?= site_url('admin/Survey_C/get_device_count'); ?>',

                                        type:'post',

                                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', survey_id:<?= $row->survey_id; ?>},
                                        // data:{survey_id:<?= $row->survey_id; ?>},

                                        success: function(data){
                                            // console.log(data);
                                           $('#device<?= $count; ?>').html(data); 

                                        },
                                        error: function(data) {
                                            console.log(data);
                                        }

                                    });

                                </script>

                            </td>

                            <!-- <td><?= $row->lang_name; ?></td> -->

                            <td><?= date('d-M-Y', strtotime($row->survey_create_date))?>, <?= date('H:i A', strtotime($row->survey_create_date))?></td>

                        <?php if($adminRole == 2 || $otherRole == 11){  ?>

                            <td>

                                <a style="text-decoration: none; color: white;" href="<?= site_url('admin/Survey_C/edit/'.$row->survey_id); ?>">

                                    <i class="fa fa-edit" style="color:green; font-size: 20px;"></i></a>&nbsp;

                                <span style="cursor: pointer;" id="dialog<?= $count; ?>" data-id="<?= $row->survey_id; ?>"><i class="fa fa-trash-o" style="color:red; font-size: 20px;"></i></span>

                            </td>

                        <?php }else{ ?>

                            <td>

                                <a href="<?= site_url('admin/Survey_C/edit/'.$row->survey_id); ?>" class="btn btn-success btn-xs">View</a>

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

        <!--Second Box And Feedbacks List show start box-->



    </div>





</section>

<!-- /.content -->



<!--If select Delete option then dailog box (Popup box) open -->



<script>

 //$(document).ready(function(){

      <?php foreach ($list as $devices_count=> $devices_data): ?>

        $('#dialog<?= $devices_count; ?>').on('click', function () {

            var value = $('#dialog<?= $devices_count; ?>').attr("data-id");

            //alert(value);

            $.confirm({

                //animation: 'zoom',

                icon:'fa fa-warning',

                title: 'Delete Feedback',

                content: 'This feedback and all associated data will be deleted. This is not reversible.',

                theme: 'modern',

                buttons: {

                    confirm: function () {

                       

                       $.ajax({

                           url:'<?= site_url('admin/Survey_C/survey_delete'); ?>',

                           type:'post',

                           data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', survey_id:value},

                           success: function(data){

                               $.confirm({

                                   //animation: 'zoom',

                                    icon:'fa fa-check-circle',

                                    title: 'Feedback Deleted',

                                    content: 'The selected feedback and associated data was deleted.',

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

    $("#survey_dashboard").addClass('active');

    //$("#simple-tables").addClass('active');

</script>  

