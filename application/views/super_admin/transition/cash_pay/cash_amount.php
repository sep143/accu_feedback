
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Search Restaurant And Cash Payment</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-2">
                        <label>Enter Restaurant Detail</label>
                    </div>
                    <div class="col-lg-5 form-group">
                        <input type="text" class="form-control" name="" id="search_res" placeholder="Enter Restaurant ID/ Register Email ID">
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-success " onclick="search_res(this)">Search</button>
                        <button type="button" class="btn btn-danger" onclick="clear1(this)">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="box" style="display: none;" id="res_view">
        <div class="box-header">
            <h3 class="box-title">Restaurant Cash Payment And Update Account</h3>
        </div>
        <div class="box-body">
            <div id="bill_pay">
                <div id="loading" align="center" style="display:none;" class="">
                     Loading Please Wait....
                     <img src="<?= base_url(); ?>public/dist/img/gif/ajax-loader.gif" alt="Loading" />
                 </div>
            </div>
        </div>
    </div>
</section>

<!--search restaurant then open bill pay account restaurant-->
<script>
//$(document).ready(function(){
    function search_res(current){
        $('#res_view').show('slow');
        $('#loading').show();
        var search = $('#search_res').val();
        $.ajax({
            url:'<?= site_url('cash'); ?>',
            type:'post',
            data:{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', search:search,},
            success:function(data){
                $('#loading').hide();
                $('#bill_pay').html(data);
            }
        });
    }
//});
</script>
<!--clear button click then all details cancel and off div-->
<script>
//$(document).ready(function(){
    function clear1(current1){
        $('#bill_pay').empty();
        $('#res_view').hide('slow');
        
    }
//});
</script>

<script>
$("#cash").addClass('active');
</script>