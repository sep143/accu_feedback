
<style>
 .btn-info.btn-inverse {
    background-color: #dce5f5;
    color: #3466b7;
    border-color: transparent;
    box-shadow: none;
}
.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
    cursor: not-allowed;
    opacity: .65;
    filter: alpha(opacity=65);
    box-shadow: none;
}
.btn-rounded {
    border-radius: 50px;
}
//select option using to css 
.device-selector .device-select[data-v-940d697a] {
    width: auto;
    display: inline;
    margin: 0 15px;
}
.form-control1 {
    //border: 1px solid #e6ecf5;
    border-radius: 2px;
    //box-shadow: 3px 3px 2px;
    height: 42px;
    font-size: 14px;
    color: #6d7186;
    padding: 5px;
    //background-color: #d9edf7;
    transition: all .2s ease-in;
    -webkit-transition: all .2s ease-in;
    -moz-transition: all .2s ease-in;
    -o-transition: all .2s ease-in;
    -ms-transition: all .2s ease-in;
}
option {
    font-weight: normal;
    display: block;
    white-space: pre;
    min-height: 1.2em;
    padding: 0px 2px 1px;
}
.alert-info1 {
    background-color: rgb(217, 237, 247);
    color: rgb(49, 112, 143);
    border-color: rgb(188, 232, 241);
}

</style>
<?php
//$adminRole = ucwords($this->session->userdata('role_id'));
//$otherRole = ucwords($this->session->userdata('m_role_id'));
?>
<section class="content">
    <div class="row">
        <?php //echo form_open(base_url('admin/payment/pay'), 'class=""'); ?> 
        <?php echo form_open(base_url('admin/payment/payu_money'), 'class="" enctype="multipart/form-data"'); ?> 
        <div class="col-md-12"> 
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-trophy"></i>  Upgrade Account</h3>
                    </div>

                    <div class="box-body">
                        <p>Choose a pay-as-you-go subscription plan that works for you. Zero installation or setup charges.</p><br>
                        <h4>Devices</h4>
                        <p>Choose number of devices you'll connect. You can add more devices later if required.</p>
                        <div data-v-940d697a class="form-group device-selector">
                            <!--<button data-v-940d697a type="button" class="btn btn-info btn-inverse btn-sm btn-rounded" id="fieldBefore"><i data-v-940d697a class="fa fa-minus"></i></button>-->
                            <input type="hidden" name="device" value="<?= $access->device; ?>">
                            <select data-v-940d697a class="form-control1 device-selector" id="device" name="device" style="width: 40%;<?php if($access->expired_role==1) echo 'background-color:#ecf0f5;';?>" <?php if($access->expired_role==1) echo 'disabled=""';?>>
                                <option value="1" <?php if($access->device==1) echo 'selected';?> >Single Device</option>
                                <option value="2" <?php if($access->device==2) echo 'selected';?> >Multiple Devices</option>
                            </select>
                            <!--<button data-v-940d697a type="button" class="btn btn-info btn-inverse btn-sm btn-rounded" id="fieldNext"><i data-v-940d697a class="fa fa-plus"></i></button>-->
                        </div>
                        <p>Don't find what you need? Contact support for any questions.</p>
                        <?php if($access->expired_role==1) echo '<b style="color:red;">If change Device Setting Please Contact Admin.</b>';?><br><br>
                        <h4>Billing Preference</h4>
                        <div class="col-md-12">
                        <div class="radio">
                            <input type="radio" name="pay" value="monthly" id="monthly" required="">
                            <label for="monthly">Pay <strong id="monthPay"></strong> every month</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="pay" value="annual" id="annual" checked="">
                            <label for="annual">Pay <strong id="annualPay"></strong> annually</label>
                        </div>
                        <div class="alert alert-info1">
                            <span id="value_view">
                               
                            </span>
                        </div>
                        </div>
                        &nbsp;<br>
                        <button type="submit" class="btn btn-success btn-lg "><i class="fa fa-spin fa-circle-o-notch" style="display: none;"></i><small>Continue <i class="fa fa-chevron-right"></i></small></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account basic detail view End Div-->
        <div class="col-md-12"> 
            <div class="col-md-8">
                
            </div>
            <div class="col-md-4">
                
            </div>
        </div> <!--My Account Payment End Div-->
        
    </div>

    <?php echo form_close(); ?>
 
</section> 

