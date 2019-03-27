<option value="all">ALL</option>
<?php
    foreach ($waiter as $w_count=> $w_data):
        ?>
<option value="<?= $w_data->waiter_code; ?>" data-unid="<?= $w_data->waiter_id; ?>"><?= $w_data->waiter_name; ?></option>
<?php
    endforeach;
?>
