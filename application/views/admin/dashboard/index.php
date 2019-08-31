<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->

<script src="https://code.highcharts.com/highcharts.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script src="https://code.highcharts.com/modules/data.js"></script>

<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<!--Stylesheet make a self-->

<link rel="stylesheet" href="<?= base_url() ?>public/common_styleSheet.css">

<script src="<?= base_url(); ?>public/card-depth.js"></script>

<!--

 iCheck 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/iCheck/flat/blue.css">

 Morris chart 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/morris/morris.css">

 jvectormap 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

 Date Picker 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">

 Daterange picker 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.css">

 bootstrap wysihtml5 - text editor 

<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->

<?php

$check_date = $this->session->userdata('expired_date');

//$duration_check = $this->session->userdata('duration');

$current = (new DateTime())->format('Y-m-d');

//echo "<script>alert('check);</script>".$now_date = date('Y-m-d', strtotime($j_date.'+15 days'));



?>

<section class="content">

    <?php //start Condition if duration condition check successfully then open otherwise off 

        if($current <= $check_date){ 

    ?>

      <!-- Small boxes (Stat box) -->

      <div class="row">

        <div class="col-lg-3 col-xs-6">

            <!-- small box -->

          <div class="small-box bg-teal card">

            <div class="inner">

                <?php

                

                    $i=0;

                    $admin_id = ucwords($this->session->userdata('admin_id'));

                    //echo $admin_id;

                    foreach ($all_users as $row){

                        if($row['restaurant_id'] == $admin_id){

                            $row['restaurant_id'] =+$i;

                        $i++; 

                        ?>

                   

                  <?php  }  }

                ?>

               <h3><?= $i; ?></h3>



              <p>User Registrations</p>

            </div>

            <div class="icon">

              <i class="ion ion-person-add"></i>

            </div>

            <a href="<?= base_url('admin/MyAccount_C'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

       <!-- ./col -->



        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-teal card">

            <div class="inner">

              <?php

              //Feedback Form count

                $count = 0;

                foreach ($list as $row):

                    //$show=$count+$row;

                    $count++;

                endforeach;

                ?> 

                <h3><?= $count; ?></h3>



              <p>Feedback Form</p>

            </div>

            <div class="icon">

              <i class="fa fa-file-text-o"></i>

            </div>

              <a href="<?= site_url('admin/Survey_C')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-teal card">

            <div class="inner">

              <?php

                $count1 = 0;

                foreach ($branding as $row):

                    //$show=$count+$row;

                    $count1++;

                endforeach;

                ?>   

              <h3><?= $count1; ?></h3>



              <p>Branding Design</p>

            </div>

            <div class="icon">

              <i class="fa fa-windows"></i>

            </div>

              <a href="<?= site_url('admin/Branding_C/show'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <!-- small box -->

          <div class="small-box bg-teal card">

            <div class="inner">

                 <?php

                $res1 = 0;

                foreach ($responses as $row):

                    //$show=$count+$row;

                    $res1++;

                endforeach;

                ?> 

              <h3><?= $res1; ?></h3>



              <p>All Responses</p>

            </div>

            <div class="icon">

              <i class="ion ion-pie-graph"></i>

            </div>

              <a href="<?= site_url('admin/responses_C'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

          </div>

        </div>

        <!-- ./col -->

      </div>

      <!-- /.row -->

      

      <div data-v-1285ad7d="" class="row">

          <div data-v-1285ad7d="" class="col-sm-7 col-md-5">

              <div data-v-1285ad7d="" class="card match-heights" style="min-height: 195.8px;">

                  <?php

                  $now = new DateTime();

                  $date = new DateTime();

                  $date->modify('-1 week');

                  $week = $date->format('Y-m-d');

                  

                  $month = new DateTime();

                  $month->modify('-30 days');

                  $oneMonth = $month->format('Y-m-d');

                    $oneWeek = 0;

                    $oneMon=0;

                        foreach ($responses as $r_count => $r_data):

                            $res_date = date('Y-m-d', strtotime($r_data->answer_date));

                            if($res_date >= $week){

                                $oneWeek +=1;

                            }

                            if($res_date >= $oneMonth){

                                

                                $oneMon +=1;

                            }

                        endforeach;

                        $activeSurvey = 0;

                        //echo $activeSurvey1;

                        foreach ($activeSurvey1 as $row=> $n):

                            $activeSurvey +=1;

                        endforeach;

                         

                  ?>

                  <div data-v-1285ad7d="" class="card-block">

                      <h5 data-v-1285ad7d="" class="card-title title-icon">

                          <a data-v-1285ad7d="" href="<?= site_url('admin/responses_C'); ?>" class="unstyled-link"><i data-v-1285ad7d="" class="ti-check-box" style="font-size: 30px; float: left; margin-right: 10px;"></i> Responses</a>

                      </h5> 

                      <div data-v-1285ad7d="" class="row">

                          <div data-v-1285ad7d="" class="col-sm-4 border right border-hide-sm">

                              <div data-v-1285ad7d="" class="text-center pdd-vertical-10">

                                  <h2 data-v-1285ad7d="" class="font-primary no-mrg-top"><?= $oneWeek; ?></h2> 

                                  <p data-v-1285ad7d="" class="no-mrg-btm">Last 7 Days</p>

                              </div>

                          </div> 

                          <div data-v-1285ad7d="" class="col-sm-4 border right border-hide-sm">

                              <div data-v-1285ad7d="" class="text-center pdd-vertical-10">

                                  <h2 data-v-1285ad7d="" class="font-primary no-mrg-top"><?= $oneMon; ?></h2> 

                                  <p data-v-1285ad7d="" class="no-mrg-btm">Last 30 Days</p>

                              </div>

                          </div> 

                          <div data-v-1285ad7d="" class="col-sm-4 border-hide-md">

                              <div data-v-1285ad7d="" class="text-center pdd-vertical-10">

                                  <h2 data-v-1285ad7d="" class="font-primary no-mrg-top"><?= $activeSurvey; ?></h2> 

                                  <p data-v-1285ad7d="" class="no-mrg-btm">Active Feedback</p>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

          <div data-v-1285ad7d="" class="col-sm-5 col-md-4">

              <div data-v-1285ad7d="" class="card match-heights" style="min-height: 195.8px;">

                  <?php

                  

                  $active_month = new DateTime();

                  $active_month->modify('-30 days');

                  $activeOneMonth = $active_month->format('Y-m-d');

                    $oneActiveMonth=0;

                    $activeDevice = 0;

                        foreach ($devices as $d_count=> $d_data):

                            $get_date = date('Y-m-d', strtotime($d_data->d_update_date));

                            

                        if(($d_data->survey_id != null || $d_data->branding_id != null) && $activeOneMonth <= $get_date){

                       // if($activeOneMonth <= $get_date){

                            $oneActiveMonth +=1;

                        }else{

                            $activeDevice +=1;

                        }



                        endforeach;

                  ?>

                  <div data-v-1285ad7d="" class="card-block">

                      <h5 data-v-1285ad7d="" class="card-title title-icon">

                          <a data-v-1285ad7d="" href="<?= site_url('admin/Devices_C'); ?>" class="unstyled-link">

                              <i data-v-1285ad7d="" class="ti-tablet" style="font-size: 30px; float: left; margin-right: 10px;"></i> Devices</a>

                      </h5> 

                      <div data-v-1285ad7d="" class="row">

                          <div data-v-1285ad7d="" class="col-sm-6 border right border-hide-sm">

                              <div data-v-1285ad7d="" class="text-center pdd-vertical-10">

                                  <h2 data-v-1285ad7d="" class="font-primary no-mrg-top"><?= $oneActiveMonth ;?></h2> <p data-v-1285ad7d="" class="no-mrg-btm">Active</p>

                              </div>

                          </div> 

                          <div data-v-1285ad7d="" class="col-sm-6">

                              <div data-v-1285ad7d="" class="text-center pdd-vertical-10">

                                  <h2 data-v-1285ad7d="" class="font-primary no-mrg-top"><?= $activeDevice; ?></h2> 

                                  <p data-v-1285ad7d="" class="no-mrg-btm">Not Synced</p>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div> 

          <div data-v-1285ad7d="" class="col-md-3 match-heights hidden-sm hidden-xs" >

              <ul data-v-1285ad7d="" class="list-unstyled list-link font-size-16 mrg-top-30 mrg-left-20">

                  <li data-v-1285ad7d=""><a data-v-1285ad7d="" href="<?= site_url('admin/responses_C'); ?>" class=""><i data-v-1285ad7d="" class="ti-check-box pdd-right-10"></i> 

                          <span data-v-1285ad7d="">View Responses</span></a>

                  </li> 

                  <li data-v-1285ad7d=""><a data-v-1285ad7d="" href="<?= site_url('admin/Devices_C'); ?>" class=""><i data-v-1285ad7d="" class="ti-tablet pdd-right-10"></i> 

                          <span data-v-1285ad7d="">Manage Devices</span></a>

                  </li> 

                  <li data-v-1285ad7d=""><a data-v-1285ad7d="" href="/help" class=""><i data-v-1285ad7d="" class="ti-help-alt pdd-right-10"></i> 

                          <span data-v-1285ad7d="">Help &amp; Support</span></a>

                  </li>

              </ul>

          </div>

      </div>





      <!-- Graph row -->

      <div class="row">

          <div class="col-lg-8 col-md-8 card" style="margin-left: 13px;">

              <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

          </div>  

          <div class="col-lg-4 col-md-4 col-xs-12">

              

          </div>

      </div>

    </section>

<!--

   Morris.js charts 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <script src="<?= base_url() ?>public/plugins/morris/morris.min.js"></script>

   Sparkline 

  <script src="<?= base_url() ?>public/plugins/sparkline/jquery.sparkline.min.js"></script>

   jvectormap 

  <script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

  <script src="<?= base_url() ?>public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

   jQuery Knob Chart 

  <script src="<?= base_url() ?>public/plugins/knob/jquery.knob.js"></script>

   daterangepicker 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

  <script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>

   datepicker 

  <script src="<?= base_url() ?>public/plugins/datepicker/bootstrap-datepicker.js"></script>

   Bootstrap WYSIHTML5 

  <script src="<?= base_url() ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

   Slimscroll 

  <script src="<?= base_url() ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>

   FastClick 

  <script src="<?= base_url() ?>public/plugins/fastclick/fastclick.js"></script>

   AdminLTE dashboard demo (This is only for demo purposes) 

  <script src="<?= base_url() ?>public/dist/js/pages/dashboard.js"></script>

   AdminLTE for demo purposes 

  <script src="<?= base_url() ?>public/dist/js/demo.js"></script>



  -->

  <script>

  $(function (){



    var dateChart = new Highcharts.chart({

      chart: {

        renderTo: 'container1',

        zoomType: 'x',

        type: 'spline'

      },

      credits: {

      enabled: false

  },

 

  title: {

    text: 'Daily Responses'

  },

  subtitle: {

    text: ''

  },

  xAxis: {

    type: 'datetime',

    dateTimeLabelFormats: { // don't display the dummy year

      month: '%e. %b',

      year: '%b',

      hour: '%H',

      minute: '%m',

    },

    title: {

      text: ''

    }

  },

  yAxis: {

    title: {

      text: 'No. of responses'

    },

    min: 0

  },

  tooltip: {

    headerFormat: '<b>{series.name}</b><br>',

    pointFormat: '{point.x:%e. %b}, {point.x:%H:%m}, Responses :{point.y:.0f} '

  },



  plotOptions: {

    spline: {

      marker: {

        enabled: true

      }

    }

  },



  //colors: ['#6CF', '#39F', '#06C', '#036', '#000'],



  // Define the data points. All series have a dummy year

  // of 1970/71 in order to be compared on the same x axis. Note

  // that in JavaScript, months start at 0 for January, 1 for February etc.

  series: [

//      {

//    name: "Winter 2014-2015",

//    data: [

//      [Date.UTC(2018,10,25), 0],

//      [Date.UTC(2018, 11,  6), 0.25],

//      [Date.UTC(2018, 11, 20), 1.41],

//      [Date.UTC(2018, 11, 25), 1.64],

//      [Date.UTC(2018, 0,  4), 1.6],

//      [Date.UTC(2018, 0, 17), 2.55],

//      [Date.UTC(2018, 0, 24), 2.62]

//      

//    ]

//  },

  <?php

                    

          $check = false;

        $flag = array();
        


        foreach ($deviceGraph as $count=>$data):

            

            if(in_array($data->device_imei, $flag)){

                 echo '[Date.UTC('. date('Y, m-1, d, H,i,s', strtotime($data->answer_date)).'), '. $data->entries .'], ';   

                 if(sizeof($deviceGraph)-1 == $count){

                     echo '] },';

                 }

            }else{

                if($check){

                    echo '] },';

                }else{

                    $check = true;

                }

                $flag[] = $data->device_imei;

              echo '{ name:"'.$data->device_name.'",'; 

              echo 'data:[';

              echo '[Date.UTC('. date('Y, m-1, d, H,i,s', strtotime($data->answer_date)).'), '. $data->entries .'], ';

              if(sizeof($deviceGraph) == 1){

                  echo '] },';

              } else if(sizeof($deviceGraph)-1 == $count){

                   echo '] },';

               }

            }



        endforeach;

  ?>

  

            ]

});

    });

  



</script>





<script>

$("#dashboard1").addClass('active');

</script>  



<?php //End Condition if duration condition check successfully then open otherwise off 

} else {

    ?>

    

    <div class="row">

        <div class="col-lg-3">&nbsp;</div>

        <div class="col-lg-6 col-xs-12">

           &nbsp;<br>&nbsp;<br> <div class="">

            <!-- small box -->

          <div class="small-box bg-teal card">

            <div class="inner">

                <h1><b>Please Update Your Account</b></h1>

               &nbsp;<br>

              <p>Dear Sir/Madam,<br>Your account activate if payment now.</p>

            </div>&nbsp;<br><br>

            

            <a href="<?= base_url('admin/payment/upgrade'); ?>" class="small-box-footer">Update <i class="fa fa-arrow-circle-right"></i></a>

          </div>

            </div>

        </div>

       <div class="col-lg-3">&nbsp;</div>

      </div>

<div class="row" align="center">

    <marquee behavior="scroll" direction="left" width = "50%">Update Offer available <img width="auto" height="50px" src="data:image/jpeg;base64,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"></marquee>

</div>

      <!-- /.row -->

    

<?php

} //else condition value show?>