<script>
    $(document).ready(function(){
        var device = $('#device').val();
        if(device == 1){
                $('#monthPay').html('<?= $this->pay_month["month"]-$singleMonth->amount ?> <i class="fa fa-inr"></i>');
                $('#annualPay').html('<?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Single Device 1 Year </strong>Amount Rs. <?= $this->pay_month["annul"] ?> And Discount : <?= $singleAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#monthly').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-lightbulb-o fa-fw"></i> Single Device 1 Month</strong> Amount Rs. <?= $this->pay_month["month"] ?> And Discount : <?= $singleMonth->amount; ?> .Payble Amount : <?= $this->pay_month["month"]-$singleMonth->amount ?> <i class="fa fa-inr"></i>');

                    });
        
                $('#annual').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Single Device 1 Year </strong>Amount Rs. <?= $this->pay_month["annul"] ?> And Discount : <?= $singleAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');

                    });
            }else if(device == 2 ){
                $('#monthPay').html('<?= $this->pay_month["mmonth"]-$multiMonth->amount ?> <i class="fa fa-inr"></i>');
                $('#annualPay').html('<?= $this->pay_month["mannul"]-$multiAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#monthly').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-lightbulb-o fa-fw"></i> Multi Device 1 Month</strong> Amount Rs. <?= $this->pay_month["mmonth"] ?> And Discount : <?= $multiMonth->amount; ?> .Payble Amount : <?= $this->pay_month["mmonth"]-$multiMonth->amount ?> <i class="fa fa-inr"></i>');

                    });
        
                $('#annual').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Multi Devices 1 Year</strong> Amount Rs. <?= $this->pay_month["mannul"] ?> And Discount : <?= $multiAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["mannul"]-$multiAnnual->amount ?> <i class="fa fa-inr"></i>');

                    });
            }
            
        $('select[id^="device"]').on('change', function(){
            var device = $(this).val();
            
            if(device == 1){
                $('#monthPay').html('<?= $this->pay_month["month"]-$singleMonth->amount ?> <i class="fa fa-inr"></i>');
                $('#annualPay').html('<?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Single Device 1 Year</strong> Amount Rs. <?= $this->pay_month["annul"] ?> And Discount : <?= $singleAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#monthly').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-lightbulb-o fa-fw"></i> Single Device 1 Month</strong> Amount Rs. <?= $this->pay_month["month"] ?> And Discount : <?= $singleMonth->amount; ?> .Payble Amount : <?= $this->pay_month["month"]-$singleMonth->amount ?> <i class="fa fa-inr"></i>');

                    });
        
                $('#annual').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Single Device 1 Year</strong> Amount Rs. <?= $this->pay_month["annul"] ?> And Discount : <?= $singleAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["annul"]-$singleAnnual->amount ?> <i class="fa fa-inr"></i>');

                    });
            }else if(device == 2 ){
                 $('#monthPay').html('<?= $this->pay_month["mmonth"]-$multiMonth->amount ?> <i class="fa fa-inr"></i>');
                $('#annualPay').html('<?= $this->pay_month["mannul"]-$multiAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Multi Devices 1 Year </strong>Amount Rs. <?= $this->pay_month["mannul"] ?> And Discount : <?= $multiAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["mannul"]-$multiAnnual->amount ?> <i class="fa fa-inr"></i>');
                $('#monthly').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-lightbulb-o fa-fw"></i> Multi Device 1 Month </strong> Amount Rs. <?= $this->pay_month["mmonth"] ?> And Discount : <?= $multiMonth->amount; ?> .Payble Amount : <?= $this->pay_month["mmonth"]-$multiMonth->amount ?> <i class="fa fa-inr"></i>');

                    });
        
                $('#annual').click(function(){
                    var pay = $(this).val();
                    $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Multi Devices 1 Year </strong>Amount Rs. <?= $this->pay_month["mannul"] ?> And Discount : <?= $multiAnnual->amount; ?> .Payble Amount : <?= $this->pay_month["mannul"]-$multiAnnual->amount ?> <i class="fa fa-inr"></i>');

                    });
            }
        });
        
        
      //  $('#value_view').html('<strong><i class="fa fa-check fa-fw"></i> Discounted Price</strong> Your price includes a 2 month discount for choosing the annual plan');
        
        
    });
</script>
<script>
//    $('#fieldNext').click(function() {
//            $('#device option:selected').next().attr('selected', 'selected');  
//            var devic = $('#device').val();
//        if(devic){
//            alert(devic);
//            if(devic == 1){
//                $('#monthPay').html('$29');
//                $('#annualPay').html('$290');
//            }else if(devic == 2 || devic == 3 || devic == 4 || devic == 5){
//                var x = devic - 1;
//                var y = x*9;
//                var value1 = 29 + y;
//                var value2 = value1 * 10;
//                $('#monthPay').html('$'+value1);
//                $('#annualPay').html('$'+value2);
//            }else if(devic == 6||devic == 7||devic == 8||devic == 9||devic == 10||devic == 11||devic == 12||devic == 13||devic == 14||devic == 15||devic == 16||devic == 17||devic == 18||devic == 19||devic == 20){
//                var x = devic;
//                var y = x*7;
//                var value1 = 29 + y + 1;
//                var value2 = value1 * 10;
//                $('#monthPay').html('$'+value1);
//                $('#annualPay').html('$'+value2);
//            }
//        }
//        });
//        $('#fieldBefore').click(function() {
//            $('#device1 option:selected').prev().attr('selected', 'selected');    
//        });
//        
        
        $("#fieldNext").click(function() {
  var nextElement = $('#device > option:selected').next('option');
  if (nextElement.length > 0) {
    $('#device > option:selected').removeAttr('selected').next('option').attr('selected', 'selected');
  }
});

$("#fieldBefore").click(function() {
  var nextElement = $('#device > option:selected').prev('option');
  if (nextElement.length > 0) {
    $('#device > option:selected').removeAttr('selected').prev('option').attr('selected', 'selected');
  }
});
//        $("#fieldNext").click(function() {
//  var nextElement = $('#device > option:selected').next('option');
//  if (nextElement.length > 0) {
//    $('#device > option:selected').removeAttr('selected').next('option').attr('selected', 'selected');
//  }
//});
//
//$("#fieldBefore").click(function() {
//  var nextElement = $('#device > option:selected').prev('option');
//  if (nextElement.length > 0) {
//    $('#device > option:selected').removeAttr('selected').prev('option').attr('selected', 'selected');
//  }
//});
</script>

<script>
    $("#myAccount").addClass('active');
</script>    