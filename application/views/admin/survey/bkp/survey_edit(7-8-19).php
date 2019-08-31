<style>
    .btn btn-default:hover{
        padding: 10px;
        background: #f6f7fb;
        cursor: pointer;
        //display: table;
        color: #000;
    }
    .option2{
    border: 1px solid #63b37a;
    color: #63b37a;
    border-radius: 3px;
    padding: 6px;
    margin: 10px;
    width: 90%;
    float: left;
    text-align: center;
    margin-top: 7px;
    }
    //this work type 9/10
    .option9{
    border: 1px solid #63b37a;
    color: #63b37a;
    border-radius: 3px;
    padding: 6px;
    margin: 10px;
    width: 95%;
    float: left;
    text-align: center;
    }
</style>
<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>

<section class="content">
    <div class="row">
        <?php echo form_open(base_url('admin/Survey_C/survey_update'), 'class="form-horizontal"'); ?> 
        <div class="col-md-12">

            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Survey</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <input type="hidden" name="restaurant_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">
                        <div class="form-group col-sm-12">
                            <label>The name is used only to identify this survey. Use the section below to set up your questions.</label>
                            <label for="surveyname" class=""><b>Name</b></label>
                            <div class="">
                                <input type="hidden" name="survey_id" value="<?= $survey_name->survey_id; ?>">
                                <input type="text" name="surveyname" value="<?= $survey_name->survey_name; ?>" class="form-control" id="firstname" placeholder="Enter Survey Name" required="">
                            </div>
                            <label for="surveyname" class=""><b>Select Language</b></label>
                            <div class="">
                                <select class="form-control" name="language_set">
                                    <?php
                                    if($language){
                                        foreach ($language as $lang_value){
                                            ?>
                                        <option value="<?= $lang_value->ID; ?>" <?= ($survey_name->language_set == $lang_value->ID)?'selected=""':''; ?> ><?= $lang_value->Name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!--Survey Add first box upper-->
            <!--Survey Question using AJAX code start box-->
            <div class="" >
                <div class="question">
                  <?php 
                    $json1 = $survey_name->options;
                    $json_data = json_decode($json1, TRUE); 
                    $mandatory_field_count = 0;
                    $data_fields_mandatory_count = 0;
                    if($json1){
                    $i=1;
                    $q=1;
                    foreach ($json_data['question'] as $Qcount=> $Qrow):
                  ?>
                <div class="col-md-7">
                    <div class="box">
                        <div class="box-body">
                            <input type="hidden" name="sequence_no[]" id="sequence<?= $Qcount+11; ?>" value="<?= $json_data['question'][$Qcount]['sequence_no']; ?>">
                            <input type="hidden" name="sequence_delete[]" id="sequence_delete<?= $Qcount+11; ?>">
                            
                            <div class="form-group input-group" style="padding: 19px 17px; background: #eff0f4; margin-top: -20px; margin-right: -21px; margin-left: -21px;">
                                <div class="input-group-addon order" style="background: #9c9cb0; color: white;"><?= $q; ?></div>
                                <textarea class="form-control" rows="2" name="question[]" id="qType<?= $Qcount+11; ?>" required=""><?= $json_data['question'][$Qcount]['text']['en']; ?></textarea>
                                <div class="input-group-addon" id="remove_field<?= $Qcount+11; ?>" data-seqid="<?= $Qcount; ?>" style="background: #eff0f4; color: #337ab7; cursor: pointer;"><i class="fa fa-close"></i></div>
                            </div>
                           
                            <div class="col-md-12">
                                <div class="form-group col-md-7">
                            <?php //this loop use only type select option insert to json formate then use
                            foreach ($types as $row):
                                if ($json_data['question'][$Qcount]['type'] == $row->t_id) {
                                    ?>
                                    <input type="hidden" value="<?= $row->t_id; ?>" name="survey_type[]">
                                    <!--<option class="form-control" value="<?= $row->t_id; ?>" selected=""> <?= $row->type_options; ?></option>-->
                            <?php } endforeach; ?>
                                    <select class="form-control" name="" id="survey_select<?= $Qcount+11; ?>" disabled="">
                                        <?php foreach ($types as $row): 
                                          if($json_data['question'][$Qcount]['type'] == $row->t_id){
                                          ?>
                                            <!--<input type="hidden" value="<?= $row->t_id; ?>" name="survey_type[]">-->
                                            <option class="form-control" value="<?= $row->t_id; ?>" selected=""> <?= $row->type_options; ?></option>
                                        <?php } endforeach;  ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="hidden" name="mandatory<?=$mandatory_field_count?>" value="NO">
                                <?php if($json_data['question'][$Qcount]['required'] == 'YES'){ ?>
                                    <input type="checkbox" name="mandatory<?=$mandatory_field_count?>" class="" value="YES" checked="checked" style="margin: 10px;">
                                    <!-- <input type="hidden" name="mandatory[<?php $i-1; ?>]" value="YES"> -->
                                <?php }else{ ?>
                                      <input type="checkbox" name="mandatory<?=$mandatory_field_count?>" class="" value="YES" style="margin: 10px;">
                                      
                                <?php } ?>
                                    <label class="">Mandatory</label>
                                </div>
                            </div>
                          <!--Single OPtion Box open-->
                          <div class="col-md-12" id="select_type_option<?= $Qcount+11; ?>" style="display: none;">
                              <?php // $data_field1 = json_decode($qes->options, TRUE);
                                $ch=$json_data['question'][$Qcount]['type'];
                                      if($ch == 2 || $ch == 4 ||$ch == 7 ||$ch == 8||$ch == 9||$ch == 10){
                                          //echo $data_field1['question'][$i-1]['type'];
//                                      if ($qes->question == $data_field1['question'][$i - 1]['text']['en']) {
                                        ?>
                                  <div class="form-group">
                                      <label class="control-label" for="parameterValue"><b>Options</b></label>
                                      <input type="hidden" name="optionName_id[]" value="<?= $Qcount; ?>">
                                       <?php
                                          foreach ($json_data['question'][$Qcount]['options']['en'] as $count => $dt):
                                        ?>
                                              <div class="" style="margin:10px;">
                                                  <input class="form-control" id="o_name<?= $Qcount+11; ?><?= $count+11; ?>" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" value="<?= $json_data['question'][$Qcount]['options']['en'][$count]; ?>"/>
                                                  <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->
                                              </div>
                                    <?php endforeach; ?> 
                                    <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                      <div id="viewDiv<?= $Qcount+11; ?>"></div><br>
                                      <div >
                                          <button type="button" class="btn btn-default" id="addDiv<?= $Qcount+11; ?>"><i class="fa fa-plus"></i> Add Option</button>
                                      </div>
                                    <?php } ?>
                                  </div>
                               <?php //} 
                                      } //this condition check if ?>
                              </div> 
                          <!--Single OPtion Box end-->
                          <!--Data Filed Box Open-->
                            <div class="col-md-12" id="DataField<?= $Qcount+11; ?>" style="display: none;">
                                 <?php //$data_field = json_decode($qes->options, TRUE); 
                                 if($json_data['question'][$Qcount]['type'] == 5){
                                     echo '<input type="hidden" name="optionData_id[]" value="'.$Qcount.'">';
//                                if($qes->question == $data_field['question'][$i-1]['text']['en']){
                                    foreach ($json_data['question'][$Qcount]['options']['en'] as $count=>$dt):
                              ?>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="optionData[<?= $Qcount; ?>][]">
                                       <?php if($json_data['question'][$Qcount]['options']['en'][$count]['type'] == 'text' or 'email' or 'checkbox' or 'number' or 'date' or 'phone'){
                                         ?>
                                            <option value="<?= $json_data['question'][$Qcount]['options']['en'][$count]['type']?>" selected=""><?= $json_data['question'][$Qcount]['options']['en'][$count]['type']?></option>
                                         <?php } ?>
<!--                                        <option value="">--Select--</option>
                                            <option value="text">Text</option>
                                            <option value="email">Email</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="number">Number</option>
                                            <option value="date">Date</option>
                                            <option value="phone">Phone</option>-->
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6 form-group">
                                        <input type="text" id="o_name<?= $Qcount+11; ?><?= $count+11; ?>" name="dataField[<?= $Qcount; ?>][]" value="<?= set_value('dataField[<?= $i-1; ?>][]',$json_data['question'][$Qcount]['options']['en'][$count]['label']) ?>" class="form-control">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2 form-group">
                                        <?php if($json_data['question'][$Qcount]['options']['en'][$count]['required'] == 'YES'){ ?>
                                        <div class="checkbox">
                                            <input type="hidden" name="dataFieldmen[<?= $Qcount ?>][<?=$count;?>]" value="NO"> 
                                            <input type="checkbox" class="chk_cls" value="YES" name="dataFieldmen[<?= $Qcount; ?>][<?=$count;?>]" checked="checked" data-chk-count="<?=$count?>"><span>Mandatory</span> 
                                        </div>
                                       <?php }else{ ?>
                                           <div class="checkbox">
                                               <input type="hidden" name="dataFieldmen[<?= $Qcount ?>][<?=$count;?>]" value="NO"> 
                                               <input type="checkbox" class="chk_cls" name="dataFieldmen[<?= $Qcount; ?>][<?=$count;?>]" value="" data-chk-count="<?=$count?>"><span>Mandatory</span> </div>
                                      <?php } ?>
                                    </div>
                                 </div>
                                   <?php endforeach; ?>
                                <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                <div class="" id="viewData<?= $Qcount+11; ?>"></div>
                                <div class="">
                                    <button type="button" class="btn btn-default" id="addData<?= $Qcount+11; ?>" data-chk-count="<?=$count?>"><i class="fa fa-plus"></i> Add Field</button>
                                </div> 
                                <?php } ?>
                                <?php     // } 
                                 } //this condition check if end ?>
                            </div>
                          <!--Data Filed Box Open-->
                         
                        <!--Matrix/Grid Option rows and columns this box start-->
                        
                        <div class="col-md-12" id="metrix<?= $Qcount+11; ?>" style="display: none;">
                             <?php //$data_field = json_decode($qes->options, TRUE);
                        if($json_data['question'][$i-1]['type'] == 12){
                                ?>   
                                <div class="">
                                    <div class="form-group">
                                        <label class="control-label"><b>Question Rows</b></label>
                                     <?php foreach ($json_data['question'][$Qcount]['options']['en']['matrix_row'] as $count=>$dt): ?>
                                        <div class="" style="margin:10px;">
                                            <input class="form-control" type="text" id="o_name<?= $Qcount+11; ?><?= $count+11; ?>" name="optionMetrix[<?= $Qcount; ?>][]" placeholder="" value="<?= $json_data['question'][$Qcount]['options']['en']['matrix_row'][$count]; ?>"/>
                                        </div>
                                      <?php  endforeach; ?>
                                        <div class="" id="matrixQuView<?= $Qcount+11; ?>">  </div><br>
                                        <div class="">
                                            <button type="button" class="btn btn-default" id="matrixQuAdd<?= $Qcount+11; ?>"><i class="fa fa-plus"></i> Add Option</button>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="parameterValue"><b>Answer Columns</b></label>
                                    <?php foreach ($json_data['question'][$Qcount]['options']['en']['matrix_column'] as $count=>$dt): ?>  
                                        <div class="" style="margin:10px;">
                                            <input class="form-control" id="ob_name<?= $count+11; ?>" type="text" name="metrixAnswer[<?= $Qcount; ?>][]" placeholder="" value="<?= $json_data['question'][$Qcount]['options']['en']['matrix_column'][$count]; ?>"/>
                                        </div>
                                    <?php  endforeach; ?>
                                    <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                        <div class="" id="matrixAnsView<?= $Qcount+11; ?>">
                                        </div><br>
                                        <div class="">
                                            <button type="button" class="btn btn-default" id="matrixAnsAdd<?= $Qcount+11; ?>"><i class="fa fa-plus"></i> Add Option</button>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                              
                             <?php } //this matrix condtion check if end ?>
                            </div>
                       
                        <!--Matrix/Grid Option rows and columns this box End-->
                        
                         <div class="col-md-12" id="numberRange<?= $Qcount+11; ?>" style="display: none;">
                             <?php $ch2=$json_data['question'][$Qcount]['type']; 
                             if($ch2 == 13 || $ch2 == 14 || $ch2 == 15) { ?>
                                <div class=""><br>
                                    <div class="col-md-5">
                                        <div class="form-group"><label><b>Minimum Length</b></label></div>
                                        <div class="form-group">
                                            <input type="number" value="<?= set_value('numMin',$json_data['question'][$Qcount]['min_range']); ?>" name="numMin" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group"><label><b>Maximum Length</b></label></div>
                                        <div class="form-group">
                                            <input type="number" value="<?= set_value('numMax',$json_data['question'][$Qcount]['max_range']); ?>" name="numMax" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><br><label>The limit sets the number of characters that can be entered.</label></div>
                             <?php }  //this type condition check use if ?>
                            </div>
                        
                        <!--Number Range count of Text Box, Comment Box, Number Box 3type use Box End--> 
                        
                            <!--Check code then remove use only jquery-->
                            <div class="col-md-12"></div>
                        </div>
                    </div>
                </div>
                 <!--Select Type box open-->
                <div class="col-md-5">
                    <div class="card" id="delTypeDiv<?= $Qcount+11; ?>">
                        <div class="box-header with-border">
                            <lable class="" id="qTypeView<?= $Qcount+11; ?>"></lable>
                        </div>
                        <div class="box-body">
                            <div class="" id="selectType<?= $Qcount+11; ?>">

                            </div>
                            <div id="typeDiv<?= $Qcount+11; ?>">

                            </div>
                        </div>
                    </div>
                </div>
               <?php
               $i++;
               $q++;
               $mandatory_field_count++;
                    endforeach; //for json formate in questions create
                    } //before loop chlne se pehle value check then loop chale
                    ?>
