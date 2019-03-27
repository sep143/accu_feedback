<style>
    input[type="file"] {
        display: none;
    }
    .home_design{
        max-width: 445px;
        min-height: 250px;
        margin: 0 auto;
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
        background: #fff;
        position: relative;
    }
    .home{
        background: url("<?= base_url() ?>uploads/byDefault/bg.png") repeat scroll 0 0;
        background-size: cover;
        height: 250px;
        //background-color:#000;
        //background-repeat: no-repeat, repeat;
    }
    .home img{
        position: absolute;
        z-index: 100;
        margin-top: 30px;
        left: 38%;
        width: 80px;
    }

    .home .div1{
        color:#fff;
        text-align: center;
        z-index: 100;
        position: absolute;
        bottom: 90px;
        font-size: 17px;
        font-weight: 700;
        width: 100%;
    }
    .div2{
        position: absolute;
        bottom: 30px;
        width: 100%;
        text-align: center;
    }
    .home_button{
        border-radius: 20px;
        border: 1px solid #fff;
        text-align: center;
        font-size: 13px;
        font-weight: 700;
        padding: 5px 20px;
        background-color: rgba(0,0,0,.2);
        color: #fff;
        display: inline-block;
        min-width: 160px;
        min-height: 30px;
    }

    .surveyBox {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }

    .survey-header {
        color: #fff;
        padding: 15px;
        margin-bottom: 20px;
        border-bottom: 1px solid #f4f4f4;
        background: #6ac183;
    }
