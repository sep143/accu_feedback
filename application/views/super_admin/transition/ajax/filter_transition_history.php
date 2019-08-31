<?php
if($get_data){
    $total_amt = 0;
    $amount = 0;
    foreach ($get_data as $count=> $row):
        $total_amt += $row->TXN_AMOUNT;
    endforeach;
    $tax = ($total_amt*$this->pay_tax['for'])/100;
    $amount = $total_amt-$amount;
}
?>

<div class="box-header">
    <h3 class="box-title">Filter Transition History</h3>
    <div class="pull-right">
        <label><span style="color:green;">Amount : <?php if(!empty($amount)) echo $amount;  ?></span> + <span style="color:red;">TAX : <?php if(!empty($tax)) echo $tax; ?></span> = Total Amount:- <u><b style="color:green;"><?php if(!empty($total_amt)) echo $total_amt;?>.00 <i class="fa fa-inr"></i> </b></u></label>
    </div>
</div>
<div class="box-body">
    <table id="filterTransition" class="table table-bordered table-hover table-responsive" style="background-color: lightgoldenrodyellow;">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Restaurant ID</th>
                <th>Restaurant Name</th>
                <th>Invoice No.</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Transition Date </th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Txt ID</th>
                <th>Mode</th>
                <th>Product</th>
                <th>PG Type</th>
                <th>Bank Ref Code</th>
                <th>Device</th>
            </tr>
        </thead>
        <tbody>
            <?php if($get_data){
                foreach ($get_data as $count=>$row):
            ?>
            <tr>
                <td><?= $count+1; ?></td>
                <td><?= $row->CUST_ID; ?></td>
                <td><?= $row->name; ?></td>
                <td><?= $row->ORDER_ID; ?></td>
                <td><?= $row->TXN_AMOUNT; ?></td>
                <td><?php if($row->STATUS=='success'){echo '<span class="btn btn-success btn-xs">'.$row->STATUS.'</span>';}elseif($row->STATUS=='failure'){echo '<span class="btn btn-danger btn-xs">'.$row->STATUS.'</span>';} ?></td>
                <td><?= date('d-M-Y, H:i A', strtotime($row->TXNDATE)) ?></td>
                <td><?= $row->MSISDN; ?></td>
                <td><?= $row->EMAIL; ?></td>
                <td><?= $row->TxtID; ?></td>
                <td><?= $row->mode; ?></td>
                <td><?= $row->productinfo; ?></td>
                <td><?= $row->PG_TYPE; ?></td>
                <td><?= $row->bank_ref_num; ?></td>
                <td><?php if($row->device==1){echo 'Single';}elseif($row->device==2){    echo 'Multiple';} ?></td>
            </tr>
            <?php
                endforeach;
            }?>
        </tbody>
    </table>
</div>

<!--particular transition history-->
<script>
$(function () {
    $("#filterTransition").DataTable({
        searching : true,
        scrollX : true,
    });
  });
</script>