<!--                
                 <?php //foreach ($types as $code): ?>
                    <div class="//////<? $code->t_id?> code">
                        //<? $code->type_design_code; ?>
                    </div>
                <?php //endforeach; ?>
                    -->
                </div>
                <!--Using Ajax Code to generate div-->
                <div class="" id="myQuestion"></div>
               
            </div>


            <!--Survey Question using AJAX code end box-->
        
        <?php if($adminRole == 2 || $otherRole == 11){ ?>
            <div class="col-lg-12 col-xs-12">
            <button type="button" id="addQuestion" class="btn btn-default"><i class="fa fa-plus"></i> Add Question</button>
            <input type="submit" name="submit" class="btn btn-success" value="Save & Update">
            </div>
        <?php }else{ ?>
        <div class="col-lg-12 col-xs-12"><a href="<?= site_url('admin/Survey_C'); ?>" class="btn btn-default">Back</a></div>
       <?php } ?>
      </div>
        <?php echo form_close(); ?>
    </div>  
</section> 

<script>
    

   $(document).ready(function () {
    $("input[type=checkbox]").on('click',function(){

        // $(this).is(":checked")?alert("checked"):alert("Unchecked");
        $(this).is(":checked")?$(this).val("YES"):$(this).val("NO");
        // jQuery(this).closest('[type=checkbox]').attr('checked', true);
    });

    // $(".chk_cls").on('click',function(){
    //     $(this).is(":checked")?alert("checked"):alert("Unchecked");
    //     $(this).is(":checked")?$(this).val("YES"):$(this).val("NO");
    //     // jQuery(this).closest('[type=checkbox]').attr('checked', true);
    // });

 <?php 
   $qi=0;
   foreach ($json_data['question'] as $Qcount=> $Qrow):
       $qi++;
   endforeach;
   //this loop use only x value in insert for next question numbering
?>
        //var max_fields      = 10; //maximum input boxes allowed
        var wrapper = $("#myQuestion"); //Fields wrapper
        var add_button = $("#addQuestion"); //Add button ID
       // var x = <?= $qi; ?>; //initlal text box count
        var x = 40; //initlal text box count
        var q_id = <?= $qi-1; ?>;
        var counter1 = 0;
        //var s_id = 10;
        var divLen = $('div.iBox').length;
        //x = divLen+2;
        var mandatory_field_count = "<?=$mandatory_field_count;?>";
        var data_fields_mandatory_count = 0;
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            x++; //text box increment
             counter1++; //only increment 
             q_id++;
           var divLen = $('div.iBox').length;
           z = divLen+<?= $qi+1; ?>;
             
            if (x) { //max input box allowed
                $(wrapper).append('<div class="question" id="remove_div">\n\
                <div class="col-md-7">\n\
                    <div class="box iBox"><!--<a href="" id="remove_field" class="fa fa-plus pull-right"></a>-->\n\
                         <div class="box-body">\n\
                            <input type="hidden" name="sequence_no[]" id="sequence_'+ x +'" value="'+ (q_id + 1) +'">\n\\n\
                            <input type="hidden" name="sequence_delete['+q_id+']" id="sequence_delete">\n\
                            <div class="form-group input-group" style="padding: 19px 17px; background: #eff0f4; margin-top: -41px; margin-right: -21px; margin-left: -21px;">\n\
                                <div class="input-group-addon order" style="background: #9c9cb0; color: white;">'+z+'</div>\n\
                                <textarea class="form-control" rows="2" name="question[]" id="qType'+x+'" required=""></textarea>\n\
                                <div class="input-group-addon" id="remove_field" style="background: #eff0f4; color: #337ab7; cursor: pointer;" ><i class="fa fa-close"></i></div>\n\
                            </div>\n\
                            <div class="col-md-12">\n\
                                <div class="form-group col-md-7">\n\
                                    <select class="form-control" name="survey_type[]" id="survey_select'+x+'">\n\
                                        <?php foreach ($types as $row): ?>\n\
                                        <option class="form-control" value="<?= $row->t_id; ?>"> <?= $row->type_options; ?></option>\n\
                                        <?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class="col-md-5">\n\
                                    <input type="hidden" value="NO" name="mandatory'+mandatory_field_count+'"> <input type="checkbox" name="mandatory'+mandatory_field_count+'" class="" value="YES">\n\
                                    <label class="">Mandatory</label>\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-md-12" id="select_type_option_new'+x+'">\n\
                                \n\
                            </div> \n\
                            <div class="col-md-12" id="DataField_new'+x+'">\n\
                                \n\
                            </div>\n\
                            <div class="col-md-12" id="numberRange_new'+x+'">\n\
                                \n\
                            </div>\n\
                            <div class="col-md-12" id="metrix_new'+x+'">\n\
                                \n\
                            </div>\n\
                            <div class="col-md-12"></div>\n\
                        </div>\n\
                    </div>\n\
                </div>\n\
                 <div class="col-md-5">\n\
                    <div class="card">\n\
                        <div class="box-header with-border">\n\
                            <lable class="" id="qTypeView'+x+'">&nbsp;</lable>\n\
                        </div>\n\
                        <div class="box-body" ><div id="selectType'+x+'"></div><div id="typeDiv'+x+'"></div></div>\n\
                        </div>\n\
                </div>\n\
                </div>'
                ); //add input box

              mandatory_field_count++;
            }
            
            $.ajax({
                url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption: '1' },
                success: function(data){
                    $('#selectType'+x).html(data);
                    //$('#loading').hide(); 
                    }
            });
            
            $('textarea[id^="qType"]').on('input',function(){
            var data = $(this).val();
            var check1 = $(this).attr('id').slice(-2);
                $('#qTypeView'+check1).html(data);
            });
            
           $('select[id^="survey_select"]').change(function() {
            //$(this).find("option:selected").each(function(){
//            if(x <= 9){
//                var id=$(this).attr('id').slice(-1);
//            }
//           else if (10 <= 50){
                var id=$(this).attr('id').slice(-2);
           // }
                var selectOption = $(this).val();
                
            $.ajax({
                url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption, t_id:id},
                success: function(data){
                    $('#selectType'+id).html(data);
                    //$('#loading').hide(); 
                    }
            });
                if(selectOption == 1 || selectOption == 3 || selectOption == 6 || selectOption == 11){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    $('#selete_type_del'+id).remove();
                    $("#DataField_new_del"+id).remove();
                    $("#numberRange_new_del"+id).remove();
                    $("#metrix_new_del"+id).remove();
                }
                else if(selectOption == 2){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var a = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div id="viewDivDel'+id+a+'" class="input-group" style="margin:10px;"><input id="optionText'+id+a+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+a+'"><div><div style="float: left; width: 40%;" id="optionTextView'+id+a+'">&nbsp;</div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        a++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption == 4){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var b = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div id="viewDivDel'+id+b+'" class="input-group" style="margin:10px;"><input id="optionText'+id+b+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+b+'"><div><div style="float: left; width: 45%;" id="optionTextView'+id+b+'">&nbsp;</div><div style="float: left; width: 55%;"><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="100%" align="middle"></div></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        b++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption == 7){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var c = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div id="viewDivDel'+id+c+'" class="input-group" style="margin:10px;"><input id="optionText'+id+c+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+c+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+c+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        c++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption == 8){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var d = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div id="viewDivDel'+id+d+'" class="input-group" style="margin:10px;"><input id="optionText'+id+d+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+d+'"><div class="option2" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131);  color: rgb(255, 255, 255);" id="optionTextView'+id+d+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        d++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption == 9){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var e = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div class="input-group" style="margin:10px;"><input id="optionText'+id+e+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+'"><div class="option9" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+e+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        e++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption==10){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var f = 11;
                    $("#select_type_option_new"+id).html('<div id="selete_type_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+q_id+'][]" placeholder="" />\n\
                                        <!--span class="input-group-btn"><button class="btn btn-default"></button></span-->\n\
                                    </div>\n\
                                        <div class="" id="viewDiv_new'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv_new"+id).click(function() {
                            $("#viewDiv_new"+id).append('<div class="input-group" style="margin:10px;"><input id="optionText'+id+f+'" class="form-control" type="text" name="optionName['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+'"><div class="option9" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView'+id+f+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        f++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv_new'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_new_del"+id).remove();
                         $("#numberRange_new_del"+id).remove();
                         $("#metrix_new_del"+id).remove();
                }else if(selectOption==5){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var g = 11;
                    $('#DataField_new'+id).html('<div id="DataField_new_del'+id+'"><div class="col-md-12">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData['+ q_id +'][]">\n\
                                            <option value="">--Select--</option>\n\
                                            <option value="text">Text</option>\n\
                                            <option value="email">Email</option>\n\
                                            <option value="checkbox">Checkbox</option>\n\
                                            <option value="number">Number</option>\n\
                                            <option value="date">Date</option>\n\
                                            <option value="phone">Phone</option>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-6 form-group">\n\
                                       <input id="optionText'+id+'1" type="text" name="dataField['+ q_id +'][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"><input type="hidden" name="dataFieldmen['+ q_id +']['+data_fields_mandatory_count+']" value="NO"> <input type="checkbox" class="chk_cls" name="dataFieldmen['+ q_id +']['+data_fields_mandatory_count+']" aaaa value="YES"><span>Mandatory</span> </div>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="" id="viewData_new'+x+'">\n\
                                    \n\
                                </div>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addData_new'+x+'"><i class="fa fa-plus"></i> Add Field</button>\n\
                                    </div> \n\
                                </div>');
                          data_fields_mandatory_count++;
                         $("#addData_new"+id).click(function() {
                            $("#viewData_new"+id).append('<div class="col-md-12" id="delField'+id+g+'">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData['+ q_id +'][]">\n\
                                            <option value="">--Select--</option>\n\
                                            <option value="text">Text</option>\n\
                                            <option value="email">Email</option>\n\
                                            <option value="checkbox">Checkbox</option>\n\
                                            <option value="number">Number</option>\n\
                                            <option value="date">Date</option>\n\
                                            <option value="phone">Phone</option>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-6 form-group">\n\
                                        <input id="optionText'+id+g+'" type="text" name="dataField['+ q_id +'][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"><input type="hidden" name="dataFieldmen['+ q_id +']['+data_fields_mandatory_count+']" value="NO"> <input type="checkbox" value="YES" bbbb class="chk_cls" name="dataFieldmen['+ q_id +']['+data_fields_mandatory_count+']"><span>Mandatory</span><span id="dltDataField"  class="btn btn-default" style="margin-left: 81px; margin-top: -47px;">X</span></div>\n\
                                    </div>\n\
                                 </div>');

                            $("#typeDiv"+id).append('<div id="delDiv'+id+g+'"><div><span id="optionTextView'+id+g+'">&nbsp;</span></div><div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                            data_fields_mandatory_count++;
                        g++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewData_new'+id).on('click', '#dltDataField', function() {
                            var idx = $(this).closest('div').parent().parent().attr('id').slice(-4);
                            $('#delField'+idx).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                            
                        });
                    $('#selete_type_del'+id).remove();
                    $("#numberRange_new_del"+id).remove();
                    $("#metrix_new_del"+id).remove();
                }else if(selectOption==13 || selectOption==14 || selectOption==15){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    $('#numberRange_new'+id).html('<div id="numberRange_new_del'+id+'"><div class="col-md"><br>\n\
                                    <div class="col-md-5">\n\
                                        <div class="form-group"><label><b>Minimum Length</b></label></div>\n\
                                        <div class="form-group">\n\
                                            <input type="number" name="numMin" class="form-control">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-5">\n\
                                        <div class="form-group"><label><b>Maximum Length</b></label></div>\n\
                                        <div class="form-group">\n\
                                            <input type="number" name="numMax" class="form-control">\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="col-md-12"><br><label>The limit sets the number of characters that can be entered.</label></div></div>');
                    $('#selete_type_del'+id).remove();
                    $("#DataField_new_del"+id).remove();
                    $("#metrix_new_del"+id).remove();
                }else if(selectOption==12){
                    $("#viewDiv_new"+id).empty();
                    $("#typeDiv"+id).empty();
                    var h = 11;
                    var hh_n = 11;
                    $('#metrix_new'+id).html('<div id="metrix_new_del'+id+'"><div class="">\n\
                                    <div class="form-group">\n\
                                        <label class="control-label"><b>Question Rows</b></label>\n\
                                        <div class="" style="margin:10px;">\n\
                                            <!--<input class="form-control" type="text" name="optionMetrix['+q_id+'][]" placeholder="" />-->\n\
                                        </div>\n\
                                        <div class="" id="matrixQuView_new'+x+'">\n\
                                        </div><br>\n\
                                        <div class="">\n\
                                            <button type="button" class="btn btn-default" id="matrixQuAdd_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                        </div> \n\
                                    </div>\n\
                                    <div class="form-group">\n\
                                        <label class="control-label" for="parameterValue"><b>Answer Columns</b></label>\n\
                                        <div class="" style="margin:10px;">\n\
                                            <!--<input class="form-control" type="text" name="metrixAnswer['+q_id+'][]" placeholder="" />-->\n\
                                        </div>\n\
                                        <div class="" id="matrixAnsView_new'+x+'">\n\
                                        </div><br>\n\
                                        <div class="">\n\
                                            <button type="button" class="btn btn-default" id="matrixAnsAdd_new'+x+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                        </div> \n\
                                    </div>\n\
                                </div></div>');
                    //matrix row add
                        $('#matrixQuAdd_new'+id).click(function(){
                            $('#matrixQuView_new'+id).append('<div id="matrixRow'+id+h+'" class="input-group" style="margin:10px;"><input id="optionText'+id+h+'" class="form-control" type="text" name="optionMetrix['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $('#typeDiv'+id).append('<div id="delMetrix'+id+h+'"><div class="col-md-6"><span id="optionTextView'+id+h+'"></span></div><div class="col-md-6"><div id="colss'+id+h+'"></div></div></div>');
                            var cl = h-1;
                            var new_row = $('#colss'+id+cl).clone();
                            $('#colss'+id+h).append(new_row);
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        h++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#matrixQuView_new'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delMetrix'+idx).closest('div').remove();
                        });
                      //matrix in column Add
                        $('#matrixAnsAdd_new'+id).click(function() {
                            $('#matrixAnsView_new'+id).append('<div id="matrixCol'+id+hh_n+'" class="input-group" style="margin:10px;"><input id="columnText'+id+hh_n+'" class="form-control" type="text" name="metrixAnswer['+q_id+'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            if(hh_n > 11){
                                $('.columnAdd'+id).append('<div class="option9 del_type'+id+hh_n+' columnTextView'+id+hh_n+'" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);">&nbsp;</div>');
                            }else{
                                $('#colss'+id+hh_n).append('<div class="option9 del_type'+id+hh_n+' columnTextView'+id+hh_n+'" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);">&nbsp;</div><div class="columnAdd'+id+'"></div>');
                            }
                            $('input[id^="columnText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $(".columnTextView"+check1).text(data);
                            });
                        hh_n++;
                        });
                         $('input[id^="columnText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $(".columnTextView"+check1).text(data);
                        });
                        $('#matrixAnsView_new'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('.del_type'+idx).closest('div').remove();
                        });
                     $('#selete_type_del'+id).remove();
                     $("#DataField_new_del"+id).remove();
                    $("#numberRange_new_del"+id).remove();
                }
                else{
                    $('#selete_type_del'+id).remove();
                    $("#DataField_new_del"+id).remove();
                    $("#numberRange_new_del"+id).remove();
                    $("#metrix_new_del"+id).remove();
                }
            //});
        });
        
        });
         $(wrapper).on("click", "#remove_field", function (e) { //user click on remove text
            e.preventDefault();
                $(this).parent().parent().parent().parent().parent().closest('div').remove();
                $('div.order').text(function (x){
                   // return x + <?= $qi+1; ?>;
                });
            });
    });
