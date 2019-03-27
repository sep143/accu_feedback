<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section class="content">
<div class="container mt-5" >
<div class="row">
    <div class="col-md-2"></div>  
     <div class="col-md-8 text-center">
     	<div class="card">
    		<h4 class="card-header">Transaction <label for="failure" class="btn btn-danger btn-xs">Failed</label></h4>
    		<div class="card-body">
    			<?php 
	                echo "<p>Your order status is ". $status ."..</br>";
	                echo "Your transaction id for this transaction is <b style='color:red;'>".$txnid."</b>. <br>Contact our customer support.</p>";
	                echo "<a href='".base_url()."admin/dashboard' class='btn btn-sm float-left btn-info'> < - Go Back</a>";
	            ?>
    		</div>
    	</div>
     </div> 
    <div class="col-md-2"></div>
</div>
</div>
</section>