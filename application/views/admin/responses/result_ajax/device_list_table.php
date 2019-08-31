<option value="all">ALL</option>
<?php
    foreach ($device as $w_count=> $w_data):
        ?>
<option value="<?= $w_data->device_imei; ?>" data-imei="<?= $w_data->device_imei; ?>"> <?= $w_data->device_name; ?>,( *****<?= substr($w_data->device_imei, -4) ?> )</option>
<?php
    endforeach;
?>