</script>

<script>
    $(document).ready(function() {
  <?php
  $json1 = $survey_name->options;
  $json1 = str_replace("'", "", $json1);
  $json_data = json_decode($json1, TRUE ,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
    $i=1;
    foreach ($json_data['question'] as $Qcount=> $Qrow):
  ?>
        $(document).ready(function(){
            var data = $('textarea#qType<?= $Qcount+11; ?>').val();
            $('#qTypeView<?= $Qcount+11; ?>').html(data);
        });
        $('textarea[id^="qType<?= $Qcount+11; ?>"]').on('input',function(){
            var data = $(this).val();
            var check1 = $(this).attr('id').slice(-2);
                $('#qTypeView<?= $Qcount+11; ?>').html(data);
        });
        $('select[id^="survey_select<?= $Qcount+11; ?>"]').change(function() {
           // $(this).find("option:selected").each(function(){
                var id=$(this).attr('id').slice(-2);
                var selectOption = $(this).val();
//            $.ajax({
//                url:"<?= site_url('admin/Survey_C/selectType'); ?>",
//                type: 'post',
//                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption},
//                success: function(data){
//                    $('#selectType'+id).html(data);
//                    //$('#loading').hide(); 
//                    }
//            });
                
            if(selectOption){
                if(selectOption == 1 || selectOption == 3 || selectOption == 6 || selectOption == 11){
                    $.ajax({
                    url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                    type: 'post',
                    data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption},
                    success: function(data){
                        $('#selectType'+id).html(data);
                        //$('#loading').hide(); 
                        }
                    });
                
                }
                else if(selectOption == 2){
                    
                    <?php  if($json_data['question'][$Qcount]['type'] == 2){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count => $option_data): ?>
                        $("#typeDiv"+id).append('<div class="" id="delDiv'+id+'"><div><div style="float: left; width: 40%; margin-top: 7px;" id="v_name'+id+'<?= $option_count+11; ?>"><?php echo  $json_data['question'][$Qcount]['options']['en'][$option_count]; ?></div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
//                        $("#typeDiv"+id).append('<div class="" id="delDiv'+id+'"><div><div style="float: left; width: 40%; margin-top: 7px;" id="v_name'+id+'<?= $option_count+11; ?>"><?php echo  $json_data['question'][$Qcount]['options']['en'][$option_count]; ?></div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
                    <?php  endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                  $("#select_type_option"+id).show();
                  var a = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+a+'" class="input-group" style="margin:10px;"><input id="optionText'+id+a+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+a+'"><div><div style="float: left; width: 40%; margin-top: 7px;" id="optionTextView'+id+a+'">&nbsp;</div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        a++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            //a--;
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                            //alert('after delete');
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 4){
                     <?php  if($json_data['question'][$Qcount]['type'] == 4){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count => $option_data): ?>
                        $("#typeDiv"+id).append('<div class="" id="delDiv'+id+'"><div><div style="float: left; width: 45%; margin-top: 7px; margin:5px 0px;" id="v_name'+id+'<?= $option_count+11; ?>"><?php echo  $json_data['question'][$Qcount]['options']['en'][$option_count]; ?></div><div style="float: left; width: 55%;"><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="100%" align="middle"></div></div></div>');
                    <?php  endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $("#select_type_option"+id).show();
                        var b = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDiv'+id+b+'" class="input-group" style="margin:10px;"><input id="optionText'+id+b+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+b+'"><div><div style="float: left; width: 45%; margin-top: 7px; margin:5px 0px;" id="optionTextView'+id+b+'">&nbsp;</div><div style="float: left; width: 55%;"><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="100%" align="middle"></div></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        b++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            //a--;
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 7){
                    <?php  if($json_data['question'][$Qcount]['type'] == 7){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count => $option_data): 
                             if($option_count > 0){ ?>
                                $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div id="v_name'+id+'<?= $option_count+11; ?>" class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);"><?= $json_data['question'][$Qcount]['options']['en'][$option_count]; ?></div></div>');  
                           <?php  }else{ ?>
                                $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div id="v_name'+id+'<?= $option_count+11; ?>" class="option2" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);"><?= $json_data['question'][$Qcount]['options']['en'][$option_count]; ?></div></div>');
                    <?php  } endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $("#select_type_option"+id).show();
                    var c = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDiv'+id+c+'" class="input-group" style="margin:10px;"><input id="optionText'+id+c+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+c+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+c+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        c++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            //a--;
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 8){
                    <?php  if($json_data['question'][$Qcount]['type'] == 8){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count => $option_data): 
                             if($option_count > 1){ ?>
                                $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div id="v_name'+id+'<?= $option_count+11; ?>" class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);"><?= $json_data['question'][$Qcount]['options']['en'][$option_count]?></div></div>');  
                           <?php  }else{ ?>
                                
                                $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div id="v_name'+id+'<?= $option_count+11; ?>" class="option2" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);"><?= $json_data['question'][$Qcount]['options']['en'][$option_count]?></div></div>');
                    <?php       } 
                        endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $("#select_type_option"+id).show();
                    var d = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDiv'+id+d+'" class="input-group" style="margin:10px;"><input id="optionText'+id+d+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+d+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+d+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        d++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            //a--;
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 9){
                      <?php  if($json_data['question'][$Qcount]['type'] == 9){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count2=>$option_data): 
                            $value = $json_data['question'][$Qcount]['options']['en'][$option_count2];
                            //$value = 'Check';
                            if($json_data['question'][$Qcount]['options']['en'][0]){ ?>
                                $("#typeDiv"+id).append('<div class="col-md-12"><div id="v_name'+id+'<?= $option_count2+11; ?>" class="option9" style="border: 1px solid #63b37a; margin: 10px; border-radius: 3px; padding: 6px; width: 95%; float: left; text-align: center; border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);"><?php echo $value; ?></div></div>');
                           <?php  }else{ ?>
                                //$("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);"></div></div>');  
                                               
                    <?php       } 
                        endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $("#select_type_option"+id).show();
                    var e = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+e+'" class="input-group" style="margin:10px;"><input id="optionText'+id+e+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+e+'"><div class="option9" style="border: 1px solid #63b37a; margin: 10px; border-radius: 3px; padding: 6px; width: 95%; float: left; text-align: center; border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+e+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        e++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 10){
                    <?php  if($json_data['question'][$Qcount]['type'] == 10){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count2=>$option_data): 
                            $value = $json_data['question'][$Qcount]['options']['en'][$option_count2];
                            //$value = 'Check';
                            if($json_data['question'][$Qcount]['options']['en'][0]){ ?>
                                $("#typeDiv"+id).append('<div class="col-md-12"><div id="v_name'+id+'<?= $option_count2+11; ?>" class="option9" style="border: 1px solid #63b37a; margin: 10px; border-radius: 3px; padding: 6px; width: 95%; float: left; text-align: center; border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);"><?php echo $value; ?></div></div>');
                           <?php  }else{ ?>
                                //$("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);"></div></div>');  
                                               
                    <?php       } 
                        endforeach; 
                    } ?>
                     $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $("#select_type_option"+id).show();
                    var f = 11;
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+f+'" class="input-group" style="margin:10px;"><input id="optionText'+id+f+'" class="form-control" type="text" name="optionName[<?= $Qcount; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+f+'"><div class="option9" style="border: 1px solid #63b37a; margin: 10px; border-radius: 3px; padding: 6px; width: 95%; float: left; text-align: center; border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView'+id+f+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        f++;
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                     $("#metrix"+id).hide();
                }else if(selectOption == 5){
                 <?php  if($json_data['question'][$Qcount]['type'] == 5){
                        foreach ($json_data['question'][$Qcount]['options']['en'] as $option_count => $option_data): ?>
                              $("#typeDiv"+id).append('<div class=""><div><span id="v_name'+id+'<?= $option_count+11; ?>"><?= $json_data['question'][$Qcount]['options']['en'][$option_count]['label']; ?></span></div><div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div></div>');
                    <?php   endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                 $('#DataField'+id).show();

                 var g = 11;
                  
                         $("#addData"+id).click(function() {
                            // $(this).closest('[type=checkbox]').attr('checked', true);
                            // $(this).html("Hello");
                            // var chk; 
                            // chk = $(this).find("#DataField"+id).closest("input.chk_cls:last-child").data("chk-count");
                            var chk_count = $(this).data("chk-count");
                            chk_count = chk_count+1;
                            // alert(chk_count);
                            // console.log($(this).closest('span').html());

                            $("#viewData"+id).append('<div class="col-md-12" id="delField'+id+g+'">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData[<?= $i-1; ?>][]">\n\
                                            <option value="">--Select--</option>\n\
                                            <option value="text">Text</option>\n\
                                            <option value="email">Email</option>\n\
                                            <option value="checkbox">Checkbox</option>\n\
                                            <option value="number">Number</option>\n\
                                            <option value="date">Date</option>\n\
                                            <option value="phone">Phone</option>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-6 form-group">\n\
                                        <input id="optionText'+id+g+'" type="text" name="dataField[<?= $i-1; ?>][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"> <input type="hidden" name="dataFieldmen[<?= $i-1; ?>]['+chk_count+']" value="NO"><input type="checkbox" value="YES" cccc class="chk_cls" name="dataFieldmen[<?= $i-1; ?>]['+chk_count+']"><span>Mandatory</span><span id="dltDataField"  class="btn btn-default" style="margin-left: 81px; margin-top: -47px;">X</span></div>\n\
                                    </div>\n\
                                 </div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+g+'"><div><span id="optionTextView'+id+g+'">&nbsp;</span></div><div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        g++;
                        // alert(chk_count);
                          $(this).data("chk-count",chk_count);
                        // chk_count++;
                        });
                        $('#viewData'+id).on('click', '#dltDataField', function() {
                            //a--;
                            var idx = $(this).closest('div').parent().parent().attr('id').slice(-4);
                            $('#delField'+idx).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                    $("#select_type_option"+id).hide();
                    $("#numberRange"+id).hide();
                    $("#metrix"+id).hide();
                }else if(selectOption == 13 || selectOption == 14 || selectOption == 15){
                    $.ajax({
                        url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                        type: 'post',
                        data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption},
                        success: function(data){
                            $('#selectType'+id).html(data);
                            //$('#loading').hide(); 
                            }
                        });
                    $('#numberRange'+id).show();
                    $("#select_type_option"+id).hide();
                    $("#DataField"+id).hide();
                    $("#metrix"+id).hide();
                }else if(selectOption == 12){
                     <?php   $op = -3; $ob = 0;
                        if($json_data['question'][$Qcount]['type'] == 12){
                        foreach ($json_data['question'][$Qcount]['options']['en']['matrix_row'] as $option_count => $option_data): 
                            $op =+ $option_count;
                            ?>
                              $("#typeDiv"+id).append('<div><div class="col-md-6" style="width: 40%; float: left; margin-top: 7px;"><span id="v_name'+id+'<?= $option_count+11; ?>"><?= $json_data['question'][$Qcount]['options']['en']['matrix_row'][$option_count]; ?></span></div>\n\
                          <div class="col-md-6" style="width: 60%; float: left;"><div id="polar'+id+'<?= $option_count+11; ?>" class="columnAdd'+id+'">\n\
                            <?php foreach ($json_data['question'][$Qcount]['options']['en']['matrix_column'] as $button_count => $button_data):
                                $ob =+ $button_count;
                                if($button_count < 1){ 
                                echo '<div class="vb_name'. ($button_count+11) .'" class="option9" style="border: 1px solid #63b37a; margin: 3px; border-radius: 3px; padding: 6px; float: left; text-align: center; border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);">'.$json_data['question'][$Qcount]['options']['en']['matrix_column'][$button_count].'</div>';
                                }else{
                                 echo '<div class="vb_name'. ($button_count+11) .'" class="option9" style="border: 1px solid #63b37a; margin: 3px; border-radius: 3px; padding: 6px; float: left; text-align: center; border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);">'.$json_data['question'][$Qcount]['options']['en']['matrix_column'][$button_count].'</div>';
                                }
                            endforeach;
                            ?></div></div></div>\n\
                          ');
                    <?php   endforeach; 
                    } ?>
                    $('input[id^="o_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-4);
                        $("#v_name"+l_id).text(data);
                    });
                    $('input[id^="ob_name"]').on('input',function(){
                        var data = $(this).val();
                        var l_id = $(this).attr('id').slice(-2);
                        $(".vb_name"+l_id).text(data);
                    });
                    $('#metrix'+id).show();
                    var h = <?= $op+12; ?>;
                    var h1 = <?= $ob+12; ?>;
                        $('#matrixQuAdd'+id).click(function(){
                            $('#matrixQuView'+id).append('<div id="matrixQuViewDel'+id+h+'" class="input-group" style="margin:10px;"><input id="optionText'+id+h+'" class="form-control" type="text" name="optionMetrix[<?= $i-1; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $('#typeDiv'+id).append('<div id="delMetrix'+id+h+'"><div class="col-md-6" style="width: 40%; float: left;"><span id="optionTextView'+id+h+'"></span></div><div class="col-md-6" id="colss'+id+h+'" style="width: 60%; float: left;"></div></div>');
                            var cl = <?= $op+10; ?>;
                            //alert(cl);
                            var new_row = $('#polar'+id+cl).clone();
                            $('#colss'+id+h).append(new_row);
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        h++;
                        });
                        $('#matrixQuView'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delMetrix'+idx).closest('div').remove();
                        });
                      //matrix in column Add
                        $('#matrixAnsAdd'+id).click(function() {
                            //alert('column');
                            $('#matrixAnsView'+id).append('<div id="matrixAnsViewDel'+id+h1+'" class="input-group" style="margin:10px;"><input id="ob_name'+h1+'" class="form-control" type="text" name="metrixAnswer[<?= $i-1; ?>][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $('.columnAdd'+id).append('<div class="del_type'+id+h1+' vb_name'+h1+'" style="border: 1px solid #63b37a; margin: 3px; border-radius: 3px; padding: 6px; float: left; text-align: center; border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);">&nbsp;</div>');
                            $('input[id^="ob_name"]').on('input',function(){
                                var data = $(this).val();
                                var l_id = $(this).attr('id').slice(-2);
                                $(".vb_name"+l_id).text(data);
                            });
                        h1++;
                        });
                        $('#matrixAnsView'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('.del_type'+idx).closest('div').remove();
                        });
                     $("#select_type_option"+id).hide();
                     $("#DataField"+id).hide();
                     $("#numberRange"+id).hide();
                }
                else{
                    //$("#select_type_option").empty();
                        $("#select_type_option"+id).hide();
                        $("#DataField"+id).hide();
                        $("#numberRange"+id).hide();
                        $("#metrix"+id).hide();
                }
            } 
               //$("#survey_select1").remove();
              //$("#survey_select1").empty();
           // });
        });
        
        $('#remove_field<?= $Qcount+11; ?>').on("click", function (e) { //user click on remove text
            e.preventDefault();
           // if($("div.order").lenght > 1){
                var seqid = $(this).data('seqid');
                $('#sequence_delete<?= $Qcount+11; ?>').val(seqid);
                $(this).parent().parent().parent().closest('div').hide();
                $('#delTypeDiv<?= $Qcount+11; ?>').closest('div').hide();
//                $(this).parent().parent().parent().closest('div').remove();
//                $('#delTypeDiv<?= $Qcount+11; ?>').closest('div').remove();
                $('div.order').text(function (x){
                    //return <?= $q = $q; ?>;
                });
            });
   <?php $i++; endforeach; ?>   
        
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".code").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".code").hide();
            }
        });
    }).change();
});
</script>

<!--Questions type then view-->
<script type="text/javascript">
    $('#field1').on('input',function(e) {
        //$('#field2').val($(this).val());
        $('.field2').text($(this).val());
});
</script>

<script>
    $("#survey_dashboard").addClass('active');
</script>    