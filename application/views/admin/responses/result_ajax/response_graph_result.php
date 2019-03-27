<!--<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->

 <style>
	.card {
    position: relative;
    background-color: #fff;
    margin-bottom: 30px;
    border: 1px solid #e6ecf5;
    border-radius: 5px;
    transition: all .3s ease-in-out;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
}
.card .card-heading {
    padding: 15px 20px;
    position: relative;
}
.border.bottom {
    border: 0!important;
    border-bottom: 1px solid #e6ecf5!important;
}
.card .card-body {
    padding: 15px 20px;
}
.question-chart-body[data-v-0775d61a] {
    min-height: 550px;
}

.nps-container[data-v-bd07a6a0] {
    padding-top: 50px;
}
.nps-group[data-v-bd07a6a0] {
    background: #e9e9e9;
    height: 40px;
    width: 200px;
    margin: 10px auto;
    border-radius: 50px;
}
.nps-group .value.green[data-v-bd07a6a0] {
    background: #74b645;
}
.nps-group .value.yellow[data-v-bd07a6a0] {
    background: #fccf33;
}
.nps-group .value.red[data-v-bd07a6a0] {
    background: #ef5c46;
}
.nps-group .value[data-v-bd07a6a0] {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 8px 0;
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #fff;
}
.nps-group>div[data-v-bd07a6a0] {
    display: inline-block;
}
.nps-score[data-v-bd07a6a0] {
    margin: 30px auto;
    background: #74b645;
    display: block;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    text-align: center;
    color: #fff;
    font-size: 40px;
    font-weight: 700;
    padding-top: 10px;
}
.nps-score>span[data-v-bd07a6a0] {
    display: block;
    font-size: 12px;
}
.nps-container .trademark[data-v-bd07a6a0] {
    margin-top: 30px;
    padding: 10px;
    text-align: center;
}
.nps-container .trademark small[data-v-bd07a6a0] {
    font-size: 10px;
}

div#container{
    width: 500px;
}
</style>

<!-- For star count and view in column graph-->
<?php
if($tableView) { 
 $json1 = $question->options; 
 $json_question = json_decode($json1, true);

 ?>
<!--Star Off-->
 
<?php 
    
    foreach ($json_question['question'] as $Qcount => $Qrow):
        $ch_type = $json_question['question'][$Qcount]['type'];
    
    if($json_question['question'][$Qcount]['sequence_no'] == ($Qcount+1)){
        

        
       if($ch_type == 1){
    ?>
<div data-v-0775d61a="" class="col-lg-6">
    <div data-v-0775d61a="" class="card">
        <div data-v-0775d61a="" class="card-heading border bottom">
            <?= $json_question['question'][$Qcount]['text']['en']; ?>
        </div> 
        <div data-v-0775d61a="" class="card-body question-chart-body">
      <?php
    $st_total = 0;
    $st1 = 0; $st2 = 0; $st3 = 0; $st4 = 0; $st5 =0;
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
      $star1=0; 
         $star2=0; $star3=0; $star4=0; $star5=0;
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 1 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             
             if($star_json['response'][$star_answer]['value'] == 1){
                 $star1 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 2){
                 $star2 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 3){
                 $star3 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 4){
                  $star4 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 5){
                 $star5 += 1;
             }
         }
          
     endforeach;
      (int)$st1 += $star1;
      (int)$st2 += $star2;
      (int)$st3 += $star3;
      (int)$st4 += $star4;
      (int)$st5 += $star5;
     
      (int)$st_total += $star1 + $star2 + $star3 + $star4 + $star5; 
             
     endforeach; 
     if($st_total > 0){
     $st1_avg = (($st1/$st_total)*100);
     $st2_avg = (($st2/$st_total)*100);
     $st3_avg = (($st3/$st_total)*100);
     $st4_avg = (($st4/$st_total)*100);
     $st5_avg = (($st5/$st_total)*100);
     }
           
     $star_rating = (($st1*1)+($st2*2)+($st3*3)+($st4*4)+($st5*5));
     if($star_rating > 0){
     $rating = round(($star_rating/($st_total*5)*5), 2);
     }
      ?>      
            <div data-v-0775d61a="" class="text-center">Average Rating of 
                <strong data-v-0775d61a=""><?= $rating; ?></strong> from <strong data-v-0775d61a="">
             <?php echo $st_total; ?></strong> responses
            </div> 
            <div id="container<?= $Qcount; ?>" ></div>
            
        </div>
    </div>
</div> 
    <script type="text/javascript">
 $(function () {
     
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container<?= $Qcount; ?>',
            type: 'column'
        },
        title: {
            text: ""
        },
        yAxis:{
          title:{
              text:"% of respondents"
          },  
        },
        xAxis: {
           categories:['1/5','2/5','3/5','4/5','5/5']
        },
       tooltip: {
            //headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<br> <b>{point.y:.2f}%</b><br> {point.count} of <?= $st_total; ?> respondents'
        },
       series: [{
               "name":"Rating",
            data: [
                    {
                        "name":"1/5", 
                        "y":<?= $st1_avg; ?>,
                        "count":<?= $st1; ?>
                    },
                    {
                        "name":"2/5", 
                        "y":<?= $st2_avg; ?>,
                        "count":<?= $st2; ?>
                    },
                    {
                        "name":"3/5", 
                        "y":<?= $st3_avg; ?>,
                        "count":<?= $st3; ?>
                    },
                    {
                        "name":"4/5", 
                        "y":<?= $st4_avg; ?>,
                        "count":<?= $st4; ?>
                    },
                    {
                        "name":"5/5",
                        "y":<?= $st5_avg; ?>,
                        "count":<?= $st5; ?>
                    }]        
        }]
  
        
    });
   
});
</script><?php $st_total = "";
            $rating = ""; 
            
            ?>
