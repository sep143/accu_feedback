<!--Survey form select krne ke bad result me Table ke rup me data ko leke ayega-->
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
<style>
    table.dataTable thead th,
    table.dataTable tbody td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    min-width: 120px;
}
</style>
<div class="box">
    <div class="box-body ">
        
        <?php 
       
        if($tableView){ ?>
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
                    foreach ($json_data['question'] as $Qcount=> $Qrow):
                        //if ($ques->restaurant_id == $id) {
                            ?>
                          <th id="popover" data-content="<?= $json_data['question'][$Qcount]['text']['en']; ?>" title="System Information" style="width: 150px;">Q <?= $i; ?>
                          <!--<th id="popover" data-content="<?= $json_data['question'][$Qcount]['text']['en']; ?>" title="System Information" style="width: 150px;">--> 
                                <!--a id="popoverData" class="btn" href="#" data-content="Popover with data-trigger" rel="popover" data-placement="top" data-original-title="Title" data-trigger="hover"></a-->
                                <!--<a style="/* overflow: hidden; */" href="#" title="pop display text" content="<?= $json_data['question'][$Qcount]['text']['en']; ?>">Q <?= $i; ?></a>-->
                          </th>
                     <?php
                        //}
                        $i++;
                    endforeach;
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
                //print_r($json_table);
                ?>
                <tr >
                    <td><?= $i; ?></td>
                    <td><?= $t_row->device_info ?></td>
                    <td><?= date('Y-m-d', strtotime($t_row->answer_date)); ?></td>
                    <td>Date formate</td>
                        
                <?php 
                $q_id=0;
                 $star=0; $smiley=0; $nps=0; $mstar=0;
                $star_total=0; $smiley_total=0; $nps_total=0; $mstar_total=0;
                foreach ($json_table['response'] as $j_count=>$j_view):
                    
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
                        echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['option'].": ";
                        echo "<i class='fa fa-star'></i> ".$json_table['response'][$q_id]['value'][$count]['value']."/5<br>";
                        $mstar += $json_table['response'][$q_id]['value'][$count]['value'];
                        if($json_table['response'][$q_id]['value'][$count]['value']){
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
                        echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['option'].": ";
                        echo "<i class='fa fa-smile-o'></i> ".$json_table['response'][$q_id]['value'][$count]['value']."/5<br>";
                    endforeach;
                }
               else if($check == 5){
                foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                    //echo $json_table['response'][$q_id]['value'][$count]['type']."-";
                    echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['name'].": ";
                    echo "<b>".$json_table['response'][$q_id]['value'][$count]['value']."</b><br>";
               endforeach; }
               else if($check == 6){
                   $nps_total = 10;
                   $nps = $json_table['response'][$q_id]['value'];
                   echo $json_table['response'][$q_id]['value'];
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
                           echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name']."<br>";
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
                           echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name']."<br>";
                       }else{
                           
                       }
               endforeach;
               }else if($check == 11){
                   echo $json_table['response'][$j_count]['value'];
                   
               }else if($check == 12){
                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       echo "<i style='font-size:8px;' class='fa fa-circle'></i> ".$json_table['response'][$j_count]['value'][$count]['name'].":- ";
                       foreach ($json_table['response'][$j_count]['value'][$count]['buttons'] as $n=>$mn):
                            if($json_table['response'][$j_count]['value'][$count]['buttons'][$n]['selected'] == 'true'){
                             echo "<b>".$json_table['response'][$j_count]['value'][$count]['buttons'][$n]['name']."</b>";
                        }else{ }
                       endforeach;
                       echo '<br>';
                   endforeach;
               }else if($check == 13 || $check == 14 || $check == 15){
                   echo $json_table['response'][$j_count]['value'];
               }
               
                        ?>
                   </td>
                <?php
                 
                $q_id++;
               endforeach; 
               
              $obtain = ((int)$star + (int)$smiley + (int)$nps + (int)$mstar);

               $total = $star_total + $smiley_total + $nps_total + $mstar_total; 

               $score_cal = (($obtain/$total)*10)/2;
               $score = round($score_cal, 2);
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
        <?php } //starting condtion check then run table 
        else {
            echo '<h5><i class="fa fa-exclamation-triangle"></i> No matching responses found for this survey in the selected date range / filters.</h5>';
        }?>
    </div>
    
</div>
       
<!--DataTables--> 
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
 $("th[id=popover]").popover({placement:"top",trigger:"hover"});
//  $(document).ready(function(){
//    $('[data-toggle="tooltip"]').tooltip();   
//});

//$(document).ready(function(){
//    $('.btn-warning').popover({title: "Header", content: "Blabla", trigger: "hover" , placement: "top"}); 
//});

//$(".table-th a").popover({ 
//    trigger: 'hover',
//    placement: function(pop,ele){
//        if($(ele).parent().is('th:last-child')){
//        return 'top'
//        }else{
//        return 'top'
//        }
//    }
//    });

</script>

<?php //datatable(); ?>
<script>
    // Bootstrap datepicker
    $('.input-daterange input').each(function () {
        $(this).datepicker('now');
    });

// Set up your table
    table = $('#surveyResponses').DataTable({
        paging: true,
        info: true,
        scrollX : true,
       // "popover": true,
       // "lengthChange": true,
        searching : true
         //"ordering": true,
        // "overflow": false,
       // "autoWidth": true
    });

// Extend dataTables search
    $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                //var startDate = format('d-m-yyyy');
                //var endDate = format('d-m-yyyy');
                var min = $('#datepicker').val();
                var max = $('#endDatePicker').val();
                var createdAt = data[2] || 0; // Our date column in the table

                if (
                    (min == "" || max == "") ||
                    (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                   ) {
                    return true;
                }
                return false;
            }
    );

// Re-draw the table when the a date range filter changes
    $('.date-range-filter').change(function () {
        table.draw();
        
    });
    
    //$('#surveyResponses_filter').hide();
</script>

<script>
    $("#tables").addClass('active');
    $("#data-tables").addClass('active');
</script>