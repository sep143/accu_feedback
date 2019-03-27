<?php
if($discount){
?>

<label>Edit Name And Amount : </label>&nbsp;<br><br>
<div class="row form-group">
    <?php echo form_open(base_url('update_discount'), 'class=""'); ?> 
    <input type="hidden" value="<?= $discount->id; ?>" name="id">
    <div class="col-lg-1">
        <label class="form-control " style="background-color: lightgray;"><?= $discount->id; ?></label>
    </div>
    <div class="col-lg-5">
        <input type="text" class="form-control" placeholder="Enter Discount Name" name="name" value="<?= set_value('name', $discount->name); ?>">
    </div>
    <div class="col-lg-3">
        <input type="number" class="form-control" placeholder="Amount" name="amount" value="<?= set_value('amount', $discount->amount); ?>">
    </div>
    <div class="col-lg-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
    </div>
    <?php echo form_close(); ?>
</div>
<?php
}else{
    echo 'No data found.';
}
?>