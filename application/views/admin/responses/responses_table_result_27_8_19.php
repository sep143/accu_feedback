<!--Survey form select krne ke bad result me Table ke rup me data ko leke ayega-->

<!-- DataTables -->

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">



<style>

    table.dataTable thead tr th,

    table.dataTable tbody tr td {

    white-space: nowrap;

}

table.dataTable thead tr th,

table.dataTable tbody tr td {

    word-wrap: break-word;

    word-break: break-all;

    min-width: 120px;

}



.dataTables_scroll

{

    overflow:auto;

}

</style>

<?php 

        if($tableView){ ?>

<div class="box">

    <div class="box-body">

        <table id="surveyResponses" class="table table-hover table-responsive responses-table no-footer" style="border: 1px solid #e0e0e0;">

            <thead style="background-color: #eff0f4;">

                      <tr >

                          <th>S.No.</th>

                          <th>Device</th>

                          <th>Synced At</th>

                          <th>Device Time</th>

                          <?php

                    $id = $this->session->userdata('admin_id');

                    $json1 = $question->options;

                    $json_data = json_decode($json1, true);

                    $i = 1;

                    $q_seq = array();

                    foreach ($json_data['question'] as $Qcount=> $Qrow):

                        //if ($ques->restaurant_id == $id) {

                        array_push($q_seq, $json_data['question'][$Qcount]['sequence_no']);

                            ?>

                          <th id="popover" data-content="<?= $json_data['question'][$Qcount]['text']['en']; ?>" title="<?php

                            foreach ($type as $tc=> $tr):

                                if($json_data['question'][$Qcount]['type']==$tr->t_id){

                                    echo $tr->type_options;

                                }

                            endforeach;

                           ?>" style="width: 150px;">Q <?= $i; ?>

                          </th>

                     <?php

                        //}

                        $i++;

                    endforeach;

                    ?>
                      <?php 
                      $total_question = $i;
                      
                      ?>
                          <th>Score</th>   

                      </tr>

            </thead>

            <tbody>

                    <?php



            $i = 1;

            foreach ($tableView as $t_view => $t_row):

                $json_view = $t_row->answer_json;

                $json_table = json_decode($json_view, true);

                $r_seq = array();

//                foreach ($json_table['response'] as $j_count=>$j_view):

//                    array_push($r_seq, $json_table['response'][$j_count]['sequence_no']);

//                endforeach;

                $check_seq = array_intersect($r_seq, $q_seq);

                ?>

                <tr >

                    <td><?= $i; ?></td>

                    <td><?= $t_row->device_info ?></td>

                    <td><?= date('Y-m-d', strtotime($t_row->answer_date)); ?></td>

                    <td><?= date('h:i A', strtotime($t_row->answer_date)); ?></td>

                        

                <?php 

                $q_id=0;

                $star=0; $smiley=0; $nps=0; $mstar=0;

                $star_total=0; $smiley_total=0; $nps_total=0; $mstar_total=0;

//                $r_seq = array();

//                foreach ($check_seq as $r1 => $v1) :

//                    foreach ($json_table['response'][$r1] as $r => $v) :

////                echo $r.' yes<br>';    

//                        if ($v == $r_seq[$r1]) {

//                            echo 'value-' . $json_table['response'][$r1]['type'] . '-Seq-' . $json_table['response'][$r1]['sequence_no'] . '-' . $v . ' yes<br>';

//                        }

//                    endforeach; //response loop end

//                endforeach; //response loop end

                

                foreach ($json_table['response'] as $j_count=>$j_view):

//                    if($q_seq[$j_count] == $json_table['response'][$j_count]['sequence_no']){

                    if(in_array($json_table['response'][$j_count]['sequence_no'], $q_seq)){

                ?>

                   <td>

                    <?php 

                 $check = $json_table['response'][$j_count]['type'];

                if($check == 1 ){

                    $star = $json_table['response'][$j_count]['value'];

                    $star_total = 5;

                    echo "<i class='fa fa-star'></i> ".$json_table['response'][$j_count]['value']."/5<br>";

                }else if($check == 2){

                    $mstar_total = 0;

                    $mstar = 0;

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                        echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['option'].": ";

                        echo "<i class='fa fa-star'></i> ".$json_table['response'][$j_count]['value'][$count]['value']."/5<br>";

                        $mstar += $json_table['response'][$j_count]['value'][$count]['value'];

                        if($json_table['response'][$j_count]['value'][$count]['value']){

                            $mstar_total += 5;

                        }

                        //echo $mstar;

                    endforeach;   //                 print_r($mstar);

                }else if($check == 3){

                    $smiley_total = 5;

                    $smiley = $json_table['response'][$j_count]['value'];

                    echo "<i class='fa fa-smile-o'></i> ".$json_table['response'][$j_count]['value']."/5<br>";

                }else if($check == 4){

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                        echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['option'].": ";

                        echo "<i class='fa fa-smile-o'></i> ".$json_table['response'][$j_count]['value'][$count]['value']."/5<br>";

                    endforeach;

                }

               else if($check == 5){

                foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                    //echo $json_table['response'][$j_count]['value'][$count]['type']."-";

                    echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name'].": ";
                    if($json_table['response'][$j_count]['value'][$count]['value']!=1) {
                    echo "<b>".$json_table['response'][$j_count]['value'][$count]['value']."</b><br>";
                    }else {
                      echo "<b>Yes</b><br>";
                    }

               endforeach; 

               }else if($check == 6){

                   $nps_total = 10;

                   $nps = $json_table['response'][$j_count]['value'];

                   echo $json_table['response'][$j_count]['value'];

               }else if($check == 7){

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){

                           echo $json_table['response'][$j_count]['value'][$count]['name'];

                       }else{

                           

                       }

                    endforeach;

               }else if($check == 8){

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){

                           echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name']."<br>";

                       }else{

                           

                       }

                    endforeach;

               }else if($check == 9){

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){

                           echo $json_table['response'][$j_count]['value'][$count]['name'];

                       }else{

                           

                       }

                    endforeach;

               }else if($check == 10){

                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){

                           echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name']."<br>";

                       }else{

                           

                       }

                    endforeach;

               }else if($check == 11){

                   echo $json_table['response'][$j_count]['value'];

                   

               }else if($check == 12){

                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):

                       echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name'].":- ";

                       foreach ($json_table['response'][$j_count]['value'][$count]['buttons'] as $n=>$mn):

                            if($json_table['response'][$j_count]['value'][$count]['buttons'][$n]['selected'] == 'true'){

                             echo "<b>".$json_table['response'][$j_count]['value'][$count]['buttons'][$n]['name']."</b>";

                        }else{ }

                       endforeach;

                       echo '<br>';

                   endforeach;

               }else if($check == 13 || $check == 14 || $check == 15){

                   echo $json_table['response'][$j_count]['value'];

               }else{

                   echo '-';

               }

               

                ?>

                   </td>

                <?php

                 

                $q_id++;

                }

               endforeach; 

              //question wise responses view

               

              $obtain = ((int)$star + (int)$smiley + (int)$nps + (int)$mstar);



               $total = $star_total + $smiley_total + $nps_total + $mstar_total; 

               if($total){

                   $score_cal = (($obtain/$total)*10)/2;

                   $score = round($score_cal, 2);

               }else{

                   $score = 0.00;

               }

                for($j=sizeof($json_table['response']);$j<=($total_question-1);$j++) {
                      
                  if($j == $total_question-1) {   

               ?>

                  
                <?php 

                     } else {// end if 

                    echo "<td></td>";
                  }
                }

                ?>   

                     <td>

                         <b><?= $score; ?></b>

                     </td>

                    </tr>

                   

                <?php

                $i++;

            endforeach;

           

            ?>

                

            </tbody>

        </table>

       

    </div>

   <?php

