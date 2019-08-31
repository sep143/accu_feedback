<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function AlertMsg() {
    $ci = & get_instance();
    if ($ci->session->flashdata('success_msg')) {
        ?>
        <!--<div class="alert alert-success"><?= $ci->session->flashdata('success_msg'); ?></div>-->
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <span style="color:white;">  <?= $ci->session->flashdata('success_msg'); ?></span>
</div>
        <script>
        $(document).ready (function(){
//            $("#success-alert").hide();
//            $("#myWish").click(function showAlert() {
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(500);
                });   
//            });
        });
        </script>
        <?php
    }
    if ($ci->session->flashdata('danger_msg')) {
        ?>
        <!--<div class="alert alert-danger"><?= $ci->session->flashdata('danger_msg'); ?></div>-->
        <div class="alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <span style="color:white;"><?= $ci->session->flashdata('danger_msg'); ?></span>
        </div>
        <script>
        $(document).ready (function(){
//            $("#success-alert").hide();
//            $("#myWish").click(function showAlert() {
                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#danger-alert").slideUp(500);
                });   
//            });
        });
        </script>
        <?php
    }
}

function datatable() {
    ?>
    <link href="<?php echo base_url(); ?>public/dataTables/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/dataTables/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/dataTables/css/dataTables.tableTools.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>public/dataTables/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>public/dataTables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>public/dataTables/js/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>public/dataTables/js/dataTables.tableTools.min.js"></script>
    <?php
}