<?php  }else if($ch_type == 2){ ?>
           <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="MultiStar<?= $Qcount; ?>" style="min-width: 310px; height: 400px; width: 500px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>



<script>
    $(function() {
  var multiChart = new Highcharts.chart( {
  chart: {
    renderTo: 'MultiStar<?= $Qcount; ?>',
    type: 'column'
  },
  title: {
    text: ''
  },
  subtitle: {
    text: 'Click on a column to view distribution'
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Average Rating'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y:.1f}'
      }
    }
  },

  tooltip: {
   // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br> {point.count} total<br/>'
  },

  "series": [
    {
      "name": "Browsers",
      "colorByPoint": true,
      "data": [
//        {
//          "name": "Chromeeee",
//          "y": 62.74,
//          "drilldown": "Chrome"
//        },
        <?php
    $multiStar = array();
    $multi_s_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 2 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             $multiStar[] = array();
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_s_name[$count] = $check[$count]['option'];
             if($d == 0){
                 $multi_star[$count] = 0;
             }
             if($check[$count]['value']){
                 $multiStar[$d][$count] = $check[$count]['value'];
              }
             endforeach;
            
         }
          
     endforeach;
     
     endforeach; 
     
     
         //   $value_total = array();
     foreach ($multiStar[0] as $count=> $nn):
         //$responses = sizeof($tableView);
         //echo $count;
            $temp = 0;
         foreach ($multiStar as $rCount=> $rn):

           $temp += $multiStar[$rCount][$count];
         endforeach;
          // $value_total[] = $temp;
         //echo $value_total[$count]."<br>";
           echo '{ "name":"'.$multi_s_name[$count].'", "y":'. $temp/sizeof($tableView) .', "drilldown": "' . $multi_s_name[$count]. '","count":' . $temp .'},';
      endforeach;
      
//      foreach ($multi_s_name as $option=>$on):
//          $view = array();
//          foreach ($value_total as $vc=> $vn):
//              $view[] = $value_total;
//          endforeach;
//      
//      //echo '{ "name":"'.$multi_s_name[$option].'", "y":'. ($view/sizeof($tableView)) .', "drilldown": "'.$multi_s_name[$option].'","count":' . $value_total[$option] .'},';
//      endforeach;
      
     
     ?>
      ]
    }
  ],
  "drilldown": {
  
    "series": [
        
//      {
//        "name": "Chrome",
//        "id": "Ease of Use",
//        "data": [
//          [
//            "v65.0",
//            0.1
//          ],
//          [
//            "v64.0",
//            1.3
//          ],
//          [
//            "v63.0",
//            53.02
//          ],
//          [
//            "v62.0",
//            1.4
//          ],
//        ]
//      },
      
      
      <?php
    $multiStar = array();
    $multi_s_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 2 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             $multiStar[$d]=array();
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_s_name[$count] = $check[$count]['option'];
             if($d == 0){
                 $multi_star[$count] = 0;
             }
             if($check[$count]['value']){
                 $multiStar[$d][$count] = $check[$count]['value'];
              }
             endforeach;
             
         }
          
     endforeach;
     
     endforeach; 
     
        //   $value_total = array();
     foreach ($multiStar[0] as $count=> $nn):
         //$responses = sizeof($tableView);
         //echo $count;
            $temp = array();
            
            $temp[1] = array('1/5',0); $temp[2] = array('2/5',0); $temp[3] = array('3/5',0); $temp[4] = array('4/5',0); $temp[5] = array('5/5',0);
         foreach ($multiStar as $rCount=> $rn):

           $temp[$multiStar[$rCount][$count]][1] = (int)$multiStar[$rCount][$count];
         endforeach;
         //echo json_encode($temp[1]);
          // echo '{ "name":"'.$multi_s_name[$count].'", "y":'. $temp/sizeof($tableView) .', "drilldown": "' . $multi_s_name[$count]. '","count":' . $temp .'},';
         echo '{ "name":"'.$multi_s_name[$count].'", "id":"'. $multi_s_name[$count] .'","data": [' . json_encode($temp[1]) . ' , '. json_encode($temp[2]) .','. json_encode($temp[3]).','. json_encode($temp[4]) .','.json_encode($temp[5]).'], },';
      endforeach;
             
     ?>
      
      
    ]
  }
});
});
</script>




