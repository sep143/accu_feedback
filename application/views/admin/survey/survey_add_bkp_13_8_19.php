<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
    .font-size11 {
        font-size: 12px;
        color: #6d7186;
    }
    .control-size {
        height: 32px!important;
    }
    #customerInfoForm>div{
        -webkit-box-shadow:0 0 8px rgba(212,213,217,0.8);
        -moz-box-shadow:0 0 8px rgba(212,213,217,0.8);
        box-shadow:0 0 8px rgba(212,213,217,0.8);
    }

</style>

<section class="content" ng-app="">
    <div class="row">
        <?php echo form_open(base_url('admin/Survey_C/addSurvey'), 'class="form-horizontal"'); ?> 
        <div class="col-md-12">

            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Feedback</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <input type="hidden" name="restaurant_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">
                        <div class="form-group">
                            <label class="col-sm-12">The name is used only to identify this feedback. Use the section below to set up your questions.</label>
                            <label for="surveyname" class="col-sm-12"><b>Name</b></label>
                            <div class="col-sm-12">
                                <input type="text" name="surveyname" class="form-control" id="firstname" placeholder="Enter Feedback Name" required="">
                            </div>

                            
                            <div class="col-sm-12">
                                <br>
                                <input type="hidden" name="customerInfoIsRequired" value="NO">
                                <input type="checkbox" name="customerInfoIsRequired" id="is_info_required" value="NO">
                                <label for="surveyname" ><b>Customer Info is Required</b> 
                                    <span data-toggle="popover" title="Check the checkbox, if you require customer info." data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fa fa-info-circle"></i></span>
                                </label>
                            </div>

                            <!-- <label for="surveyname" class="col-sm-12"><b>Select Language</b></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="language_set">
                                    <?php
                                    if($language){
                                        foreach ($language as $lang_value){
                                            ?>
                                        <option value="<?= $lang_value->ID; ?>"><?= $lang_value->Name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div> -->

                        </div>

                        <div id="customerInfoForm" class="font-size11" style="display: none; ">
                            <div style="border: 1px solid #dcd7d7; min-height:280px; height: auto; ">
                                <div class="form-group input-group" style="padding: 15px 13px; background: #eff0f4; margin-top: 20px; margin-right: 25px; margin-left: 25px;">
                                    <div class="input-group-addon" style="background: #9c9cb0; color: white;"><i class="fa fa-user"></i></div>
                                    <textarea class="form-control font-size11" rows="2" name="contactQuestion" id="contact_question" placeholder="exmp: Enter your contact information?">Enter your contact information?</textarea>
                                    <!-- <div class="input-group-addon" style="background: #eff0f4; color: #337ab7; cursor: pointer;"><i class="fa fa-close"></i></div> -->
                                </div>
                                <div style="padding: 15px 13px; margin-top: 20px; margin-right: -20px; margin-left: 0px;">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <input type="hidden" class="contact-form-field" name="contactFieldType[0]" value="text">
                                            <select class="form-control font-size11 control-size contact-form-field" name="contactFieldType[0]" disabled="">
                                                <option value="">--Select--</option>
                                                <option value="text" selected="">Text</option>
                                                <option value="email">Email</option>
                                                <option value="number">Number</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-6 form-group">
                                           <input type="text" id="contact_info_field0" name="contactFieldText[0]" class=" form-control font-size11 control-size contact-form-field" placeholder="exmp: Enter your full name." value="Enter your full name." >
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2 form-group font-size11 control-size">
                                            <div class="checkbox"> 
                                                <input type="hidden" name="contactFieldRequired[0]" value="NO">
                                                <input type="checkbox" value="YES" name="contactFieldRequired[0]" class="contact_info_chk0">
                                                <span>Mandatory</span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <input type="hidden" name="contactFieldType[1]" value="email">
                                            <select class="form-control font-size11 control-size" name="contactFieldType[1]" disabled="">
                                                <option value="">--Select--</option>
                                                <option value="text">Text</option>
                                                <option value="email" selected="">Email</option>
                                                <option value="number">Number</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-6 form-group">
                                           <input type="text" id="contact_info_field1" name="contactFieldText[1]" class=" form-control font-size11 control-size" placeholder="exmp: Enter your email address" value="Enter your email address">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2 form-group font-size11 control-size">
                                            <div class="checkbox"> 
                                                <input type="hidden" name="contactFieldRequired[1]" value="NO">
                                                <input type="checkbox" value="YES" name="contactFieldRequired[1]" class="contact_info_chk1">
                                                <span>Mandatory</span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <input type="hidden" name="contactFieldType[2]" value="number">
                                            <select class="form-control font-size11 control-size" name="contactFieldType[2]" disabled="">
                                                <option value="">--Select--</option>
                                                <option value="text">Text</option>
                                                <option value="email">Email</option>
                                                <option value="number" selected="">Number</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-6 form-group">
                                           <input type="text" id="contact_info_field2" placeholder="exmp: Enter your mobile number." name="contactFieldText[2]" class=" form-control font-size11 control-size" value="Enter your mobile number.">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2 form-group font-size11 control-size">
                                            <div class="checkbox"> 
                                                <input type="hidden" name="contactFieldRequired[2]" value="NO">
                                                <input type="checkbox" value="YES" name="contactFieldRequired[2]" class="contact_info_chk2">
                                                <span>Mandatory</span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!--Feedback Add first box upper-->
            <!--Feedback Question using AJAX code start box-->
            <div class="" >
                <div class="question">
                <div class="col-md-7">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group input-group" style="padding: 19px 17px; background: #eff0f4; margin-top: -20px; margin-right: -21px; margin-left: -21px;">
                                <div class="input-group-addon" style="background: #9c9cb0; color: white;">1</div>
                                <textarea class="form-control" rows="2" name="question[]" id="field1" required=""></textarea>
                                <div class="input-group-addon" style="background: #eff0f4; color: #337ab7; cursor: pointer;"><i class="fa fa-close"></i></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-7">
                                    <select class="form-control" name="survey_type[]" id="survey_select_1">
                                        <?php foreach ($types as $row): ?>
                                        <option class="form-control" value="<?= $row->t_id; ?>"> <?= $row->type_options; ?></option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                </div>
                                <?= $mandatoryCount=0;?>
                                <div class="col-md-5">
                                    <input type="hidden" name="mandatory<?=$mandatoryCount?>" value="NO">
                                    <input type="checkbox" name="mandatory<?=$mandatoryCount?>" class="" value="YES" style="margin: 10px;">
                                    <label class="">Mandatory</label>
                                </div>
                                <?= $mandatoryCount++;?>
                            </div>
                        <!--Type 2,4,7,8,9,10 for use Div-->
                            <div class="col-md-12" id="select_type_option">
                                
                            </div> 
                        <!--Type 5 for div use-->
                            <div class="col-md-12" id="DataField">
                                
                            </div>
                        <!--Type 12,13,14 for use Div-->    
                            <div class="col-md-12" id="numberRange">
                                
                            </div>
                        <!--Type 12 for Matrix Div-->   
                            <div class="col-md-12" id="metrix">
                                
                            </div>
                            <!--Check code then remove use only jquery-->
                            <div class="col-md-12"></div>
                        </div>
                    </div>
                </div>
                <!--Select Type box open-->
                <div class="col-md-5">
                    <div class="card">
                        <div class="box-header with-border">
                            <lable class="" id="field2">&nbsp;</lable>
                        </div>
                        <div class="box-body">
                            <div class="" id="selectType">

                            </div>
                            <div id="typeDiv1">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--Using Ajax Code to generate div-->
                <div class="" id="myQuestion"></div>
                
            </div>


            <!--Feedback Question using AJAX code end box-->
            <div class="col-md-12">
                <button type="button" id="addQuestion" class="btn btn-default"><i class="fa fa-plus"></i> Add Question</button>
                <input type="submit" name="submit" class="btn btn-success" value="Save & Close">
            </div>
            
        </div>
        
        <?php echo form_close(); ?>
    </div>  
</section> 
<!--<script>
   $(document).ready(function() {
        $('select[id^="survey_select1"]').on('change', function() {
            var search = $(this).val();
            //alert(search);
            $.ajax({
                url:"<?= site_url('admin/Survey_C/selectType')?>",
                type:'get',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>' ,'value':search},
                success: function(data){
                    $('#viewData1').html(data);
                    //$json = json_decode(data, true);
                    //alert($json['data'];);
                    
                }
            });
        });
  });
</script>-->

<script>
    $(document).ready(function () {
        //var max_fields      = 10; //maximum input boxes allowed
        var wrapper = $("#myQuestion"); //Fields wrapper
        var add_button = $("#addQuestion"); //Add button ID
        var x = 10; //initlal text box count
        var y = 1; //initlal text box count
       // var s_id = 10;
        var counter1 = 0;
        var mandatory_field_count = "<?=$mandatoryCount; ?>";
        
        $("#is_info_required").click(function(){
            var customerInfoIsRequired = ($("#is_info_required").is(":checked"))?"YES":"NO";
            $(this).val(customerInfoIsRequired);
            ($("#is_info_required").is(":checked"))?$('#contact_question').prop('required',true):$('#contact_question').removeAttr('required');

            if($(this).val() == "YES") {
                $("#customerInfoForm").slideDown(1000);
            }
            else {
                $("#customerInfoForm").slideUp(1000);
            }

        });

        // $(".contact_info_chk0").click(function(){
        //     ($(this).is(":checked"))?$('input#contact_info_field0').attr("required",""):$('input#contact_info_field0').removeAttr("required");
        // });
        // $(".contact_info_chk1").click(function(){
        //     ($(this).is(":checked"))?$('input#contact_info_field1').attr("required",""):$('input#contact_info_field1').removeAttr("required");
        // });
        // $(".contact_info_chk2").click(function(){
        //     ($(this).is(":checked"))?$('input#contact_info_field2').attr("required",""):$('input#contact_info_field2').removeAttr("required");
        // });
        
        $(add_button).click(function (e) { 
            e.preventDefault();
            x++; //text box increment
             counter1++; //only increment 
            // s_id++;
             var divLen = $('div.iBox').length;
             //alert(divLen+2);
             y = divLen+2;
            
            if (x) { //max input box allowed
                $(wrapper).append('<div class="question" id="remove_div">\n\
                <div class="col-md-7">\n\
                    <div class="box iBox">\n\
                    \n\
                         <div class="box-body">\n\
                            <div class="form-group input-group" style="padding: 19px 17px; background: #eff0f4; margin-top: -20px; margin-right: -21px; margin-left: -21px;">\n\
                                <div class="input-group-addon order" style="background: #9c9cb0; color: white;">'+y+'</div>\n\
                                <textarea class="form-control" rows="2" name="question[]" id="qType'+x+'" required=""></textarea>\n\
                                <div class="input-group-addon" id="remove_field" style="background: #eff0f4; color: #337ab7; cursor: pointer;"><i class="fa fa-close"></i></div>\n\
                            </div>\n\
                            <div class="col-md-12">\n\
                                <div class="form-group col-md-7">\n\
                                    <select class="form-control" name="survey_type[]" id="survey_select_'+x+'">\n\
                                        <?php foreach ($types as $row): ?>\n\
                                        <option class="form-control" value="<?= $row->t_id; ?>"> <?= $row->type_options; ?></option>\n\
                                        <?php endforeach; ?>\n\
                                    </select>\n\
                                </div>\n\
                                <div class="col-md-5">\n\
                                    <input type="hidden" name="mandatory'+mandatory_field_count+'" value="NO"><input type="checkbox" name="mandatory'+mandatory_field_count+'" class="" value="YES" style="margin: 10px;">\n\
                                    <label class="">Mandatory</label>\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-md-12" id="select_type_option'+x+'">\n\
                                \n\
                            </div> \n\
                            <div class="col-md-12" id="DataField'+x+'">\n\
                                \n\
                            </div>\n\
                            <div class="col-md-12" id="numberRange'+x+'" >\n\
                               \n\
                            </div>\n\
                            <div class="col-md-12" id="metrix'+x+'">\n\
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
                </div>'); //add input box
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
        //textarea in type then view text
        $('textarea[id^="qType"]').on('input',function(){
            var data = $(this).val();
            var check1 = $(this).attr('id').slice(-2);
                $('#qTypeView'+check1).html(data);
        });
            
           $('select[id^="survey_select_"]').change(function() {
            //$(this).find("option:selected").each(function(){
                var id = $(this).attr('id').slice(-2);
                var selectOption = $(this).val();
                //alert(selectOption);
        //if select type then open form open on view mobile view        
            $.ajax({
                url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption, t_id:id},
                success: function(data){
                    $('#selectType'+id).html(data);
                    //$('#loading').hide(); 
                    }
            });
            if(selectOption){
                if(selectOption == 1 || selectOption == 3 || selectOption == 6 || selectOption == 11){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    $("#DataField_del"+id).remove();
                    $("#numberRange_del"+id).remove();
                    $("#metrix_del"+id).remove();
                    $("#options_del"+id).remove();
                }
                else if(selectOption == 2){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                     var a = 11;
                    $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+id+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                            
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+a+'" class="input-group" style="margin:10px;"><input class="form-control" id="optionText'+id+a+'" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+a+'"><div><div id="optionTextView'+id+a+'" style="float: left; width: 40%;">&nbsp;</div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                         a++;
                        });
                        
                        //options wise view on card selete
                        $('input[id^="optionText"]').on('input',function(){
                            var data = $(this).val();
                            var check1 = $(this).attr('id').slice(-3);
                            $("#optionTextView"+check1).text(data);
                        });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            //a--;
                            var data = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+data).closest('div').remove();
                        });
                        
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 4){
                     $("#viewDiv"+id).empty();
                     $("#typeDiv"+id).empty();
                     var b = 11;
                     $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+id+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv"+id).click(function() {
                            
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+b+'" class="input-group" style="margin:10px;"><input class="form-control" id="optionText'+id+b+'" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="" id="delDiv'+id+b+'"><div><div style="float: left; width: 45%; margin:5px 0px;" id="optionTextView'+id+b+'">&nbsp;</div><div style="float: left; width: 55%; margin:5px 0px; "><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="100%" align="middle"></div></div></div>');
                            
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
                            
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 7){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    var c = 11; 
                    $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+id+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv"+id).click(function() {
                           // alert('One options');
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+c+'" class="input-group" style="margin:10px;"><input id="optionText'+id+c+'" class="form-control" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+c+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+c+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        c++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 8){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    var d = 11;
                    $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+d+'" class="input-group" style="margin:10px;"><input id="optionText'+id+d+'" class="form-control" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-6" id="delDiv'+id+d+'"><div class="option2" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131);  color: rgb(255, 255, 255);" id="optionTextView'+id+d+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        d++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 9){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    var e = 11; 
                    $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+e+'" class="input-group" style="margin:10px;"><input id="optionText'+id+e+'" class="form-control" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+e+'"><div class="option9" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextView'+id+e+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        e++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 10){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    var f = 11; 
                    $("#select_type_option"+id).html('<div id="options_del'+id+'" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionText'+id+'1" name="optionName['+ counter1 +'][]" placeholder="" />\n\
                                    </div>\n\
                                        <div class="" id="viewDiv'+x+'">\n\
                                        \n\
                                        </div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div> \n\
                                </div>');
                        $("#addDiv"+id).click(function() {
                            $("#viewDiv"+id).append('<div id="viewDivDel'+id+f+'" class="input-group" style="margin:10px;"><input id="optionText'+id+f+'" class="form-control" type="text" name="optionName['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv"+id).append('<div class="col-md-12" id="delDiv'+id+f+'"><div class="option9" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextView'+id+f+'">&nbsp;</div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        f++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewDiv'+id).on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                         $("#DataField_del"+id).remove();
                         $("#numberRange_del"+id).remove();
                         $("#metrix_del"+id).remove();
                }else if(selectOption == 5){
                    var data_fields_mandatory_count = 0;
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                    var g = 11;

                    $('#DataField'+id).html('<div id="DataField_del'+id+'"><div class="col-md-12">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData['+ counter1 +'][]">\n\
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
                                       <input type="text" id="optionText'+id+'1" name="dataField['+ counter1 +'][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"> <input type="hidden" value="NO" name="dataFieldmen['+ counter1+']['+data_fields_mandatory_count+']"><input type="checkbox" value="YES" name="dataFieldmen['+ counter1 +']['+data_fields_mandatory_count+']"><span>Mandatory</span> </div>\n\
                                    </div>\n\
                                 </div>\n\
                                <div class="" id="viewData'+id+'">\n\
                                    \n\
                                </div>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addData'+id+'"><i class="fa fa-plus"></i> Add Field</button>\n\
                                    </div></div>');
                            data_fields_mandatory_count++;
                         $("#addData"+id).click(function() {
                            $("#viewData"+id).append('<div class="col-md-12" id="delField'+id+g+'">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData['+ counter1 +'][]">\n\
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
                                        <input type="text" id="optionText'+id+g+'" name="dataField['+ counter1 +'][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"> <input type="hidden" value="NO" name="dataFieldmen['+ counter1 +']['+data_fields_mandatory_count+']"><input type="checkbox" value="YES" name="dataFieldmen['+ counter1 +']['+data_fields_mandatory_count+']"><span>Mandatory</span><span id="dltDataField"  class="btn btn-default" style="margin-left: 81px; margin-top: -47px;">X</span></div>\n\
                                    </div>\n\
                                 </div>');
                            $("#typeDiv"+id).append('<div id="delDiv'+id+g+'"><div><span id="optionTextView'+id+g+'">&nbsp;</span></div><div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div></div>');
                            $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-4);
                                $("#optionTextView"+check1).text(data);
                            });
                        g++;
                        data_fields_mandatory_count++;
                        });
                        $('input[id^="optionText"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewData'+id).on('click', '#dltDataField', function() {
                            var idx = $(this).closest('div').parent().parent().attr('id').slice(-4);
                            $('#delField'+idx).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                            
                        });
                    $("#options_del"+id).remove();
                    $("#numberRange_del"+id).remove();
                    $("#metrix_del"+id).remove();
                }else if(selectOption == 13 || selectOption == 14 || selectOption == 15){
                    $("#viewDiv"+id).empty();
                     $("#typeDiv"+id).empty();
                    $('#numberRange'+id).html('<div id="numberRange_del'+id+'"> <div class="col-md"><br>\n\
                                    <div class="col-md-5">\n\
                                        <div class="form-group"><label><b>Minimum Length</b></label></div>\n\
                                        <div class="form-group">\n\
                                            <input type="number" name="numMin['+ counter1 +'][]" class="form-control">\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-5">\n\
                                        <div class="form-group"><label><b>Maximum Length</b></label></div>\n\
                                        <div class="form-group">\n\
                                            <input type="number" name="numMax['+ counter1 +'][]" class="form-control">\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="col-md-12"><br><label>The limit sets the number of characters that can be entered.</label></div></div>');
                    $("#options_del"+id).remove();
                    $("#DataField_del"+id).remove();
                    $("#metrix_del"+id).remove();
                }else if(selectOption == 12){
                    $("#viewDiv"+id).empty();
                    $("#typeDiv"+id).empty();
                     var h = 11;
                     var hh_n = 11;
                    $('#metrix'+id).html('<div id="metrix_del'+id+'"> <div class="">\n\
                                    <div class="form-group">\n\
                                        <label class="control-label"><b>Question Rows</b></label>\n\
                                        <div class="" style="margin:10px;">\n\
                                            <!--<input class="form-control" id="optionText'+id+'1" type="text" name="optionMetrix['+ counter1 +'][]" placeholder="" />-->\n\
                                        </div>\n\
                                        <div class="" id="matrixQuView'+id+'">\n\
                                        </div><br>\n\
                                        <div class="">\n\
                                            <button type="button" class="btn btn-default" id="matrixQuAdd'+ id +'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                        </div> \n\
                                    </div>\n\
                                    <div class="form-group">\n\
                                        <label class="control-label" for="parameterValue"><b>Answer Columns</b></label>\n\
                                        <div class="" style="margin:10px;">\n\
                                            <!--<input class="form-control" type="text" id="columnText'+id+'1" name="metrixAnswer['+ counter1 +'][]" placeholder="" />-->\n\
                                        </div>\n\
                                        <div class="" id="matrixAnsView'+id+'">\n\
                                        </div><br>\n\
                                        <div class="">\n\
                                            <button type="button" class="btn btn-default" id="matrixAnsAdd'+id+'"><i class="fa fa-plus"></i> Add Option</button>\n\
                                        </div> \n\
                                        </div>\n\
                                </div></div>');
                        //$('#typeDiv'+id).append('<div id="delMetrix'+id+h+'"><div class="col-md-6"><span id="optionTextView'+id+h+'"></span></div><div class="col-md-6" id="colss'+id+h+'"></div></div>');
                        $('#matrixQuAdd'+id).click(function(){
                            $('#matrixQuView'+id).append('<div id="matrixRow'+id+h+'" class="input-group" style="margin:10px;"><input id="optionText'+id+h+'" class="form-control" type="text" name="optionMetrix['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $('#typeDiv'+id).append('<div id="delMetrix'+id+h+'"><div class="col-md-6"><span id="optionTextView'+id+h+'"></span></div><div class="col-md-6"><div id="colss'+id+h+'"></div></div></div>');
                            //$('#typeDiv'+id).prepend($('#matrixAnsView'+id))
                            //$('.colss'+id+h).append($('.colus'+id)).clone();
                            //var new_row = $('').clone();
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
                        $('#matrixQuView'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('#delMetrix'+idx).closest('div').remove();
                        });
                      //matrix in column Add
                        $('#matrixAnsAdd'+id).click(function() {
                            $('#matrixAnsView'+id).append('<div id="matrixCol'+id+hh_n+'" class="input-group" style="margin:10px;"><input id="columnText'+id+hh_n+'" class="form-control" type="text" name="metrixAnswer['+ counter1 +'][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
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
                        $('#matrixAnsView'+id).on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-4);
                            $(this).closest('div').remove();
                            $('.del_type'+idx).closest('div').remove();
                        });
                    $("#options_del"+id).remove();
                    $("#DataField_del"+id).remove();
                    $("#numberRange_del"+id).remove();
                }
                else{
//                    $("#viewDiv"+id).empty();
//                    $("#typeDiv"+id).empty();
//                    $("#DataField_del"+id).remove();
//                    $("#numberRange_del"+id).remove();
//                    $("#metrix_del"+id).remove();
//                    $("#options_del"+id).remove();
                }
             }
                
            //});
        });
    });
         
        $(wrapper).on("click", "#remove_field", function (e) { //user click on remove text
            e.preventDefault();
           // if($("div.order").lenght > 1){
                $(this).parent().parent().parent().parent().parent().closest('div').remove();
                x--;
                $('div.order').text(function (y){
                    return y + 2;
                });
           // }
            //x--;
            
        });
        
    });
 
</script>

<script type="text/javascript">
   // $(document).ready(function() {
        $('select[id^="survey_select_1"]').on('change', function() {
           // $(this).find("option:selected").each(function(){
                var id=$(this).attr('id').slice(-1);
                var selectOption1 = $(this).val();
              
            $.ajax({
                url:"<?= site_url('admin/Survey_C/selectType'); ?>",
                type: 'post',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', selectOption:selectOption1, t_id:id},
                success: function(data){
                        $('#selectType').html(data);
                    }
            });
            
                if(selectOption1 == 1 || selectOption1 == 3 || selectOption1 == 6 || selectOption1 == 11){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    $("#DataField_del").remove();
                    $("#numberRange_del").remove();
                    $("#metrix_del").remove();
                    $("#select_div_del").remove();
                }
                else if(selectOption1 == 2){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                  $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        var aa = 11;
                        $("#addDiv1").click(function() {
                            $("#viewDiv1").append('<div id="viewDiv'+id+aa+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+aa+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button type="button" class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div class="" id="delDiv'+id+aa+'"><div><div id="optionTextViewf'+id+aa+'" style="float: left; width: 40%;">&nbsp;</div><div style="float: left; width: 60%;"><img src="<?= base_url(); ?>image/survey/star.png" alt="Star" width="80%" align="middle"></div></div></div>');
                        
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                //alert(check1);
                                    $("#optionTextViewf"+check1).text(data);
                            });
                        aa++;
                        });
                            $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            //a--;
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 4){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    var bb = 11;
                    $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        $("#addDiv1").click(function() {
                           // alert('M-Smily');
                            $("#viewDiv1").append('<div id="viewDivDel'+id+bb+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+bb+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div class="" id="delDiv'+id+bb+'"><div><div style="float: left; width: 45%;margin:5px 0px;" id="optionTextViewf'+id+bb+'">&nbsp;</div><div style="float: left; width: 55%; margin:5px 0px;"><img src="<?= base_url(); ?>image/survey/smiley.png" alt="Star" width="100%" align="middle"></div></div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                //alert(check1);
                                    $("#optionTextViewf"+check1).text(data);
                            });
                        bb++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 7){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    var cc = 11;
                   $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        $("#addDiv1").click(function() {
                           // alert('One Options');
                            $("#viewDiv1").append('<div id="viewDivDel'+id+cc+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+cc+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div class="col-md-6" id="delDiv'+id+cc+'"><div class="option2" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextViewf'+id+cc+'">&nbsp;</div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        cc++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 8){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    var dd = 11;
                    $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        $("#addDiv1").click(function() {
                            $("#viewDiv1").append('<div id="viewDivDel'+id+dd+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+dd+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div id="delDiv'+id+dd+'" class="col-md-6" id="delDiv2"><div class="option2" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131);  color: rgb(255, 255, 255);" id="optionTextViewf'+id+dd+'">&nbsp;</div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        dd++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 9){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    var ee = 11;
                   $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        $("#addDiv1").click(function() {
                            $("#viewDiv1").append('<div id="viewDivDel'+id+ee+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+ee+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div id="delDiv'+id+ee+'" class="col-md-12" id="delDiv2"><div class="option9" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);" id="optionTextViewf'+id+ee+'">&nbsp;</div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        ee++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 10){
                    $("#viewDiv1").empty();
                    $("#typeDiv1").empty();
                    var ff = 11;
                    $("#select_type_option").html('<div id="select_div_del" class="form-group">\n\
                                    <label class="control-label" for="parameterValue"><b>Options</b></label>\n\
                                    <div class="" style="margin:10px;">\n\
                                        <input class="form-control" type="text" id="optionTextf'+id+'1" name="optionName[0][]" placeholder="" />\n\
                                    </div><div class="" id="viewDiv1"></div><br>\n\
                                    <div class="">\n\
                                        <button type="button" class="btn btn-default" id="addDiv1"><i class="fa fa-plus"></i> Add Option</button>\n\
                                    </div>\n\
                                </div>');
                        $("#addDiv1").click(function() {
                            $("#viewDiv1").append('<div id="viewDivDel'+id+ff+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+ff+'" class="form-control" type="text" name="optionName[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $("#typeDiv1").append('<div id="delDiv'+id+ff+'" class="col-md-12" id="delDiv2"><div class="option9" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);" id="optionTextViewf'+id+ff+'">&nbsp;</div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        ff++;    
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                               var data = $(this).val();
                               var check1 = $(this).attr('id').slice(-2);
                               //alert(check1);
                                   $("#optionTextView"+check1).text(data);
                           });
                        $('#viewDiv1').on('click', '#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delDiv'+idx).closest('div').remove();
                        });
                     $("#DataField_del").remove();
                     $("#numberRange_del").remove();
                     $("#metrix_del").remove();
                }else if(selectOption1 == 5){
                $("#typeDiv1").empty();
                var gg = 11;
                $('#DataField').html('<div id="DataField_del">\n\
                                <div class="col-md-12">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData[0][]">\n\
                                            <option value="">--Select--</option>\n\
                                            <option value="text">Text</option>\n\
                                            <option value="email">Email</option>\n\
                                            <option value="checkbox">Checkbox</option>\n\
                                            <option value="number">Number</option>\n\
                                            <option value="date">Date</option>\n\
                                            <option value="phone">Phone</option>\n\
                                        </select>\n\
                                    </div>\n\
                                    <div class="col-md-1"></div><div class="col-md-6 form-group">\n\
                                        <input type="text" id="optionTextf'+id+'1" name="dataField[0][]" class="form-control">\n\
                                    </div><div class="col-md-1"></div><div class="col-md-2 form-group"><div class="checkbox">\n\
                                            <input type="hidden" name="dataFieldmen[0]['+data_fields_mandatory_count+']" value="NO">\n\
                                            <input type="checkbox" value="YES" name="dataFieldmen[0]['+data_fields_mandatory_count+']"><span>Mandatory</span> </div></div>\n\
                                 </div>\n\
                                <div class="" id="viewData1"></div>\n\
                                <div class="">\n\
                                    <button type="button" class="btn btn-default" id="addData1"><i class="fa fa-plus"></i> Add Field</button>\n\
                                </div>\n\
                                </div>');
                    data_fields_mandatory_count++;
                         $("#addData1").click(function() {
                            $("#viewData1").append('<div class="col-md-12" id="delField'+id+gg+'">\n\
                                    <div class="form-group col-md-3">\n\
                                        <select class="form-control" name="optionData[0][]">\n\
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
                                        <input type="text" id="optionTextf'+id+gg+'" name="dataField[0][]" class="form-control">\n\
                                    </div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-2 form-group">\n\
                                        <div class="checkbox"> <input type="hidden" value="NO" name="dataFieldmen[0]['+data_fields_mandatory_count+']"><input type="checkbox" value="YES" name="dataFieldmen[0]['+data_fields_mandatory_count+']"><span>Mandatory</span><span id="dltDataField"  class="btn btn-default" style="margin-left: 81px; margin-top: -47px;">X</span></div>\n\
                                    </div>\n\
                                 </div>');
                            $("#typeDiv1").append('<div id="del_type'+id+gg+'"><div><span id="optionTextViewf'+id+gg+'">&nbsp;</span></div><div class=""><hr style="height:1px;border:none;color:#333;background-color:#333;" /></div></div>');
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        gg++;
                        data_fields_mandatory_count++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                //alert(data);
                                var check1 = $(this).attr('id').slice(-2);
                                $("#optionTextView"+check1).text(data);
                            });
                        $('#viewData1').on('click', '#dltDataField', function() {
                            var idx = $(this).closest('div').parent().parent().attr('id').slice(-3);
                            $('#delField'+idx).closest('div').remove();
                            $('#del_type'+idx).closest('div').remove();
                        });
                    $("#select_div_del").remove();
                    $("#numberRange_del").remove();
                    $("#metrix_del").remove();
                }else if(selectOption1 == 13 || selectOption1 == 14 || selectOption1 == 15){
                    $("#typeDiv1").empty();
                    $('#numberRange').html('<div id="numberRange_del">\n\
                                <div class="col-md"><br><div class="col-md-5"><div class="form-group"><label><b>Minimum Length</b></label></div>\n\
                                        <div class="form-group"><input type="number" name="numMin[0][]" class="form-control"></div></div>\n\
                                    <div class="col-md-1"></div>\n\
                                    <div class="col-md-5"><div class="form-group"><label><b>Maximum Length</b></label></div>\n\
                                        <div class="form-group"><input type="number" name="numMax[0][]" class="form-control"></div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="col-md-12"><br><label>The limit sets the number of characters that can be entered.</label></div>\n\
                                </div>');
                    $("#select_div_del").remove();
                    $("#DataField_del").remove();
                    $("#metrix_del").remove();
                }else if(selectOption1 == 12){
                    $("#typeDiv1").empty();
                    var hh = 11;
                    var hhh = 11;
                    $('#metrix').html('<div id="metrix_del">\n\
                                    <div class="form-group"><label class="control-label"><b>Question Rows</b></label>\n\
                                        <div class="" style="margin:10px;"><!--<input class="form-control" type="text" name="optionMetrix[0][]" placeholder="" />--></div>\n\
                                        <div class="" id="matrixQuView1"></div><br>\n\
                                        <div class=""><button type="button" class="btn btn-default" id="matrixQuAdd"><i class="fa fa-plus"></i> Add Option</button></div> \n\
                                    </div>\n\
                                    <div class="form-group"><label class="control-label" for="parameterValue"><b>Answer Columns</b></label>\n\
                                        <div class="" style="margin:10px;"><!--<input class="form-control" type="text" name="metrixAnswer[0][]" placeholder="" />--></div>\n\
                                        <div class="" id="matrixAnsView1"></div><br>\n\
                                        <div class=""><button type="button" class="btn btn-default" id="matrixAnsAdd"><i class="fa fa-plus"></i> Add Option</button></div> \n\
                                    </div>\n\
                                </div>');
                        $('#matrixQuAdd').click(function(){
                            $('#matrixQuView1').append('<div id="matrix'+id+hh+'" class="input-group" style="margin:10px;"><input id="optionTextf'+id+hh+'" class="form-control" type="text" name="optionMetrix[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            $('#typeDiv1').append('<div id="delMetrix'+id+hh+'"><div class="col-md-6"><span id="optionTextViewf'+id+hh+'"></span></div><div class="col-md-6"><div id="colss1'+hh+'"></div></div></div>');
                            var cl1 = hh-1;
                            var new_row = $('#colss1'+cl1).clone();
                            $('#colss1'+hh).append(new_row);
                            $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $("#optionTextViewf"+check1).text(data);
                            });
                        hh++;
                        });
                        $('input[id^="optionTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-2);
                                $("#optionTextViewf"+check1).text(data);
                            });
                            
                        $('#matrixQuView1').on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('#delMetrix'+idx).closest('div').remove();
                        });
                      //matrix in column Add
                        $('#matrixAnsAdd').click(function() {
                            $('#matrixAnsView1').append('<div id="matrixColumn'+id+hhh+'" class="input-group" style="margin:10px;"><input id="columnTextf'+id+hhh+'" class="form-control" type="text" name="metrixAnswer[0][]" placeholder="" /><span class="input-group-btn"><button class="btn btn-default" id="dltOption">X</button></span></div>');
                            if(hhh > 11){
                                $('.mDivCol-1').append('<div id="" class="option9 del_type'+id+hhh+' columnTextViewf'+id+hhh+'" style="border-color: rgb(106, 193, 131); color: rgb(106, 193, 131);">&nbsp;</div>');
                            }else{
                                $('#colss1'+hhh).append('<div class="option9 columnTextViewf'+id+hhh+'"" style="border-color: rgb(106, 193, 131); background-color: rgb(106, 193, 131); color: rgb(255, 255, 255);">&nbsp;</div><div class="mDivCol-1"></div>');
                            }
                            
                            $('input[id^="columnTextf"]').on('input',function(){
                                var data = $(this).val();
                                var check1 = $(this).attr('id').slice(-3);
                                $(".columnTextViewf"+check1).text(data);
                            });
                        hhh++;
                        });
                        $('#matrixAnsView1').on('click','#dltOption', function() {
                            var idx = $(this).closest('div').attr('id').slice(-3);
                            $(this).closest('div').remove();
                            $('.del_type'+idx).closest('div').remove();
                        });
                    $("#select_div_del").remove();
                    $("#DataField_del").remove();
                    $("#numberRange_del").remove();
                }
                else{
                   //$("#select_type_option").empty();
                        $("#select_div_del").remove();
                        $("#DataField_del").remove();
                        $("#numberRange_del").remove();
                        $("#metrix_del").remove();
                        
                }
                
              // } 
               //$("#survey_select1").remove();
              //$("#survey_select1").empty();
           // });
        });
        
        
   // });
</script>
<script>
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
        $('#field2').text($(this).val());
});
</script>

<script>
    $("#survey_dashboard").addClass('active');
</script>    