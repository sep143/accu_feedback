<style>
    .input-group-addon {
    background: transparent;
    border: none;
    color: #606476;
}
</style>
 <input type="hidden" value="<?= $questions->survey_id; ?>" id="survey_id">

 <select class="form-control" name="" id="select_question" required="">
    <option value="">--select--</option>
    <option value="total">Total Score</option>
    <?php
     $json1 = $questions->options;
     $questions = json_decode($json1, true);
     foreach ($questions['question'] as $q_count=>$q_data):
         $check = $questions['question'][$q_count]['type'];
     if($check == 1 ||$check == 2||$check == 3||$check == 4||$check == 6||$check == 7||$check == 8||$check == 9||$check == 10||$check == 11||$check == 12||$check == 13||$check == 14||$check == 15){
         ?>
            <option value="<?= $questions['question'][$q_count]['type']?>" data-count="<?= $q_count+1;?>"> Q<?= $q_count+1; ?>. <?= $questions['question'][$q_count]['text']['en']; ?></option>
    <?php }
     endforeach;
    ?>
</select>

<div class="p-5" style="margin-top: 20px;"></div>


    <div id="loading" style="display: none;">
        Loading Please Wait....
        <img src="<?= base_url();?>public/dist/img/gif/ajax-loader.gif" alt="Loading"/>
    </div>
<div id="sel_type">
    
</div>

<!--select question krne ke bad condition apply krne ke liye div open kr rkhe he wo h-->
<script>
    $(document).ready(function(){
        $('select[id^="select_question"]').change(function (){
            var type = $(this).val();
            var count = ($('#select_question').find(':selected').data('count')); //iska use question ka sequence ka pata krne ke liya liya he.
            var survey_id = $('#survey_id').val();
            $('#loading').show();
            //alert(survey_id);
            $.ajax({
                url:"<?= site_url('admin/Notifications_C/check_condition')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', type:type, count:count, survey_id:survey_id },
                success: function(data){
                    $('#sel_type').html(data);
                    $('#loading').hide();
                    //$json = json_decode(data, true);
                    //alert($json['data'];);
                }
            });
        });
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
                    $('#select_question').val('');
                    $('#sel_type').empty();
                     $('#question').on('click', '#dltQuestion', function() {
                            $(this).closest('tr').remove();
                        });
                }
            });
         //   }
            
        });
    });
</script>
