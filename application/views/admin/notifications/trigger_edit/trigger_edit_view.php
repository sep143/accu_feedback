<style>
    a.cancel:hover, a.cancel:active {text-decoration: underline;}
</style>
<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<section class="content">
    
   <?php echo form_open(base_url('admin/Notifications_C/trigger_update'), 'class=""'); ?> 
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Trigger</h3>
                        <div class=" pull-right">
                            <a href="<?= site_url('admin/Notifications_C/trigger'); ?>" class="cancel" style="font-size: 12px; color: white;" >Cancel <i class="fa fa-times"></i></a>
                        </div>
                    </div>
               
                    <div class="box-body">
                        <input type="hidden" name="trigger_id" value="<?= $survey_id->trigger_id; ?>">
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label>This name will appear in notifications generated from this trigger. Configure emails and question filters below.</label>
                            </div>&nbsp;<br>
                            <div class="col-lg-12 col-sm-12"><label for="surveyname" class="float-left h-25"><b>Name</b></label></div>
                        <?php if($adminRole == 2 || $otherRole == 11) { ?>    
                            <div class="col-lg-12 col-sm-12">
                                <input type="text" name="triggerName" value="<?= set_value('triggerName',$survey_id->trigger_name); ?>" class="form-control" id="firstname" placeholder="Enter Trigger Name" required="">
                            </div>
                        <?php }else{ ?>
                            <div class="col-lg-12 col-sm-12">
                                <input type="text" name="triggerName" value="<?= set_value('triggerName',$survey_id->trigger_name); ?>" class="form-control" id="firstname" placeholder="Enter Trigger Name" disabled="">
                            </div>
                        <?php }?>
                        </div>&nbsp;<br>
                        <div class="p-5"></div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <div class=""><label class="float-left h-25"><b>Survey</b></label></div>
                                <select class="form-control" id="survey_form" name="survey_id" disabled="">
                                    <?php foreach ($list as $l_count => $l_data):
                                        if($l_data->survey_id == $survey_id->survey_id){ ?>
                                    <option value="<?= $l_data->survey_id; ?>" <?= ($survey_id->survey_id == $l_data->survey_id) ? 'selected="selected"' : '' ; ?> > <?= $l_data->survey_name; ?></option>
                                     <?php   }
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>&nbsp;<br>
                        <div class="p-5"></div>
                        <div class="form-group" >
                            <div class="col-lg-12 col-sm-12">
                                <div class=""><label class="float-left h-25"><b>Trigger Rule</b></label></div>
                            <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <select name="rule" class="form-control">
                                    <?php if($survey_id->trigger_rule == 'OR') { ?>
                                        <option value="OR">Trigger when ANY condition match</option>
                                        <option value="AND">Trigger when AND condition match</option>
                                    <?php }else if($survey_id->trigger_rule == 'AND') { ?>
                                        <option value="AND">Trigger when AND condition match</option>
                                        <option value="OR">Trigger when ANY condition match</option>
                                    <?php } ?>
                                </select>
                            <?php }else{ ?>
                                <select name="rule" class="form-control" disabled="">
                                    <?php if($survey_id->trigger_rule == 'OR') { ?>
                                        <option value="OR">Trigger when ANY condition match</option>
                                        <option value="AND">Trigger when AND condition match</option>
                                    <?php }else if($survey_id->trigger_rule == 'AND') { ?>
                                        <option value="AND">Trigger when AND condition match</option>
                                        <option value="OR">Trigger when ANY condition match</option>
                                    <?php } ?>
                                </select>
                            <?php }?>
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
                        <div class="col-lg-12 col-sm-12">
                          <label>Get notified when a new response matches the applied conditions.</label>
                        </div>&nbsp;<br>
                        <?php
                       
                        $json_email = $survey_id->trigger_email; 
                        $email_data = json_decode($json_email, true);
                      if(!empty($email_data)) {
                        foreach ($email_data as $e_count => $e_data):  ?>
                        <div class="row">
                    <?php if($adminRole == 2 || $otherRole == 11){ ?>
                        <div id="del_email_row<?= $e_count+1; ?>">
                            <div class="col-lg-4 col-md-5 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" >
                                        <option>Email</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-12 input-group">
                                <input type="email" name="trigger_email[]" value="<?= set_value('trigger_email[]', $email_data[$e_count]); ?>" class="form-control" id="email" placeholder="Enter Email" required="">
                                <span class="input-group-btn"><button type="button" class="btn btn-default btn-info" id="dltEmail<?= $e_count+1; ?>">X</button></span>
                            </div>
                        </div>
                    <?php }  else { ?>
                          <div class="col-lg-4 col-md-5 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" disabled="">
                                        <option>Email</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-12">
                                <input type="email" name="trigger_email[]" value="<?= set_value('trigger_email[]', $email_data[$e_count]); ?>" class="form-control" disabled="">
                            </div>
                    <?php  } ?>
                        </div>
                        <?php endforeach;  } //if condition end agr email nahi hone pr nahi chale?>
                        <?php if($adminRole == 2 || $otherRole == 11){ ?>
                        <div id="emailAdd"></div>&nbsp;<br>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Alert</button>
                        </div> 
                        <?php } ?>
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
                    <?php if($adminRole == 2 || $otherRole == 11){  ?>
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
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-default pull-right" id="addCondition"><i class="fa fa-plus"></i>&nbsp; Add &nbsp;</button>
                        </div> &nbsp;<br>
                     <?php } ?>      
                        <table class="table table-hover">
                            <tbody id="question">
                                <?php
                                    $json1 = $survey_id->trigger_condition ;
                                    $json_data = json_decode($json1, TRUE);
                                    foreach ($json_data['condition'] as $row => $n): ?>
                            <tr>
                                <td>
                                    <input type="hidden" value="<?= $json_data['condition'][$row]['question_seq']?>" name="q_seq[]">
                                    <input type="hidden" value="<?= $json_data['condition'][$row]['question']?>" name="q_name[]">
                                    <input type="hidden" value="<?= $json_data['condition'][$row]['type']?>" name="q_type[]">
                                    <input type="hidden" value="<?= $json_data['condition'][$row]['condition']?>" name="q_condition[]">
                                    <input type="hidden" value="<?= $json_data['condition'][$row]['score']?>" name="q_score[]">
                                        <?= $json_data['condition'][$row]['question'] ?> is <strong><?= $json_data['condition'][$row]['condition']?> <?= $json_data['condition'][$row]['score']?></strong>
                                </td>
                                <td class="text-right"><a class="btn btn-default btn-xs" id="dltQuestion" >X</a></td>
                            </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row">
    <?php if($adminRole == 2 || $otherRole == 11){  ?>
        <div class="col-lg-12 pull-left">
            <input type="submit" class="btn btn-success p-5" style="padding: 12px;" value="Save & Close" name="submit">
        </div>
    <?php }else{ ?>
        <div class="col-lg-12 pull-left">
            <a href="<?= site_url('admin/Notifications_C/trigger'); ?>" class="btn btn-success" style="padding: 12px;">Back</a>
        </div>
    <?php }?>
    </div>
        <?php echo form_close(); ?>
