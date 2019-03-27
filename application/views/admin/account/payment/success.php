<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content">
    

    <div class="container mt-5" style="padding: 20px;">
	<div class="row">
        <div class="col-md-2"></div>  
        <div class="col-md-8 text-center">
        	<div class="card">
        		<h4 class="card-header">Transaction <label for="Success" class="btn btn-success btn-xs">Success</label></h4>
        		<div class="card-body">
        			<?php 
		                echo "<p>Thank You. Your order status is ". $status .".</br>";
		                echo "Your Transaction ID for this transaction is <b style='color:green;'>".$txnid."</b></br>";
		                echo "We have received a payment of <b style='color:green;'>Rs. " . $amount . "</b>. Your order  will dispatch soon.</p>";
		                echo "Your Email id is " . $email . ". Your order  will dispatch soon.</p>";
		                echo "<p class='' style='color:red;'>Dear Admin,<br>Please Logout Account then Re-Login Account.<br><br>Thanks For Account Update.</p>";
		            ?>
        		</div>
        	</div>
            
         </div> 
        <div class="col-md-2"></div>
    </div>
	
</div> 
</section>