//   $vv = "Hello dear this value only check";

//   echo str_word_count($vv).'<br>';

//   echo str_replace("dear", "oo", $vv).'<br>';

//   echo strchr($vv, 'dea').'<br>';

//   if(strpos($vv, "this") !== FALSE)

//       echo 'true';

//   else

//       echo 'No way';

   ?>

</div>

       

<!--DataTables--> 

<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>



<script>

$("th[id=popover]").popover({

    placement:"top",

    trigger:"hover"

});

</script>



<script>

    $(document).ready(function(){

// Set up your table

    $('#surveyResponses').DataTable({

        "paging": true,

        "info": true,

        "scrollX" : true,

       // "popover": true,

       // "lengthChange": true,

        "searching" : true,

         //"ordering": true,

        // "overflow": false,

        //width: 100px,

        "processing": true,

        "lengthMenu": [

                    [10, 25, 50, -1],

                    [10, 25, 50, "All"]

                ],

    });

});

</script>



<script>

    $('.dataTables_scrollHead').css('position','inherit'); //position: inherit;

    $("#tables").addClass('active');

    $("#data-tables").addClass('active');

</script>



 <?php } //starting condtion check then run table 

        else {

            echo '<div class="alert" style="background-color:#fcf8e3; color:#8a6d3b;"><h5><i class="fa fa-exclamation-triangle"></i> No matching responses found for this survey in the selected date range / filters.</h5></div>';

        }?>