</style>
<?php
$adminRole = ucwords($this->session->userdata('role_id'));
$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<section class="content">
    
    <div class="row center center-block">
        
        <?php 
        $restaurant_id = ucwords($this->session->userdata('admin_id'));
        echo form_open(base_url('admin/Branding_C/branding_edit/'), 'class="form-horizontal" enctype="multipart/form-data"'); ?> 
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Branding</h3>
                    </div>
                    <div class="box-body">
                        <input type="hidden" name="restaurant_id" value="<?= ucwords($this->session->userdata('admin_id')); ?>">
                        <input type="hidden" name="branding_id" value="<?= $branding->b_id; ?>">
                        <div class="form-group">
                            <label for="brand_name" class="col-sm-12"><b>Name</b></label>
                            <div class="col-sm-12">
                                <input type="text" name="brand_name" value="<?= $branding->b_brand_name; ?>" class="form-control" id="brand_name" placeholder="Enter Brand Name" required="">
                            </div>
                            <label style="margin:20px;">The name is used only to identify this template. Use the section below to change images and text to match your brand.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div> <!--First Div Close-->
            <div class="col-md-12" >
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Home</h3>
                        </div>
                        <div class="box-body">
                            <div class="home_design">
                                <?php
                                //Backgroung image
                                    if($branding->b_home_background == NULL){
                                        $bg_path = '<?= base_url() ?>uploads/byDefault/bg.png';
                                    }else{
                                        $bg_path = base_url('uploads/'.$restaurant_id.'/'.$branding->b_home_background);
                                    }
                                //Logo Image
                                    if($branding->b_home_logo == NULL){
                                        $logo_path = 'uploads/byDefault/app_logo.png';
                                    }else{
                                        $logo_path = 'uploads/'.$restaurant_id.'/'.$branding->b_home_logo;
                                    }
                                //Thanks Image
                                    if($branding->b_home_thanks == NULL){
                                        $thanks_path = 'uploads/byDefault/thanks.jpg';
                                    }else{
                                        $thanks_path = 'uploads/'.$restaurant_id.'/'.$branding->b_home_thanks;
                                    }
                                ?>
                                <div class="home form-group" id="PreviewPicture" style="background-image: url(<?php echo $bg_path; ?>);">
                                    <img src="<?= base_url() ?><?= $logo_path; ?>" id="output">
                                    <!--div id="logoPut"></div-->
                                    <div class="home_text div1 change"  style="color: black;">
                                        <strong id="title_view"><?= $branding->b_home_title; ?></strong>
                                    </div>
                                    <div class="div2">
                                        <div class="home_button"  style="color: white;">
                                            <strong id="button_view"><?= $branding->b_home_button_text; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($adminRole == 2 || $otherRole == 11){ ?>
                            <div class="form-group col-xs-12 col-lg-12">
                                <hr>
                                <div><strong>Logo</strong></div>
                                <label class="btn btn-default" ><i class="fa fa-upload"></i> Change Logo<input type="file" name="home_logo" value="<?= set_value('home_logo', $branding->b_home_logo); ?>" onchange="loadFile(event)" size="60" accept="image/x-png,image/gif,image/jpeg"></label>
                                
                                <div>&nbsp;<br></div>
                                <div><strong>Background</strong></div>
                                <label class="btn btn-default"><i class="fa fa-upload"></i> Change Background<input type="file" name="home_bg_image" value="<?= set_value('home_bg_image', $branding->b_home_background); ?>" id="FileUpload" size="60" accept="image/x-png,image/gif,image/jpeg"></label>
                               
                            </div>
                           
                            <div >
                                <div class="form-group col-xs-12 col-lg-12">
                                    <div><strong>Title</strong></div>
                                    <input type="text" id="title" name="h_title" value="<?= $branding->b_home_title; ?>" onclick="showMe('title_view', this)" class="form-control">
                                    <textarea id="color-value" name="b_home_text_color" style="display:none;"></textarea>
                                </div>
                                <div class="form-group col-xs-12 col-lg-12">
                                    <div><lable><b>Title Color</b></lable></div>
                                    <div id="c1" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(0, 0, 0); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c2" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(255, 255, 255); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c3" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(31, 188, 156); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c4" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(28, 160, 133); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c5" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(46, 204, 112); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c6" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(39, 175, 96); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c7" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(51, 152, 219); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c8" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(41, 128, 185); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c9" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(164, 99, 191); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c10" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(142, 67, 173); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c11" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(61, 85, 110); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c12" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(46, 64, 83); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c13" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(242, 197, 17); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c14" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(243, 156, 25); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c15" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(232, 75, 60); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c16" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(192, 56, 43); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c17" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(221, 230, 232); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c18" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(189, 195, 200); cursor: pointer; border: 1px solid #000;"></div>
                                    <div id="c19" style="display: inline-block; width: 25px; height: 25px; margin-bottom: 6px; margin-right: 6px; border-radius: 6px; background-color: rgb(255, 255, 86); cursor: pointer; border: 1px solid #000;"></div>
                                </div>
                                <div class="form-group col-xs-12 col-lg-12">
                                    <b>Button</b>
                                    <input type="text" id="button_text" name="h_button_text" value="<?= $branding->b_home_button_text; ?>" class="form-control">
                                </div>
                            </div>
                             <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div><!--Second Div Home Page-->

            <!--Survey View start-->
            <div class="col-md-12" >
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Survey Page</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Color Theme</label>
                             <?php if($adminRole == 2 || $otherRole == 11){ ?>   
                                <select class="form-control" id="id_item-0-status" name="survey_color">
                                    <option value="#6ac183" <?php if($branding->b_home_survey_color == '#6ac183')  echo 'selected="selected"' ; ?>>Grass</option>
                                    <option value="#4fc1e9" <?php if($branding->b_home_survey_color == '#4fc1e9') echo 'selected="selected"';?>>Aqua</option>
                                    <option value="#081450" <?php if($branding->b_home_survey_color == '#081450') echo 'selected="selected"';?>>Midnight Blue</option>
                                    <option value="#754738" <?php if($branding->b_home_survey_color == '#754738') echo 'selected="selected"';?>>Chocolate</option>
                                    <option value="#ae6119" <?php if($branding->b_home_survey_color == '#ae6119') echo 'selected="selected"';?>>Caramel</option>
                                    <option value="#000000" <?php if($branding->b_home_survey_color == '#000000') echo 'selected="selected"';?>>Black</option>
                                    <option value="#62b3ae" <?php if($branding->b_home_survey_color == '#62b3ae') echo 'selected="selected"';?>>Tradewind Blue</option>
                                    <option value="#ffbf00" <?php if($branding->b_home_survey_color == '#ffbf00') echo 'selected="selected"';?>>Anzac Orange</option>
                                    <option value="#8a8a8a" <?php if($branding->b_home_survey_color == '#8a8a8a') echo 'selected="selected"';?>>Gray</option>
                                    <option value="#b3619d" <?php if($branding->b_home_survey_color == '#b3619d') echo 'selected="selected"';?>>Tapestry Violet</option>
                                    <option value="#c74e63" <?php if($branding->b_home_survey_color == '#c74e63') echo 'selected="selected"';?>>Ribbon Red</option>
                                </select>
                             <?php }else{ ?>
                                <select class="form-control" id="id_item-0-status" name="survey_color" disabled="">
                                    <option value="#6ac183" <?php if($branding->b_home_survey_color == '#6ac183')  echo 'selected="selected"' ; ?>>Grass</option>
                                    <option value="#4fc1e9" <?php if($branding->b_home_survey_color == '#4fc1e9') echo 'selected="selected"';?>>Aqua</option>
                                    <option value="#081450" <?php if($branding->b_home_survey_color == '#081450') echo 'selected="selected"';?>>Midnight Blue</option>
                                    <option value="#754738" <?php if($branding->b_home_survey_color == '#754738') echo 'selected="selected"';?>>Chocolate</option>
                                    <option value="#ae6119" <?php if($branding->b_home_survey_color == '#ae6119') echo 'selected="selected"';?>>Caramel</option>
                                    <option value="#000000" <?php if($branding->b_home_survey_color == '#000000') echo 'selected="selected"';?>>Black</option>
                                    <option value="#62b3ae" <?php if($branding->b_home_survey_color == '#62b3ae') echo 'selected="selected"';?>>Tradewind Blue</option>
                                    <option value="#ffbf00" <?php if($branding->b_home_survey_color == '#ffbf00') echo 'selected="selected"';?>>Anzac Orange</option>
                                    <option value="#8a8a8a" <?php if($branding->b_home_survey_color == '#8a8a8a') echo 'selected="selected"';?>>Gray</option>
                                    <option value="#b3619d" <?php if($branding->b_home_survey_color == '#b3619d') echo 'selected="selected"';?>>Tapestry Violet</option>
                                    <option value="#c74e63" <?php if($branding->b_home_survey_color == '#c74e63') echo 'selected="selected"';?>>Ribbon Red</option>
                                </select> 
                            <?php } ?>
                            </div>
                            <div class="center-block">
                                <div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 ">
                                        <div class="surveyBox">
                                            <div class="survey-header bg-color">
                                                <lable class="box-title" >How did you know about us?</lable>
                                            </div>
                                            <div class="box-body" style="text-align: center; padding: 20px; margin: 20px;">
                                                <div class="">
                                                    <div class="col-md-12">
                                                        <div class="col-md-5 bg-color" style="background-color: #6ac183; padding: 10px;">
                                                            <span style="color: white;">Facebook</span>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-5 bg-border" style="border: 1px solid #6ac183; padding: 10px;">
                                                            <span>Advertisement</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 10px;"></div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-5 bg-border" style="border:1px solid #6ac183; padding: 10px;">
                                                            <span>Friends</span>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-5 bg-border" style="border:1px solid #6ac183; padding: 10px;">
                                                            <span>Other</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div><!--Second Div Home Page-->
            <!--Thanks Page Start-->
            <div class="col-md-12" >
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thank You Page</h3>
                        </div>
                        <div class="box-body">
                            <div class="center-block">
                                <div>
                                    <div class="col-md-8 ">
                                        <div class="box">
                                            <div class="box-body">
                                                <img src="<?= base_url(); ?><?= $thanks_path; ?>" id="thank_you" style="width: 400px; height: auto;">
                                            </div>
                                        </div>
                                        <div class="pull-left">
                                            <label>This is a full screen image shown after the survey is complete. </label><br>
                                            <label><b>Note:</b> This is only a preview and might not be accurate when you view it on your device.</label>
                                        </div>
                                    <?php if($adminRole == 2 || $otherRole == 11){ ?>
                                        <div class="form-group pull-left">
                                            <label class="btn btn-default"><i class="fa fa-upload"></i> Change Image<input type="file" name="thanks_image" value="<?= set_value('thanks_image', $branding->b_home_thanks); ?>" class="form-control" id="imgThanks" accept="image/x-png,image/gif,image/jpeg"></label>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div><!--Second Div Home Page-->
            <!--Thanks Page End-->
            <!--Survey view end-->
        </div>
        <div class="col-md-12">
            <div class="col-md-2"></div>
        <?php if($adminRole == 2 || $otherRole == 11){ ?>
            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-success" value="Save & Update">
            </div>
        <?php }else{ ?>
            <div class="col-md-8">
                <a href="<?= site_url('admin/Branding_C/show'); ?>" class="btn btn-success">Back</a>
            </div>
        <?php } ?>
            <div class="col-md-2"></div>
        </div>
        <?php echo form_close(); ?>
    </div>  
    
</section> 
<!--Logo Change work done-->
<script> 
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

<!--Background Image change working-->
<script type="text/javascript">
    $(function () {
        $("#FileUpload").on("change", function () {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // Check if File is selected, or no FileReader support
            if (/^image/.test(files[0].type)) { //  Allow only image upload
                var ReaderObj = new FileReader(); // Create instance of the FileReader
                ReaderObj.readAsDataURL(files[0]); // read the file uploaded
                ReaderObj.onloadend = function () { // set uploaded image data as background of div
                    $("#PreviewPicture").css("background-image", "url(" + this.result + ")");
                }
            } else {
                alert("Upload an image");
            }
        });
    });
</script>

<!--Thank page view work done-->
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader1 = new FileReader();

            reader1.onload = function (e1) {
                $('#thank_you').attr('src', e1.target.result);
            }
            reader1.readAsDataURL(input.files[0]);
        }
    }

    $("#imgThanks").change(function () {
        readURL(this);
    });