<?php }else if($ch_type == 3){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="piaChart<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>

 <?php
         //$t_star=array();  
    $sm_total = 0;
    $sm1 = 0; $sm2 = 0; $sm3 = 0; $sm4 = 0; $sm5 =0;
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
      $smiley1=0; $smiley2=0; $smiley3=0; $smiley4=0; $smiley5=0;
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 3 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             
             if($star_json['response'][$star_answer]['value'] == 1){
                 $smiley1 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 2){
                 $smiley2 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 3){
                 $smiley3 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 4){
                  $smiley4 += 1;
             }else if($star_json['response'][$star_answer]['value'] == 5){
                 $smiley5 += 1;
             }
         }
          
     endforeach;
      $sm1 += $smiley1;
      $sm2 += $smiley2;
      $sm3 += $smiley3;
      $sm4 += $smiley4;
      $sm5 += $smiley5;
     
      $sm_total2 = ($smiley1) + ($smiley2) + ($smiley3) + ($smiley4) + ($smiley5); 
     endforeach; 

     $sm_total = $sm1 + $sm2 + $sm3 + $sm4 + $sm5;
     
     $very_happy = (((int)$sm5/(int)$sm_total)*100);
     $happy = (((int)$sm4/(int)$sm_total)*100);
     $neutral = (((int)$sm3/(int)$sm_total)*100);
     $sad = (((int)$sm2/(int)$sm_total)*100);
     $very_sad = (((int)$sm1/(int)$sm_total)*100);
      ?> 

<script>
   $(function() {
  var pieChart = new Highcharts.chart( {
  chart: {
    renderTo: 'piaChart<?= $Qcount; ?>', 
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '<b>{point.percentage:.1f}%</b> <br> {point.count} of <?= $sm_total; ?> respondents'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Smiley',
    colorByPoint: true,
    data: [{
      name: 'Very Happy: ',
      y: <?= $very_happy; ?>,
      count: <?= $sm5; ?>,
      sliced: true,
      selected: true
    }, {
      name: 'Happy: ',
      y: <?= $happy; ?>,
      count: <?= $sm4; ?>
    }, {
      name: 'Neutral: ',
      y: <?= $neutral; ?>,
      count: <?= $sm3; ?>
    }, {
      name: 'Sad: ',
      y: <?= $sad; ?>,
      count: <?= $sm2; ?>
    }, {
      name: 'Very Sad: ',
      y: <?= $very_sad; ?>,
      count: <?= $sm1; ?>
    }]
  }]
});
});
</script>


