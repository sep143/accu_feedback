
<?php
if($value==0){
?>
<span class="btn btn-danger btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $devices_data->device_id; ?>" data-status="0" style="cursor: pointer;">
    Inactive
</span>

<?php
}else{
    ?>
<span class="btn btn-success btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $devices_data->device_id; ?>" data-status="1" style="cursor: pointer;">
    Active
</span>
<?php    
}
?>