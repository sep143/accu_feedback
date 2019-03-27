<?php
if($get_res){
    ?>
<table class="table table-bordered" >
        <thead style="background-color: lightgrey;">
            <tr>
                <td>S.No.</td>
                <td>Owner Name</td>
                <td>Restaurant Name</td>
                <td>Email</td>
                <td>Mobile No.</td>
                <td>Created Date</td>
                <td>Expired Date</td>
                <td>Device</td>
                <td>Address</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody style="background-color: lightskyblue;">
            <tr>
                <td>1</td>
                <td><?= $get_res->first_name; ?> <?= $get_res->last_name; ?></td>
                <td><?= $get_res->name; ?></td>
                <td><?= $get_res->email; ?></td>
                <td><?= $get_res->mobile; ?></td>
                <td><?= date('d-M-Y, H:i A', strtotime($get_res->create_date)); ?></td>
                <td><?= date('d-M-Y', strtotime($get_res->expired_date)); ?></td>
                <td><?php if($get_res->device==1){        echo 'Single';}else{ echo 'Multi';}?></td>
                <td><?= $get_res->r_address ?>, <?= $get_res->r_city ?>, <?= $get_res->r_state ?>, <?= $get_res->r_country ?>, <?= $get_res->r_pin_code ?></td>
                <td class="text-right">
                    <a href="<?= base_url('super_admin/users/edit/' . $get_res->restaurant_id); ?>"><i class="fa fa-edit" style="color: green; font-size: 20px;"></i></a>
                    <a href="<?= base_url('super_admin/users/view/' . $get_res->restaurant_id); ?>" class="fa fa-eye" style="font-size: 20px;"></a>

                </td>
            </tr>                     
        </tbody>
    </table>
<div class="row">
    <?php
    $total_s = 0;
        $total_f = 0;
        $actual_amt = 0;
        $discount = 0;
        $tax = 0;
    if($get_trans){
        
        foreach ($get_trans as $count=>$row):
            if($row->STATUS=='success'){
                $total_s += $row->TXN_AMOUNT;
                $discount += $row->discount;
            }else{
                $total_f += $row->TXN_AMOUNT;
            }
        endforeach;
        $tax = ($total_s*$this->pay_tax['for'])/100;
        $actual_amt = $total_s - $tax;
    }
    ?>
    <div class="col-lg-12">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $total_s; ?>/-</h3>
              <p>Total Amount</p>
            </div>
            <div class="icon">
              <i class="fa fa-inr"></i>
            </div>
              <!--<a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $actual_amt; ?>/-</h3>
              <p>Actual Amount</p>
            </div>
            <div class="icon">
              <i class="fa fa-inr"></i>
            </div>
              <!--<a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $tax; ?>/-</h3>
              <p>TAX Amount</p>
            </div>
            <div class="icon">
              <i class="fa fa-inr"></i>
            </div>
              <!--<a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal card">
            <div class="inner">
              <h3><?= $discount; ?>/-</h3>
              <p>Discount Amount</p>
            </div>
            <div class="icon">
              <i class="fa fa-inr"></i>
            </div>
              <!--<a href="<?= site_url('expired/restaurant'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
    </div>
</div>
<table class="table table-bordered table-responsive table-hover" id="transition_get_res">
    <thead style="background-color: lightgray;">
        <tr>
            <td>S.No.</td>
            <td>Invoice No.</td>
            <td>Amount</td>
            <td>Status</td>
            <td style="width: 10%">Transition Date</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Txt ID</td>
            <td>Mode</td>
            <td>Product</td>
            <td>PG Type</td>
            <td>Bank Ref Code</td>
            <td>Device</td>
        </tr>
    </thead>
    <tbody>
        
            <?php
            if($get_trans){
                foreach ($get_trans as $count=> $row):
            ?>   
            <tr>
                <td><?= $count+1; ?></td>
                <td><?= $row->ORDER_ID; ?></td>
                <td><?= $row->TXN_AMOUNT; ?></td>
                <td style="<?php if($row->STATUS=='success'){ echo 'color:green;';}else{echo 'color:red;';}?>"><?= $row->STATUS; ?></td>
                <td style="width: 10%"><?= date('d-M-Y, H:i A', strtotime($row->TXNDATE)); ?></td>
                <td><?= $row->EMAIL; ?></td>
                <td><?= $row->MSISDN; ?></td>
                <td><?= $row->TxtID; ?></td>
                <td><?= $row->mode; ?></td>
                <td><?= $row->productinfo; ?></td>
                <td><?= $row->PG_TYPE; ?></td>
                <td><?= $row->bank_ref_num; ?></td>
                <td><?php if($row->device==1){echo 'Single'; }elseif($row->device==2){echo 'Multi';} ?></td>
            </tr>
            <?php        
                endforeach;
            }
            ?>
        
    </tbody>
</table>
<?php
}else{
    echo 'No data found... Please Fill correct Restaurant ID';
}
?>

<!--particular transition history-->
<script>
$(function () {
    $("#transition_get_res").DataTable({
        scrollX : true,
    });
  });
</script>