<?php }else if($ch_type == 4){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="MultiSmiley<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>


<script>
    $(function() {
  var multiChart = new Highcharts.chart( {
  chart: {
    renderTo: 'MultiSmiley<?= $Qcount; ?>',
    type: 'column'
  },
  title: {
    text: ''
  },
  subtitle: {
    text: 'Click on a column to view distribution'
  },
  xAxis: {
    type: 'category'
  },
  yAxis: {
    title: {
      text: 'Average Rating'
    }

  },
  legend: {
    enabled: false
  },
  plotOptions: {
    series: {
      borderWidth: 0,
      dataLabels: {
        enabled: true,
        format: '{point.y:.1f}'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  "series": [
    {
      "name": "Browsers",
      "colorByPoint": true,
      "data": [
        <?php
    $multiStar = array();
    $multi_s_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 4 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             $multiStar[] = array();
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_s_name[$count] = $check[$count]['option'];
             if($d == 0){
                 $multi_star[$count] = 0;
             }
             if($check[$count]['value']){
                 $multiStar[$d][$count] = $check[$count]['value'];
              }
             endforeach;
            
         }
          
     endforeach;
     
     endforeach; 
     
     
         //   $value_total = array();
     foreach ($multiStar[0] as $count=> $nn):
         //$responses = sizeof($tableView);
         //echo $count;
            $temp = 0;
         foreach ($multiStar as $rCount=> $rn):

           $temp += $multiStar[$rCount][$count];
         endforeach;
          // $value_total[] = $temp;
         //echo $value_total[$count]."<br>";
           echo '{ "name":"'.$multi_s_name[$count].'", "y":'. $temp/sizeof($tableView) .', "drilldown": "' . $multi_s_name[$count]. '","count":' . $temp .'},';
      endforeach;
           
     ?>
      ]
    }
  ],
  "drilldown": {
    "series": [
//      {
//        "name": "Chrome",
//        "id": "Chrome",
//        "data": [
//          [
//            "v65.0",
//            0.1
//          ],
//          [
//            "v64.0",
//            1.3
//          ],
//          [
//            "v63.0",
//            53.02
//          ],
//          [
//            "v62.0",
//            1.4
//          ],
//        ]
//      },
      
      <?php
    $multiStar = array();
    $multi_s_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 4 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             $multiStar[$d]=array();
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_s_name[$count] = $check[$count]['option'];
             if($d == 0){
                 $multi_star[$count] = 0;
             }
             if($check[$count]['value']){
                 $multiStar[$d][$count] = $check[$count]['value'];
              }
             endforeach;
             
         }
          
     endforeach;
     
     endforeach; 
     
        //   $value_total = array();
     foreach ($multiStar[0] as $count=> $nn):
         //$responses = sizeof($tableView);
         //echo $count;
            $temp = array();
            
            $temp[1] = array('1/5',0); $temp[2] = array('2/5',0); $temp[3] = array('3/5',0); $temp[4] = array('4/5',0); $temp[5] = array('5/5',0);
         foreach ($multiStar as $rCount=> $rn):

           $temp[$multiStar[$rCount][$count]][1] = (int)$multiStar[$rCount][$count];
         endforeach;
         //echo json_encode($temp[1]);
          // echo '{ "name":"'.$multi_s_name[$count].'", "y":'. $temp/sizeof($tableView) .', "drilldown": "' . $multi_s_name[$count]. '","count":' . $temp .'},';
         echo '{ "name":"'.$multi_s_name[$count].'", "id":"'. $multi_s_name[$count] .'","data": [' . json_encode($temp[1]) . ' , '. json_encode($temp[2]) .','. json_encode($temp[3]).','. json_encode($temp[4]) .','.json_encode($temp[5]).'], },';
      endforeach;
             
     ?>
      
      
    ]
  }
});
});
</script>
<?php }else if($ch_type == 6){ ?>



<?php
    $nps_total = 0;
    $promoters = 0; $passives = 0; $detractors = 0; 
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
      $promo1=0; $passi1=0; $detrac1=0;
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 6 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             
             if($star_json['response'][$star_answer]['value'] <= 6){
                 $detrac1 += 1;
             }else if($star_json['response'][$star_answer]['value'] >= 7 && $star_json['response'][$star_answer]['value'] <= 8){
                 $passi1 += 1;
             }else if($star_json['response'][$star_answer]['value'] >= 9 && $star_json['response'][$star_answer]['value'] <= 10){
                 $promo1 += 1;
             }
         }
          
     endforeach;
     $promoters += $promo1;
      $passives += $passi1;
      $detractors += $detrac1;
           
      $nps_total += $promo1 + $passi1 + $detrac1;
             
     endforeach; 
     // $nps_total;
     
     $nps_avg = (($promoters/$nps_total)*100)-(($detractors/$nps_total)*100);
      ?>    


<div data-v-0775d61a="" class="col-lg-6">
                    <div data-v-0775d61a="" class="card">
                        <div data-v-0775d61a="" class="card-heading border bottom">
                            <?= $json_question['question'][$Qcount]['text']['en']; ?>
                        </div> 
                        <div data-v-0775d61a="" class="card-body question-chart-body">
                            <div >
                                <div data-v-0775d61a="" class="card-body question-chart-body"><!----> 
                                    <div data-v-604447e5="" data-v-0775d61a="">
                                        <div data-v-bd07a6a0="" data-v-604447e5="" class="nps-container" style="height: 500px;">
                                            <div data-v-bd07a6a0="" class="row">
                                                <div data-v-bd07a6a0="" class="col-sm-7">
                                                    <div data-v-bd07a6a0="" class="nps-group">
                                                        <div data-v-bd07a6a0="" class="value green"><?= $promoters; ?></div> 
                                                        <div data-v-bd07a6a0="" class="name">Promoters</div>
                                                    </div> 
                                                    <div data-v-bd07a6a0="" class="nps-group">
                                                        <div data-v-bd07a6a0="" class="value yellow"><?= $passives; ?></div> 
                                                        <div data-v-bd07a6a0="" class="name">Passives</div>
                                                    </div> 
                                                    <div data-v-bd07a6a0="" class="nps-group">
                                                        <div data-v-bd07a6a0="" class="value red"><?= $detractors; ?></div> 
                                                        <div data-v-bd07a6a0="" class="name">Detractors</div>
                                                    </div>
                                                </div> 
                                                <div data-v-bd07a6a0="" class="col-sm-5">
                                                    <div data-v-bd07a6a0="" class="nps-score"><?= round($nps_avg, 0); ?><span data-v-bd07a6a0="">NPS Score</span></div>
                                                </div>
                                            </div> 
                                            <div data-v-bd07a6a0="" class="trademark hidden-xs">
                                                <small data-v-bd07a6a0="">Net Promoter® and NPS® are registered trademarks and Net Promoter Score and Net Promoter System are trademarks of Bain &amp; Company, Satmetrix Systems and Fred Reichheld.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



<?php }else if($ch_type == 7){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="multiChoice<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>

<script>
   $(function() {
  var pieChart = new Highcharts.chart( {
  chart: {
    renderTo: 'multiChoice<?= $Qcount; ?>', 
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [ <?php
    $multi_choice=array();
    $multi_c_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 7 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_c_name[$count] = $check[$count]['name'];
             if($d == 0){
                 $multi_choice[$count] = 0;
             }
             if($check[$count]['selected'] == "true"){
                
                 $multi_choice[$count] = $multi_choice[$count]+1;
              }
             endforeach;
         }
          
     endforeach;
     endforeach; 
     foreach ($multi_choice as $count=> $nn):
         echo '{ "name":"'.$multi_c_name[$count].'", "y":'. ($multi_choice[$count]/sizeof($tableView))*100 .',"count":' . $multi_choice[$count] .'},';
     endforeach;
     
     ?> ]
  }]
});
});
</script>



