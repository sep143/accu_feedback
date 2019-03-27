<section class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Notifications</h3>
                </div>

                <div class="box-body">
                    <div>
                        <a href="<?= site_url('admin/Notifications_C/trigger'); ?>"><label class="btn btn-default" id="chg_psw"><i class="fa fa-cog"></i>  Configure Notifications</label></a>
                    </div><br>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <th>Time</th>
                        <th>Device</th>
                        <th>Device Time</th>
                        <th>Survey</th>
                        <th>Score</th>
                        <th>Trigger Name</th>
                        <th></th>
                        </thead>
                        <tbody>

                            
                                <?php 
                                    foreach ($notification as $row=>$n): ?>
                            <tr>
                                <td><?= date('d-M-Y', strtotime($n->device_time)); ?>, <?= date('H:i A', strtotime($n->device_time)); ?></td>
                                <td><?= $n->device; ?></td>
                                <td><?= date('d-M-Y', strtotime($n->device_time));?>, <?= date('H:i A', strtotime($n->device_time)); ?></td>
                                <td><?= $n->survey_name; ?></td>
           <!--Score Generate--><td>
                                     <?php
                                      
                                        $json_view = $n->responses;
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
                              echo $score = round($score_cal, 2);
                                   ?>
                                </td>
                                <td><?= $n->trigger_name; ?></td>
                                <td>
                                    <?php echo form_open(base_url('admin/Notifications_C/view_responses/'), 'class=""'); ?> 
                                    <input type="hidden" name="notification_id" value="<?= $n->t_id; ?>">
                                    <input type="hidden" name="n_survey_id" value="<?= $n->survey_id; ?>">
                                    <button type="submit" style="padding: 2px;" class="btn btn-default btn-xs">View Response
<!--                                        <a href="<?= site_url('admin/Notifications_C/view_responses/'.$n->t_id); ?>">View Response</a>-->
                                    </button>
                                     <?php echo form_close(); ?>
                                </td>
                             </tr>
                                <?php endforeach; ?>
                                
                           


                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    $("#notifications_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  