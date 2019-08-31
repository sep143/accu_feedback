<span class="btn btn-danger btn-flat btn-xs" onclick="change_status(this)" data-count="<?= $count; ?>" data-id="<?= $devices_data->device_id; ?>" data-status="0" style="cursor: pointer;">

    Inactive

</span>



<script>

    alert('Only one device can be active at a time.');

</script>