<?php }else if($ch_type == 8){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="multiChoiceMoreAns<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
 $(function () {
     
    var singleHorichart = new Highcharts.Chart({
        chart: {
            renderTo: 'multiChoiceMoreAns<?= $Qcount; ?>',
            type: 'bar'
        },
        title: {
            text: ""
        },
                
         xAxis: {  
             categories: [<?php foreach ($json_question['question'][$Qcount]['options']['en'] as $option => $on): 
                 echo '"'.$json_question['question'][$Qcount]['options']['en'][$option].'",'; endforeach; ?>]
            },
       
//       series: [{
//            data: [2, 3, 1, 4]        
//        }]
    
    tooltip: {
            //headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<br> <b>{point.y:.2f}%</b><br> {point.count} of <?= sizeof($tableView); ?> respondents'
        },
       series: [{
               "name":"% of respondents",
            data: [
                    
    <?php
    $multi_choice=array();
    $multi_c_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 8 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_c_name[$count] = $check[$count]['name'];
             if($d == 0){
                 $multi_choice[$count] = 0;
             }
             if($check[$count]['selected'] == "true"){
                
                 $multi_choice[$count] = $multi_choice[$count]+1;
              }
             endforeach;
         }
          
     endforeach;
     endforeach; 
     foreach ($multi_choice as $count=> $nn):
         echo '{ "name":"'.$multi_c_name[$count].'", "y":'. ($multi_choice[$count]/sizeof($tableView))*100 .',"count":' . $multi_choice[$count] .'},';
     endforeach;
     
     ?> 
                  
                    ]        
        }]
    });
    
});
</script>




