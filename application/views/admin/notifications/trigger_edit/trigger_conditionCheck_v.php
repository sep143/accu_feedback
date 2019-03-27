<?php 
$json1 = $questions->options;
$questions = json_decode($json1, true);
if($types == 'total'){ ?>
<div class="row">
    <div class="col-lg-12 col-md-12" id="type0">
        <div class="col-lg-12 col-md-12 input-group" >
            <div class=" input-group-addon">
                <label class="">Total score is</label>
            </div>

            <div class="">
                <select class="form-control" id="t_value">
                    <option value="<"> < Less than</option>
                    <option value="<="> <= Less than or equal to</option>
                    <option value=">"> > Greater than</option>
                    <option value=">="> >= Greater than or equal to</option>
                    <option value="="> = Equal to</option>
                </select>
            </div>
            <div class="input-group-addon">
                <label>:</label>
            </div>
            <div class="">
                <input type="number" size="30" name="" id="t_value_n" class="form-control" required="" value="<?= set_value('','4'); ?>">
            </div>
        </div>
    </div>
</div>
<?php }else if($types == 1 || $types == 2){ ?>
<!--type star 1, multi star 2-->
<div class="row">
    <div class="col-lg-12 col-md-12" id="type1" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div>
                <select class="form-control" id="type1AS">
                    <option value="answer" selected="">Answer</option>
                    <option value="score">Score</option>
                </select>
            </div>
            <div class=" input-group-addon">
                <label class="">is</label>
            </div>

            <div class="">
                <select class="form-control" id="select_condition">
                    <option value="<"> < Less than</option>
                    <option value="<="> <= Less than or equal to</option>
                    <option value=">"> > Greater than</option>
                    <option value=">="> >= Greater than or equal to</option>
                    <option value="="> = Equal to</option>
                </select>
            </div>
            <div class="input-group-addon">
                <label>:</label>
            </div>
            <div class="" style="display: none;" id="scr">
                <input type="number" id="condition_value" size="30" name="" class="form-control" required="" value="<?= set_value('','4'); ?>">
            </div>
            <div class="" id="ans">
                <select class="form-control" id="condition_value2">
                    <option value="1">1 Star</option>
                    <option value="2">2 Star</option>
                    <option value="3" selected="">3 Star</option>
                    <option value="4">4 Star</option>
                    <option value="5">5 Star</option>
                </select>
            </div>
        </div>
        <script>
            $('select[id^="type1AS"]').on('change',function(){
                var val = $(this).val();
                if(val == 'answer'){
                    $('#ans').show();
                    $('#scr').hide();
                }else if(val == 'score'){
                    $('#ans').hide();
                    $('#scr').show();
                }
            });
        </script>
    </div>
</div>
<?php }else if($types == 3 || $types == 4){ ?>
<!--type smiley 3, multi smiley 4-->
<div class="row">
    <div class="col-lg-12 col-md-12" id="type3" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div>
                <select class="form-control" id="type3AS">
                    <option value="answer" selected="">Answer</option>
                    <option value="score">Score</option>
                </select>
            </div>
            <div class=" input-group-addon">
                <label class="">is</label>
            </div>

            <div class="">
                <select class="form-control" id="select_condition">
                    <option value="<"> < Less than</option>
                    <option value="<="> <= Less than or equal to</option>
                    <option value=">"> > Greater than</option>
                    <option value=">="> >= Greater than or equal to</option>
                    <option value="="> = Equal to</option>
                </select>
            </div>
            <div class="input-group-addon">
                <label>:</label>
            </div>
            <div class="" style="display: none;" id="scr3">
                <input type="number" id="condition_value" size="30" name="" class="form-control" required="" value="<?= set_value('','4'); ?>">
            </div>
            <div class="" id="ans3">
                <select class="form-control" id="condition_value2">
                    <option value="1">Very Sad</option>
                    <option value="2">Sad</option>
                    <option value="3" selected="">Neutral</option>
                    <option value="4">Happy</option>
                    <option value="5">Very Happy</option>
                </select>
            </div>
        </div>
        <script>
            $('select[id^="type3AS"]').on('change',function(){
                var val = $(this).val();
                if(val == 'answer'){
                    $('#ans3').show();
                    $('#scr3').hide();
                }else if(val == 'score'){
                    $('#ans3').hide();
                    $('#scr3').show();
                }
            });
        </script>
    </div>
</div>
<?php }else if($types == 6){ ?>
<!--type star 6, NPS-->
<div class="row">
    <div class="col-lg-12 col-md-12" id="type6" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div>
                <select class="form-control" id="type6AS">
                    <option value="answer" selected="">Answer</option>
                    <option value="score">Score</option>
                </select>
            </div>
            <div class=" input-group-addon">
                <label class="">is</label>
            </div>

            <div class="">
                <select class="form-control" id="select_condition">
                    <option value="<"> < Less than</option>
                    <option value="<="> <= Less than or equal to</option>
                    <option value=">"> > Greater than</option>
                    <option value=">="> >= Greater than or equal to</option>
                    <option value="="> = Equal to</option>
                </select>
            </div>
            <div class="input-group-addon">
                <label>:</label>
            </div>
            <div class="" style="display: none;" id="scr6">
                <input type="number" id="condition_value" size="30" name="" class="form-control" required="" value="<?= set_value('','4'); ?>">
            </div>
            <div class="" id="ans6">
                <input type="number" id="condition_value2" size="30" name="" class="form-control" required="" value="<?= set_value('','5'); ?>">
            </div>
        </div>
        <script>
            $('select[id^="type6AS"]').on('change',function(){
                var val = $(this).val();
                if(val == 'answer'){
                    $('#ans6').show();
                    $('#scr6').hide();
                }else if(val == 'score'){
                    $('#ans6').hide();
                    $('#scr6').show();
                }
            });
        </script>
    </div>
</div>
<?php }else if($types == 7 || $types == 8 || $types == 9 || $types == 10){ ?>
<!--type multiple choice one answer -7 -->
<div class="row">
    <div class="col-lg-12 col-md-12" id="type7" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div class=" input-group-addon">
                <label class="">Answer is</label>
            </div>
            <div class="sel_type7">
                <select class="form-control" id="select_condition">
                <?php foreach ($questions['question'] as $q_count=> $Q_data):
                    if($questions['question'][$q_count]['type'] == $types && $q_count+1 == $count){
                    foreach ($questions['question'][$q_count]['options']['en'] as $count=>$data):
                            $che1 = $questions['question'][$q_count]['type'];
                            if($che1 == $types){
                              ?>
                                <option value="<?= $questions['question'][$q_count]['options']['en'][$count]; ?>"><?= $questions['question'][$q_count]['options']['en'][$count]; ?></option>
                    <?php   } endforeach; } endforeach;  ?>
                </select>
            </div>
        </div>
    </div>
</div>

<?php }else if($types == 11){ ?>
<div class="row">
    <div class="col-lg-12 col-md-12" id="type7" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div class=" input-group-addon">
                <label class="">Answer is</label>
            </div>
            <div class="sel_type7">
                <select class="form-control" id="select_condition">
                    <option value="yes" selected="">YES</option>
                     <option value="no">No</option>
                </select>
            </div>
        </div>
    </div>
</div>
<?php }else if($types == 12){?>
<div class="row">
    <div class="col-lg-12 col-md-12" id="type7" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div class=" input-group-addon">
                <label class="">Answer is</label>
            </div>
            <div class="sel_type7">
                <select class="form-control" id="select_condition">
                <?php foreach ($questions['question'] as $q_count=> $Q_data):
                     if($questions['question'][$q_count]['type'] == $types && $q_count+1 == $count){
                        foreach ($questions['question'][$q_count]['options']['en']['matrix_column'] as $count=>$data):
                            $che1 = $questions['question'][$q_count]['type'];
                            if($che1 == $types){
                             ?>
                                <option value="<?= $questions['question'][$q_count]['options']['en']['matrix_column'][$count]; ?>"><?= $questions['question'][$q_count]['options']['en']['matrix_column'][$count]; ?></option>
                     <?php  } endforeach; } endforeach;  ?>
                </select>
            </div>
        </div>
    </div>
</div>
<?php }else if($types == 13 || $types == 14 || $types == 15){ ?>
<!--type comment box -13 -->
<div class="row">
    <div class="col-lg-12 col-md-12" id="type13" >
        <div class="col-lg-12 col-md-12 input-group" >
            <div class=" input-group-addon">
                <label class="">Answer is</label>
            </div>

            <div class="">
                <select class="form-control" id="select_condition">
                    <option value="<">Lenght < Less than</option>
                    <option value="<=">Lenght <= Less than or equal to</option>
                    <option value=">"> >Lenght Greater than</option>
                    <option value=">=" selected="">Lenght >= Greater than or equal to</option>
                    <option value="=">Lenght = Equal to</option>
                </select>
            </div>
            <div class="input-group-addon">
                <label>:</label>
            </div>
            <div class="" >
                <input type="number" id="condition_value" size="30" name="" class="form-control" required="" value="<?= set_value('','50'); ?>">
            </div>
            
        </div>
    </div>
</div>
<?php } ?>

