<link rel="stylesheet" href="<?= base_url() ?>public/responses/responses_v1.css">

<?php

if($tableView){
 ?>
     
    <div data-v-d39bd79a="" class="responses-container">
        <div data-v-d39bd79a="" class="row">
            <div data-v-d39bd79a="" class="col-sm-5 col-md-4 col-lg-3 hidde">
                <div data-v-d39bd79a="" class="unread-toggle border-1" style="padding:10px; background-color: #eff0f4;">
                    <span data-v-d39bd79a="">Unread only </span> 
                    <div data-v-d39bd79a="" class="toggle-checkbox toggle-primary checkbox-inline toggle-sm pull-right">
                        <input data-v-d39bd79a="" type="checkbox" id="unread-checkbox" style="margin-left: -17px; margin-top: 5px;" onclick="unread()"> 
                        <label data-v-d39bd79a="" for="unread-checkbox"></label>
                    </div> 
                    <div data-v-d39bd79a="" class="clearfix"></div>
                </div> 
                <div data-v-d39bd79a="" class="list-group scroller response-selector">
                    <center><span data-v-d39bd79a="" id="unread_text" ></span></center>
                       <div id="Unread_view" style="display:block;"> 
                    <?php
                   
                     foreach ($tableView as $t_count=> $t_data):
                         $json_view = $t_data->answer_json;
                         $json_table = json_decode($json_view, true);
                          $q_id = 0;
                          $star=0; $smiley=0; $nps=0; $mstar=0;
                          $star_total=0; $smiley_total=0; $nps_total=0; $mstar_total=0;
                         foreach ($json_table['response'] as $j_count=>$j_view):
                             $check = $json_table['response'][$j_count]['type'];
                          if($check == 1 ){
                    $star = $json_table['response'][$j_count]['value'];
                    $star_total = 5;
                // echo "<i class='fa fa-star'></i> ".$json_table['response'][$j_count]['value']."/5<br>";
                }else if($check == 2){
                    $mstar_total = 0;
                    $mstar = 0;
                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                        //echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['option'].": ";
                        //echo "<i class='fa fa-star'></i> ".$json_table['response'][$q_id]['value'][$count]['value']."/5<br>";
                        $mstar += $json_table['response'][$q_id]['value'][$count]['value'];
                        if($json_table['response'][$q_id]['value'][$count]['value']){
                            $mstar_total += 5;
                        }
                        //echo $mstar;
                    endforeach;   //                 print_r($mstar);
                }else if($check == 3){
                    $smiley_total = 5;
                    $smiley = $json_table['response'][$j_count]['value'];
                    //echo "<i class='fa fa-smile-o'></i> ".$json_table['response'][$j_count]['value']."/5<br>";
                  }

               else if($check == 6){
                   $nps_total = 10;
                   $nps = $json_table['response'][$q_id]['value'];
                   //echo $json_table['response'][$q_id]['value'];
               }
                    $q_id++;           
                endforeach;
                $obtain = ((int)$star + (int)$smiley + (int)$nps + (int)$mstar);

               $total = $star_total + $smiley_total + $nps_total + $mstar_total; 

               $score_cal = (($obtain/$total)*10)/2;
               $score = round($score_cal, 2);
                    ?>
                        
                        <a data-v-d39bd79a="" class="list-active<?= $t_count; ?> list-group-item" id="device_select<?= $t_count; ?>" data-value="<?= $t_data->sa_id; ?>" style="cursor: pointer;">
                            <input type="hidden" value="<?= $t_data->survey_id; ?>" id="surveyId<?= $t_count; ?>">
                            <div data-v-d39bd79a="" class="row">
                                <div data-v-d39bd79a="" class="col-xs-9">
                                    <span data-v-d39bd79a="" class="time"> <?= date('d-M-Y', strtotime($t_data->answer_date)); ?>,<?= date('H:i a', strtotime($t_data->answer_date)); ?>  <!--19-Jun-2018, 12:42 pm--> </span> 
                                    <span data-v-d39bd79a="" class="location"></span> 
                                    <span data-v-d39bd79a="" class="device"><?= $t_data->device_info; ?></span>
                                </div> 
                                <div data-v-d39bd79a="" class="col-xs-3 score-display">
                                    <span data-v-d39bd79a="" class="score-title">Score</span> 
                                    <span data-v-d39bd79a="" class="score"><?= $score; ?></span>
                                </div>
                            </div>
                        </a>
                  <?php  endforeach;   ?>    
                </div>
              
            </div>
            </div> 
            <div data-v-d39bd79a="" class="col-sm-7 col-md-8 col-lg-9">
        <div data-v-d39bd79a="" class="scroller response-view">
        <div data-v-7fab6d66="" data-v-d39bd79a="">
            <div data-v-7fab6d66="" class="">
                <div data-v-7fab6d66="" class=""><!----></div> 
                <div data-v-7fab6d66="" class=""><!----> 
                    <div data-v-7fab6d66="" class="conversation"> 
                        <div id="loading2" style="display: none;" class="text-center">
                            Loading Please Wait....
                            <img src="<?= base_url(); ?>public/dist/img/gif/ajax-loader.gif" alt="Loading" />
                        </div>
                        <div id="respons_view">


                        </div>
                    </div>
                </div>
            </div></div>
    </div> 
                <br data-v-d39bd79a=""> <!----> <!---->
            </div>
        </div>
    </div>

<script>
   function unread() {
    var checkBox = document.getElementById("unread-checkbox");
    var text = document.getElementById("Unread_view");
    if (checkBox.checked == true){
        text.style.display = "none";
        document.getElementById('unread_text').innerHTML= 'No unread responses';
    } else {
       text.style.display = "block";
       document.getElementById('unread_text').innerHTML= '';
    }
}
</script>

<script>
    $(document).ready(function() {
        
        <?php foreach ($tableView as $t_count=> $t_data): ?>
          //first time first option select automectilly
           var d_id = $('#device_select0').attr('data-value');
            var survey = $('#surveyId0').val();
            $('#loading2').show();
            $('.list-group-item').removeClass('active');
            $.ajax({
                url:"<?= site_url('admin/Responses_C/responses_view')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', device_id :d_id , survey_id:survey },
                success: function(data){
                    $('#respons_view').html(data);
                    $('.list-active0').addClass('active');
                    $('#loading2').hide();
                    //$json = json_decode(data, true);
                    //alert($json['data'];);
                    
                }
            });
          
        $('#device_select<?= $t_count; ?>').click(function() {
            var d_id = $(this).attr('data-value');
            var survey = $('#surveyId<?= $t_count; ?>').val();
            $('#loading2').show();
            $('.list-group-item').removeClass('active');
            $.ajax({
                url:"<?= site_url('admin/Responses_C/responses_view')?>",
                type:'post',
                //dataType: 'json',
                data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', device_id :d_id , survey_id:survey },
                success: function(data){
                    $('#respons_view').html(data);
                    $('.list-active<?= $t_count; ?>').addClass('active');
                    $('#loading2').hide();
                    //$json = json_decode(data, true);
                    //alert($json['data'];);
                    
                }
            });
        });
        <?php endforeach;   ?>
    });
</script>


<?php

}  else {
      echo '<div class="alert" style="background-color:#fcf8e3; color:#8a6d3b;"><h5><i class="fa fa-exclamation-triangle"></i> No matching responses found for this survey in the selected date range / filters.</h5></div>';
 } //starting condtion check responses me data he tb hi yh detail de otherwise error dena ?>