<?php }else if($ch_type == 9){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="longChart<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>

<script>
   $(function() {
  var pieChart = new Highcharts.chart( {
  chart: {
    renderTo: 'longChart<?= $Qcount; ?>', 
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [ <?php
    $multi_choice=array();
    $multi_c_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 9 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_c_name[$count] = $check[$count]['name'];
             if($d == 0){
                 $multi_choice[$count] = 0;
             }
             if($check[$count]['selected'] == "true"){
                
                 $multi_choice[$count] = $multi_choice[$count]+1;
              }
             endforeach;
         }
          
     endforeach;
     endforeach; 
     foreach ($multi_choice as $count=> $nn):
         echo '{ "name":"'.$multi_c_name[$count].'", "y":'. ($multi_choice[$count]/sizeof($tableView))*100 .',"count":' . $multi_choice[$count] .'},';
     endforeach;
     
     ?> ]
  }]
});
});
</script>




<?php }else if($ch_type == 10){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="longMultiChart<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
 $(function () {
     
    var singleHorichart = new Highcharts.Chart({
        chart: {
            renderTo: 'longMultiChart<?= $Qcount; ?>',
            type: 'bar'
        },
        title: {
            text: ""
        },
                
         xAxis: {  
             categories: [<?php foreach ($json_question['question'][$Qcount]['options']['en'] as $option => $on): 
                 echo '"'.$json_question['question'][$Qcount]['options']['en'][$option].'",'; endforeach; ?>]
            },
       
//       series: [{
//            data: [2, 3, 1, 4]        
//        }]
    
    tooltip: {
            //headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<br> <b>{point.y:.2f}%</b><br> {point.count} of <?= sizeof($tableView); ?> respondents'
        },
       series: [{
               "name":"% of respondents",
            data: [
                    <?php
    $multi_choice=array();
    $multi_c_name= array();
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 10 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
             if($d == 0)
                $multi_c_name[$count] = $check[$count]['name'];
             if($d == 0){
                 $multi_choice[$count] = 0;
             }
             if($check[$count]['selected'] == "true"){

                 $multi_choice[$count] = $multi_choice[$count]+1;
              }
             endforeach;
         }

     endforeach;
     endforeach; 
     foreach ($multi_choice as $count=> $nn):
         echo '{ "name":"'.$multi_c_name[$count].'", "y":'. ($multi_choice[$count]/sizeof($tableView))*100 .',"count":' . $multi_choice[$count] .'},';
     endforeach;

     ?> 
                  
                    ]        
        }]
    });
    
});
</script>


<?php }else if($ch_type == 11){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="polar<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>
<?php
    $polar_total = 0;
    $polar_yes = 0; $polay_no = 0; 
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
      $yes=0; $no=0; 
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 11 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             
             if($star_json['response'][$star_answer]['value'] == 'yes'){
                 $yes += 1;
             }else if($star_json['response'][$star_answer]['value'] == 'no'){
                 $no += 1;
             }
         }
     endforeach;
      $polar_yes += $yes;
      $polay_no += $no;
     
      $polar_total += $yes + $no ; 
             
     endforeach; 
     $yes_avg = ($polar_yes/$polar_total)/100;
     $no_avg = ($polay_no/$polar_total)/100;
      ?> 
<script>
   $(function() {
  var pieChart = new Highcharts.chart( {
  chart: {
    renderTo: 'polar<?= $Qcount; ?>', 
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  tooltip: {
    pointFormat: '<b>{point.percentage:.1f}%</b> <br> {point.count} of <?= $polar_total; ?> respondents'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Polar',
    colorByPoint: true,
    data: [{
      name: 'YES',
      y: <?= $yes_avg; ?>,
      count: <?= $polar_yes; ?>,
      sliced: true,
      selected: true
    }, {
      name: 'NO',
      y: <?= $no_avg; ?>,
      count: <?= $polay_no; ?>
    } ]
  }]
});
});
</script>


