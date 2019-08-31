<html lang="en">

    <head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Pay Now - Smart Surveys</title>

  <link rel="shortcut icon" href="/static/favicon.png">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="icon" href="<?= base_url(); ?>image/app_logo.ico">
  <!--<script async="" src="https://www.fullstory.com/s/fs.js"></script><script src="https://www.paypalobjects.com/api/checkout.js"></script><script async="true" id="xo-pptm" src="https://www.paypal.com/tagmanager/pptm.js?id=app.accufeedback.com&amp;t=xo"></script>-->



 <script type="text/javascript"></script><link rel="stylesheet" type="text/css" href="/B1D671CF-E532-4481-99AA-19F420D90332/netdefender/hui/ndhui.css">

    </head>



<body><script type="text/javascript" language="javascript" src="/B1D671CF-E532-4481-99AA-19F420D90332/netdefender/hui/ndhui.js?0=0&amp;0=0&amp;0=0"></script>

  <div class="container">

    <div class="row">

      <div class="col-md-8 col-md-offset-2" style="font-size: 30px;">

          <img src="<?= base_url(); ?>image/app_logo.png" style="width:100%; max-width:60px; margin: 10px;">
          <b>Accu</b> Feedback
        <hr>



        <h4><i class="glyphicon glyphicon-briefcase"></i> Your Subscription</h4>

        <div class="row">

          <div class="col-md-8">

               <?php

                    if($pay){

                        if($pay == 'annual'){

                         $payment_mode = 'Yearly Cost';

                         // $now = new DateTime();

                        if($expiredDate) {
                          $now = new DateTime($expiredDate);
                        }else {
                          $now = new DateTime();
                        }

                         $current = (new DateTime())->format('d-M-Y');

                         $now->modify('365 days');

                         $from = $now->format('d-M-Y');

                         $data = '';

                            if($device == 1){

                                $amount = $this->pay_month["annul"]-$singleAnnual->amount;

                            }else if($device == 2){

                                $amount = $this->pay_month["mannul"]-$multiAnnual->amount;

                            }

                        }else if($pay == 'monthly'){

                         $payment_mode = 'Monthly Cost';

                            // $now = new DateTime();

                          if($expiredDate) {
                            $now = new DateTime($expiredDate);
                          }else {
                            $now = new DateTime();
                          }
                          
                         $current = (new DateTime())->format('d-M-Y');

                         $now->modify('1 month');

                         $from = $now->format('d-M-Y');

                         $data = '';

                            if($device == 1){

                                $amount = $this->pay_month["month"]-$singleMonth->amount;

                            }else if($device == 2){

                                $amount = $this->pay_month["mmonth"]-$multiMonth->amount;

                            }

                        }

                    }

                  ?>

            <table class="table table-condensed table-bordered" style="border:none;">

              <tbody>

                <tr>

                  <th>Device Licenses</th>

                  <td><?php if($device == 1){ echo 'Single Device';}else{echo 'Multiple Devices';} ?></td>

                </tr>

                <tr>

                  <th>Subscription Period</th>

                  

                  <td><?= $current; ?> to <?= $from; ?></td>

                </tr>

                <tr>

                  <th>Automatic Renewal</th>

                  <td>Yes</td>

                </tr>

                <tr>

                 

                  <th><?= $payment_mode; ?></th>

                  <td><?= $amount; ?>.00 <i class="fa fa-inr"></i></td>

                </tr>

                

                              </tbody>

            </table>

          </div>

        </div>



        <h4>You'll be charged <?= $amount; ?>.00 <i class="fa fa-inr"></i></h4>



        <br>

                

        <form name="payuForm" action="https://sandboxsecure.payu.in/_payment" method="post">

          <input type="hidden" name="key" value="<?= $key; ?>">

          <input type="hidden" name="hash" value="<?= $hash; ?>">

          <input type="hidden" name="txnid" value="<?= $txnid; ?>">

          <input type="hidden" name="amount" value="<?= $amount; ?>">

          <input type="hidden" name="email" value="<?= $email; ?>">

          <input type="hidden" name="phone" value="<?= $phone; ?>">

          <input type="hidden" name="surl" value="<?= $surl; ?>">

          <input type="hidden" name="furl" value="<?= $furl; ?>">

          <input type="hidden" name="curl" value="<?= $curl; ?>">

          <input type="hidden" name="service_provider" value="<?= $service_provider; ?>">

          <input type="hidden" name="udf1" value="<?= $pay; ?>">

          <input type="hidden" name="udf2" value="<?= $udf2; ?>">

          <input type="hidden" name="udf3" value="<?= $udf3; ?>">

          <input type="hidden" name="udf4" value="<?= $udf4; ?>">

          <input type="hidden" name="udf5" value="<?= $udf5; ?>">

          <input type="hidden" name="firstname" value="<?= $firstname; ?>">

          <input type="hidden" name="productinfo" value="<?= $productinfo; ?>">

          <input type="hidden" name="lastname" value="<?= $lastname; ?>">

          <input type="hidden" name="address1" value="<?= $address1; ?>">

          <input type="hidden" name="City" value="<?= $City; ?>">

          <input type="hidden" name="State" value="<?= $State; ?>">

          <input type="hidden" name="country" value="<?= $country; ?>">

          <input type="hidden" name="zipcode" value="<?= $zipcode; ?>">

          <input type="hidden" name="pay" value="<?= $pay; ?>">

          



          <button type="submit" class="btn btn-success btn-lg">

            Make Payment <i class="glyphicon glyphicon-chevron-right"></i>

          </button>



          <a href="<?= site_url('admin/payment/upgrade')?>" class="btn btn-link" style="padding-left:30px"><i class="glyphicon glyphicon-remove"></i> Cancel</a>

            

        </form>



        

        <br>

        <p class="help-block">You'll be redirected to the payment page where you'll have to fill in some information.</p>

      </div>

    </div>

  </div>



  <!--<script src="//code.jquery.com/jquery.js"></script>-->