</section>
<script>
     <?php
      foreach ($email_data as $e_count => $e_data): ?>
        $('#dltEmail<?= $e_count+1; ?>').on('click', function() {
           // alert('check');
          $('#del_email_row<?= $e_count+1; ?>').closest('div').remove();
        });    
    <?php  endforeach; ?>
</script>

<script>
      
    $('#addDiv1').click(function(){
        $('#emailAdd').append('<div class="row" id="emailDel"><div class="col-lg-4 col-sm-12">\n\
                                <div class="form-group">\n\
                                    <select class="form-control" name="">\n\
                                        <option>Email</option>\n\
                                    </select>\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-lg-8 col-sm-12 input-group">\n\
                                <input type="email" name="trigger_email[]" class="form-control" id="firstname" placeholder="Enter Email" required=""><span class="input-group-btn"><button class="btn btn-default btn-info" id="dltEmail">X</button></span>\n\
                            </div></div>');
    });
    $('#emailAdd').on('click', '#dltEmail', function() {
       $('#emailDel').closest('div').remove();
      });
</script>


<script>
    $(document).ready(function() {
       // $("#survey_form").on('change', function() {
            var survey_id = $('#survey_form').val();
            $('#loading_main').show();
            //alert(survey_id);
            $.ajax({
                url:"<?= site_url('admin/Notifications_C/getEdit_questions')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', survey_id : survey_id},
                success: function(data){
                    $('#viewQuestions').html(data);
                    $('#loading_main').hide();
                    //$json = json_decode(data, true);
                    //alert($json['data'];);
                    
                }
            });
       // });
    });
</script>



<!--this script use of condition add-->
<script>
    $(document).ready(function(){
        $('#addCondition').click(function(){
            var type = $('#select_question').val();
            var count = ($('#select_question').find(':selected').data('count'));
            var survey_id = $('#survey_id').val();
            var select_condition = $('#select_condition').val();
            var condition_value = $('#condition_value').val();
            
            var condition_value2 = $('#condition_value2').val();
            //alert(condition_value2);

            if(type == 'total'){
                var selet_value = $('#t_value').val();
                var value = $('#t_value_n').val();
                $('#question').append('<tr><td>\n\
                            <input type="hidden" value="Total" name="q_seq[]">\n\
                            <input type="hidden" value="Total Score" name="q_name[]">\n\
                            <input type="hidden" value="Total Score" name="q_type[]">\n\
                            <input type="hidden" value="'+ selet_value +'" name="q_condition[]">\n\
                            <input type="hidden" value="'+ value +'" name="q_score[]">"Total Score" is '+ selet_value +' <strong>'+ value +'</strong></td><td class="text-right"><a class="btn btn-default btn-xs" id="dltQuestion">X</a></td></tr>');
                 $('#question').on('click', '#dltQuestion', function() {
                            $(this).closest('tr').remove();
                        });
            }
          // if(type == 1){
                $.ajax({
                url:"<?= site_url('admin/Notifications_C/check_condition')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', type2:type, count2:count, survey_id:survey_id, select_condition:select_condition, condition_value:condition_value, condition_value2:condition_value2 },
                success: function(data){
                    $('#question').append(data);
                     $('#question').on('click', '#dltQuestion', function() {
                            $(this).closest('tr').remove();
                        });
                }
            });
         //   }
            
        });
    });
</script>

<script>
    $("#notifications_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  