</script>

<!--Home page Title type then view-->
<script type="text/javascript">
  
    $('#title').on('input', function () {
        //$('#field2').val($(this).val());
        $('#title_view').text($('#title').val());
    });

    /* 
     * Title text color change on click */
    $('#c1').click(function () {
        $('.change').css({'color': 'rgb(0, 0, 0)', 'font-size': '150%'});
        //$('#color-value').attr('value="rgb(0, 0, 0)"');
        document.getElementById("color-value").value = "#000000";
    });

    $('#c2').click(function () {
        $('.change').css({'color': 'rgb(255, 255, 255)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#ffffff";
    });

    $('#c3').click(function () {
        $('.change').css({'color': 'rgb(31, 188, 156)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#1fbc9b";
    });

    $('#c4').click(function () {
        $('.change').css({'color': 'rgb(28, 160, 133)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#1ca085";
    });

    $('#c5').click(function () {
        $('.change').css({'color': 'rgb(46, 204, 112)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#2ecc70";
    });

    $('#c6').click(function () {
        $('.change').css({'color': 'rgb(39, 175, 96)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#27af60";
    });

    $('#c7').click(function () {
        $('.change').css({'color': 'rgb(51, 152, 219)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#3398db";
    });

    $('#c8').click(function () {
        $('.change').css({'color': 'rgb(41, 128, 185)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#2980b9";
    });

    $('#c9').click(function () {
        $('.change').css({'color': 'rgb(164, 99, 191)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#a463bf";
    });

    $('#c10').click(function () {
        $('.change').css({'color': 'rgb(142, 67, 173)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#8e43ad";
    });

    $('#c11').click(function () {
        $('.change').css({'color': 'rgb(61, 85, 110)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#3d556e";
    });

    $('#c12').click(function () {
        $('.change').css({'color': 'rgb(46, 64, 83)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#2e4053";
    });

    $('#c13').click(function () {
        $('.change').css({'color': 'rgb(242, 197, 17)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#f2c511";
    });

    $('#c14').click(function () {
        $('.change').css({'color': 'rgb(243, 156, 25)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#f39c19";
    });

    $('#c15').click(function () {
        $('.change').css({'color': 'rgb(232, 75, 60)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#e84b3c";
    });

    $('#c16').click(function () {
        $('.change').css({'color': 'rgb(192, 56, 43)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#c0382b";
    });

    $('#c17').click(function () {
        $('.change').css({'color': 'rgb(221, 230, 232)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#dde6e8";
    });

    $('#c18').click(function () {
        $('.change').css({'color': 'rgb(189, 195, 200)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#bdc3c8";
    });

    $('#c19').click(function () {
        $('.change').css({'color': 'rgb(255, 255, 86)', 'font-size': '150%'});
        document.getElementById("color-value").value = "#ffff56";
    });
</script>

<!--Home page Button type then view-->
<script type="text/javascript">
    $('#button_text').on('input', function (e3) {
        //$('#field2').val($(this).val());
        $('#button_view').text($(this).val());
    });
</script>
<!--Select Option for survey then change color-->
<script>
    //$('select[id$=-status][id^=id_item-]').change(
     $(document).ready(function () {
           
            var change = $('#id_item-0-status').val();
           //alert(change);
           // if(change == '<?= $branding->b_home_survey_color?>'){
                if (change == '#6ac183') {
                    $('.bg-color').css('backgroundColor', '#6ac183');
                    $('.bg-border').css('border', '1px solid #6ac183');
                }
                else if (change == '#4fc1e9') {
                    $('.bg-color').css('backgroundColor', '#4fc1e9');
                    $('.bg-border').css('border', '1px solid #4fc1e9');
                }
                else if (change == '#081450') {
                    $('.bg-color').css('backgroundColor', '#081450');
                    $('.bg-border').css('border', '1px solid #081450');
                }
                else if (change == '#754738') {
                    $('.bg-color').css('backgroundColor', '#754738');
                    $('.bg-border').css('border', '1px solid #754738');
                }
                else if (change == '#ae6119') {
                    $('.bg-color').css('backgroundColor', '#ae6119');
                    $('.bg-border').css('border', '1px solid #ae6119');
                }
                else if (change == '#000000') {
                    $('.bg-color').css('backgroundColor', '#000000');
                    $('.bg-border').css('border', '1px solid #000000');
                }
                else if (change == '#62b3ae') {
                    $('.bg-color').css('backgroundColor', '#62b3ae');
                    $('.bg-border').css('border', '1px solid #62b3ae');
                }
                else if (change == '#ffbf00') {
                    $('.bg-color').css('backgroundColor', '#ffbf00');
                    $('.bg-border').css('border', '1px solid #ffbf00');
                }
                else if (change == '#8a8a8a') {
                    $('.bg-color').css('backgroundColor', '#8a8a8a');
                    $('.bg-border').css('border', '1px solid #8a8a8a');
                }
                else if (change == '#b3619d') {
                    $('.bg-color').css('backgroundColor', '#b3619d');
                    $('.bg-border').css('border', '1px solid #b3619d');
                }
                else if (change == '#c74e63') {
                    $('.bg-color').css('backgroundColor', '#c74e63');
                    $('.bg-border').css('border', '1px solid #c74e63');
                }
           //}
            });
    //);
    
   //after then select any option then change survey_color item 
     $('select[id$=-status][id^=id_item-]').change(
            function () {
                if ($(this).val() == '#6ac183') {
                    $('.bg-color').css('backgroundColor', '#6ac183');
                    $('.bg-border').css('border', '1px solid #6ac183');
                }
                if ($(this).val() == '#4fc1e9') {
                    $('.bg-color').css('backgroundColor', '#4fc1e9');
                    $('.bg-border').css('border', '1px solid #4fc1e9');
                }
                if ($(this).val() == '#081450') {
                    $('.bg-color').css('backgroundColor', '#081450');
                    $('.bg-border').css('border', '1px solid #081450');
                }
                if ($(this).val() == '#754738') {
                    $('.bg-color').css('backgroundColor', '#754738');
                    $('.bg-border').css('border', '1px solid #754738');
                }
                if ($(this).val() == '#ae6119') {
                    $('.bg-color').css('backgroundColor', '#ae6119');
                    $('.bg-border').css('border', '1px solid #ae6119');
                }
                if ($(this).val() == '#000000') {
                    $('.bg-color').css('backgroundColor', '#000000');
                    $('.bg-border').css('border', '1px solid #000000');
                }
                if ($(this).val() == '#62b3ae') {
                    $('.bg-color').css('backgroundColor', '#62b3ae');
                    $('.bg-border').css('border', '1px solid #62b3ae');
                }
                if ($(this).val() == '#ffbf00') {
                    $('.bg-color').css('backgroundColor', '#ffbf00');
                    $('.bg-border').css('border', '1px solid #ffbf00');
                }
                if ($(this).val() == '#8a8a8a') {
                    $('.bg-color').css('backgroundColor', '#8a8a8a');
                    $('.bg-border').css('border', '1px solid #8a8a8a');
                }
                if ($(this).val() == '#b3619d') {
                    $('.bg-color').css('backgroundColor', '#b3619d');
                    $('.bg-border').css('border', '1px solid #b3619d');
                }
                if ($(this).val() == '#c74e63') {
                    $('.bg-color').css('backgroundColor', '#c74e63');
                    $('.bg-border').css('border', '1px solid #c74e63');
                }
            }
    );
</script>

<!--if any data change than call script code and show popup box open and view-->
<script>
    $(document).ready(function(){
//      var _AreyousureLeaving = "Are you sure you want to leave ?";
//      var brand_name = $('input:text[name=brand_name]').each(function(){
//          $($('input:text[name=brand_name]')).keyup(function(){
//              $('input:text[name=brand_name]').val();
//          });
//      }); 
//      var brand_name2 = '<?= $branding->b_brand_name; ?>';
//      alert(brand_name);
//       if ((brand_name == brand_name2)) {
//window.onbeforeunload = function (evt) {
//                var message = _AreyousureLeaving;
////                  if (typeof evt == 'undefined') {
////                    evt = window.event;
////                }
//               
//                    //confirm(_AreyousureLeaving);
//                    //evt.returnValue = message;
//                    if(evt){
//                        confirm(_AreyousureLeaving);
//                    evt.returnValue = message;
//                    }
//                    
//                }
////                return message;  
//        }
        
//      $('li').on('click', function() {
//          //var brand_name = $('#brand_name').val();
//          //alert(brand_name);
//            if ( this.host !== window.location.host ) {
//                
//            $.alert({
//            title: 'Alert!',
//            content: 'Simple alert!',
//            confirm: function(){
//                alert('Confirmed!');
//            }
//        });
//          }
//       });         
//            $('li').on('click', function() {  
//                 if ( this.host !== window.location.host ) {
//                if (window.confirm('Really go to another page?')) {
//                    // They clicked Yes
//                   console.log('you chose to leave. bye.');
//                    alert('check');
//                  } else {
//                    // They clicked no
//                    alert('Else condition');
//                    console.log('you chose to stay here.');
//                    return false
//                }
//                
//               
//            }
//        }); 
            
    
});
</script>

<script>
    $("#brand_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  