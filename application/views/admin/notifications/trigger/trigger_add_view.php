<style>

    .input-group[class*=col-] {

    float: none;

    /* padding-right: 0; */

    /* padding-left: 0; */

}

</style>

<section class="content">

    

   <?php echo form_open(base_url('admin/Notifications_C/trigger_add'), 'class=""'); ?> 

    <div class="row">

        <div class="col-lg-5 col-md-5 col-sm-12">

            <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title">New Trigger</h3>

                    </div>

                    <div class="box-body">

                        <input type="hidden" name="restaurant_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">

                        <div class="form-group">

                            <div class="col-lg-12 col-sm-12">

                                <label>This name will appear in notifications generated from this trigger. Configure emails and question filters below.</label>

                            </div>&nbsp;<br>

                            <div class="col-lg-12 col-sm-12"><label for="surveyname" class="float-left h-25"><b>Name</b></label></div>

                            <div class="col-lg-12 col-sm-12">

                                <input type="text" name="triggerName" value="<?= set_value('triggerName','New Trigger'); ?>" class="form-control" id="firstname" placeholder="Enter Trigger Name" required="">

                            </div>

                        </div>&nbsp;<br>

                        <div class="p-5"></div>

                        <div class="form-group">

                            <div class="col-lg-12 col-sm-12">

                                <div class=""><label class="float-left h-25"><b>Feedback</b></label></div>

                                <select class="form-control" id="survey_form" required="" name="survey_id">

                                    <option value="" selected="">--select--</option>

                                    <?php foreach ($list as $l_count=>$l_data):

                                        echo '<option value="'.$l_data->survey_id.'">'.$l_data->survey_name.'</option>';

                                    endforeach;

                                    ?>

                                </select>

                            </div>

                        </div>&nbsp;<br>

                        <div class="p-5"></div>

                        <div class="form-group" >

                            <div class="col-lg-12 col-sm-12">

                                <div class=""><label class="float-left h-25"><b>Trigger Rule</b></label></div>

                                <select name="rule" class="form-control">

                                    <option value="OR">Trigger when ANY condition match</option>

                                    <option value="AND">Trigger when ALL condition match</option>

                                </select>

                            </div>

                        </div>&nbsp;<br><br>



                    </div>

                    <!-- /.box-body -->

                </div>

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Alerts</h3>

                </div>

                <div class="box-body">

                    <div class="form-group">

                        <div class="">

                            <label>Get notified when a new response matches the applied conditions.</label>

                        </div>&nbsp;<br>

                        <div class="row">

                            <div class="col-lg-4 col-md-5 col-sm-12">

                                <div class="form-group">

                                    <select class="form-control" >

                                        <option>Email</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-8 col-md-7 col-sm-12 input-group">

                                <input type="email" name="trigger_email[]" value="<?=  ucwords($this->session->userdata('email')); ?>" class="form-control" id="email" placeholder="Enter Email" required="">

                                <span class="input-group-btn"><button type="button" class="btn btn-default" id="dltEmail">X</button></span>

                            </div>

                        </div>

                        <div id="emailAdd"></div>&nbsp;<br>

                        <div class="pull-right">

                            <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Alert</button>

                        </div> 

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-7 col-md-7 col-sm-12">

            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Conditions</h3>

                </div>

                <div class="box-body">

                    <div class="form-group">

                        <div class="col-lg-12">

                            <div class="">

                                <div class="form-group">

                                    <div class=""><label class="float-left h-25"><b>New Condition</b></label></div>

                                    <div id="viewQuestions"></div><!--Condition check questions add dynamic view question-->

                                    <div id="loading_main" style="display: none;">

                                        Loading Please Wait....

                                        <img src="<?= base_url();?>public/dist/img/gif/ajax-loader.gif" alt="Loading"/>

                                    </div>

                                </div>

                            </div>

                            

                        </div>

                        &nbsp;<br>

                        <div class="col-lg-12 ">

                            <button type="button" class="btn btn-default pull-right" id="addCondition"><i class="fa fa-plus"></i>&nbsp; Add &nbsp;</button>

                        </div> &nbsp;<br>

                        <table class="table table-hover">

                            <tbody id="question">

                            

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

        

    <div class="row">

        <div class="col-lg-12 pull-left">

            <input type="submit" id="btnTriggerSubmit" class="btn btn-success p-5" style="padding: 12px;" value="Save & Close" name="submit">

        </div>

    </div>

        <?php echo form_close(); ?>

</section>



<script>

    $('#addDiv1').click(function(){

        $('#emailAdd').append('<div class="row" id="emailDel"><div class="col-lg-4 col-md-5 col-sm-12">\n\

                                <div class="form-group">\n\

                                    <select class="form-control" name="">\n\

                                        <option>Email</option>\n\

                                    </select>\n\

                                </div>\n\

                            </div>\n\

                            <div class="col-lg-8 col-md-7 col-sm-12 input-group">\n\

                                <input type="email" name="trigger_email[]" class="form-control" id="firstname" placeholder="Enter Email" required=""><span class="input-group-btn"><button type="button" class="btn btn-default" id="dltEmail">X</button></span>\n\

                            </div></div>');

    });

    $('#emailAdd').on('click', '#dltEmail', function() {

       $('#emailDel').closest('div').remove();

      });

</script>





<script>

    $(document).ready(function() {

        $('select[id^="survey_form"]').on('change', function() {

            var survey_id = $(this).val();

            $('#loading_main').show();

            //alert(survey_id);

            $.ajax({

                url:"<?= site_url('admin/Notifications_C/get_questions')?>",

                type:'post',

                //dataType: 'json',

                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>','survey_id':survey_id},

                success: function(data){

                    $('#viewQuestions').html(data);

                    $('#loading_main').hide();

                    //$json = json_decode(data, true);

                    //alert($json['data'];);

                    

                }

            });

        });

    });

</script>



<script>

    $("#notifications_dashboard").addClass('active');

    //$("#simple-tables").addClass('active');
    $("#addCondition,#btnTriggerSubmit").click(function(){
        // alert($("tbody#question tr").length);
        if($("tbody#question tr").length>0) {
            $("#select_question").removeAttr("required");
        }
    });
</script>  