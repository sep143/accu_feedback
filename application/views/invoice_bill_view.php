<?php
$actual_amt = $payment->TXN_AMOUNT;
$discount = $payment->discount;
$tax = ($actual_amt*$this->pay_tax['for'])/100;
$sub_total = $actual_amt-$tax;

$gross_total = $sub_total+$tax+$discount;
?>

<section class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="box" >
                    <div class="box-header">
                        <h3 class="box-title">Invoice</h3>
                        <div class="pull-right">
                            <!--<button class="btn btn-success" onclick="printDiv('printDiv')">Print</button>-->
                            <?php
                            if(!empty($this->session->userdata('super'))){
                                ?>
                                <a href="<?= base_url('admin/pdfGenerate/super_pdf/'.$payment->id); ?>" target="_blank" class="btn btn-success">Print</a>
                                <a href="<?= base_url('admin/pdfGenerate/super_pdf/'.$payment->id); ?>" target="_blank" class="btn btn-warning">PDF</a>
                            <?php
                            }else{
                            ?>
                                <a href="<?= base_url('admin/pdfGenerate/pdf/'.$payment->id); ?>" target="_blank" class="btn btn-success">Print</a>
                                <a href="<?= base_url('admin/pdfGenerate/pdf/'.$payment->id); ?>" target="_blank" class="btn btn-warning">PDF</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="box-body Section1" id="printDiv">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--<button type="button" class="btn btn-success" >Generate</button>-->
                            </div>
                        </div>&nbsp;<br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <img src="<?= base_url()?>image/app_logo.png" class="img img-responsive" style="width: auto; height: 130px;">
                                </div>
                                <div class="col-lg-6 pull-right text-right">
                                    <h3><strong>INVOICE</strong></h3><br>
                                    <p>No : <?= $payment->ORDER_ID ?></p><br>
                                    <strong style="font-size: 20px; color: lightseagreen;font: bold;">Gross Amount :<br> <i class="fa fa-inr"></i> <?= $gross_total; ?>/-</strong>
                                </div>
                            </div>
                        </div>&nbsp;<br><br>
                        <!--Row 3 start-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-8 text-left">
                                    <p>Bill To</p><br>
                                    <strong style="font-size: 20px; color: lightseagreen;"><?= $restaurant->name; ?></strong><br>
                                    <label>Owner Name : <?= $restaurant-> first_name .' '.$restaurant->last_name ?></label>
                                    <p>Address : <?= $restaurant->r_address .',<br> '.$restaurant->r_city .', '.$restaurant->r_state .',<br>'.$restaurant->r_country .', PIN CODE : '. $restaurant->r_pin_code?></p><br>
                                    <p>Email : <b><?= $restaurant->email ?></b></p>
                                    <p>Mobile No. : <b><?= $restaurant->mobile ?></b></p>
                                </div>
                                <div class="col-lg-4 ">&nbsp;<br><br>
                                    <p>Invoice Date : <?= date('d F Y', strtotime($payment->TXNDATE))?></p>
                                    <p>Account Expired Date : <?= date('d F Y', strtotime($restaurant->expired_date))?></p>
                                    <p>Payment Mode : <?= $payment->mode ?></p>
                                    <p>Device Plan : <?php if($payment->device==1){ echo 'Signle Device Active';}else{    echo 'Multi Devices Active';}  ?></p>
                                </div>
                            </div>
                        </div>&nbsp;<br><hr>
                        <!--Row 3 end-->
                        <div class="table table-responsive">
                            <table class="table table-bordered table-responsive table-striped" style="font-size: 15px; font: bold;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>Plane</th>
                                        <th>Price</th>
                                        <th>TAX</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Account Update Bill is : <?= $payment->productinfo; ?></td>
                                        <td><?php if($payment->device==1){echo 'Single Device';}else{echo 'Multi Device';}?></td>
                                        <td><?= $sub_total; ?></td>
                                        <td><?= $tax; ?></td>
                                        <td><?= $payment->discount; ?></td>
                                        <td><?= $gross_total; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>&nbsp;<br><hr>
                        <!--Row 4-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-7">
                                    
                                </div>
                                <div class="col-lg-5">
                                    <p>Summary</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-xs-right"><i class="fa fa-inr"> <?= $sub_total; ?></i></td>
                                                </tr>
                                                <tr>
                                                    <td>TAX</td>
                                                    <td class="text-xs-right"><i class="fa fa-inr"> <?= $tax?></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td class="text-xs-right"><i class="fa fa-inr"> <?= $payment->discount; ?></i></td>
                                                </tr>
                                                <tr class="bg-grey bg-lighten-4" style="font-size: 15px; font: bold; background-color: lightgray;">
                                                    <td>Total</td>
                                                    <td class="text-xs-right"><i class="fa fa-inr"> <?= $gross_total ?></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <p>Authorized person</p>
                                        <img src="<?= base_url()?>image/app_logo.png" alt="signature" style="width: auto; height: 120px;">
                                        <h6>Smart Survey</h6>
                                        <p class="text-muted">Business Owner</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row 4 for term and condition-->
                        <div class="row">
                            <div class="col-lg-7 col-xs-12">
                                <h6>Terms &amp; Condition</h6>
                                <p><strong>Payment Due On Receipt</strong><br></p>
                                <div>
                                    <b>1. Prices And Payment</b>
                                </div>
                                <div>
                                    <span style="font-size: 1rem;">Payments are to be made in U.S funds. Unless otherwise specified all invoices are due net 30&nbsp;</span>
                                    <span style="font-size: 1rem;">&nbsp;</span>
                                    <span style="font-size: 1rem;">days from date of Shipment.</span>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>