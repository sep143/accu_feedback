<?php
if($language){
?>

<label>Edit Name And Code : </label>&nbsp;<br><br>
<div class="row form-group">
    <?php echo form_open(base_url('language/update'), 'class=""'); ?> 
    <input type="hidden" value="<?= $language->ID; ?>" name="id">
    <div class="col-lg-1">
        <label class="form-control " style="background-color: lightgray;"><?= $language->ID; ?></label>
    </div>
    <div class="col-lg-5">
        <input type="text" class="form-control" placeholder="Language Name" name="lang_name" value="<?= set_value('lang_name', $language->Name); ?>">
    </div>
    <div class="col-lg-3">
        <input type="text" class="form-control" placeholder="Language Code" name="lang_code" value="<?= set_value('lang_code', $language->Code); ?>">
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