<?php }else if($ch_type == 12){ ?>
      <div data-v-0775d61a="" class="col-lg-6">
                <div data-v-0775d61a="" class="card">
                    <div data-v-0775d61a="" class="card-heading border bottom">
                        <?= $json_question['question'][$Qcount]['text']['en']; ?>
                    </div> 
                    <div data-v-0775d61a="" class="card-body question-chart-body">
                        <div id="horizontalBar<?= $Qcount; ?>" ></div>
                    </div>
                </div>
            </div>


<script>
    $(function() {
  var horizontalChart = new Highcharts.chart( {
  chart: {
    renderTo: 'horizontalBar<?= $Qcount; ?>', 
    type: 'bar'
  },
  title: {
    text: ''
  },
  tooltip: {
    //headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<b> {point.percentage:.1f}% {series.name}</b> <br> {data.point} of <?= sizeof($tableView); ?> respondents'
  },
  xAxis: {
    categories: [<?php foreach ($json_question['question'][$Qcount]['options']['en']['matrix_row'] as $option => $on): 
                 echo '"'.$json_question['question'][$Qcount]['options']['en']['matrix_row'][$option].'",'; endforeach; ?>]
  },
  yAxis: {
    min: 0,
    title: {
      text: '% of responses'
    }
  },
  legend: {
    reversed: true
  },
  plotOptions: {
    series: {
      stacking: 'normal'
    }
  },
  series: [
       
       <?php
    $multi_choice = array();
    $multi_c_name= array();
    
    foreach ($tableView as $d=> $n):
     $json_star = $n->answer_json;
     $star_json = json_decode($json_star, true);
     $multi_choice[$d] = array();
     foreach ($star_json['response'] as $star_answer =>$an):
         if($star_json['response'][$star_answer]['type'] == 12 && $json_question['question'][$Qcount]['sequence_no'] == $star_answer+1){
             $count_total = 0;
             foreach ($star_json['response'][$star_answer]['value'] as $count =>$value):
                 $check = $star_json['response'][$star_answer]['value'];
                  $multi_choice[$d][$count]= array();
                 foreach ($check[$count]['buttons'] as $b_count=> $b_value):
                    if ($d == 0)
                        $multi_c_name[$b_count] = $check[$count]['buttons'][$b_count]['name'];

                        $multi_choice[$d][$count][$b_count] = 0;
                    
                    if ($check[$count]['buttons'][$b_count]['selected'] == "true") {

                        $multi_choice[$d][$count][$b_count] += 1;
                    }
                endforeach;
             
             endforeach;
         }

     endforeach;
     endforeach;
     
        $temp=array();
     foreach ($multi_choice[0] as $mRow=> $mn):
      $temp[$mRow]=array();
         foreach ($multi_choice[0][0] as $mbutton=> $mbn):
              
         $total = 0;
             foreach ($multi_choice as $responses => $n):
                $total += $multi_choice[$responses][$mRow][$mbutton];
             endforeach;
             $temp[$mRow][] = $total;
  
         endforeach;
         
     endforeach;
     foreach ($multi_choice[0][0] as $button=>$mbn):
         $button_value= array();
        foreach ($multi_choice[0] as $row=> $rown ):
            $value[] = $temp[$row][$button];
            $button_value[] = round(($temp[$row][$button]/(sizeof($tableView))*100),2);
         endforeach;
         echo '{ "name":"'.$multi_c_name[$button].'", "data":['. implode(", ", $button_value) .'] },';
     endforeach;
                
     
     ?> 
//    {
//    name: 'John',
//    data: [5, 3, 4, 7, 2, 1]
//  },
    ]
});
});
</script>

<?php }else{}
    } //survey form ki jo json h usme se sequence wise loop chalne k bad if ke ander if condtion check hoga pr master if ka end point
    endforeach;
      ?>

  <?php } //this if contion then open all graphs
  else {
      echo '<h5><i class="fa fa-exclamation-triangle"></i> No matching responses found for this survey in the selected date range / filters.</h5>';
}?>      

 
<script>
    $("#charts").addClass('active');
    $("#inline").addClass('active');
</script>